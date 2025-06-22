from flask import Flask, request, jsonify, send_file
from flask_sqlalchemy import SQLAlchemy
from dotenv import load_dotenv
import openai
import os
import speech_recognition as sr
import threading
import asyncio
import edge_tts
from playsound import playsound
from flask_cors import CORS
from datetime import datetime

# Init
app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///chat_history.db'
db = SQLAlchemy(app)
CORS(app)

# Load API Key
load_dotenv()
api_key = os.getenv("OPENAI_API_KEY")
if not api_key:
    raise ValueError("OPENAI_API_KEY tidak ditemukan di .env")

client = openai.OpenAI(api_key=api_key)

# DB Model
class ChatHistory(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    prompt = db.Column(db.Text, nullable=False)
    reply = db.Column(db.Text, nullable=False)
    created_at = db.Column(db.DateTime, default=datetime.utcnow)

with app.app_context():
    db.create_all()

# 🔊 Async TTS function
async def generate_tts(text):
    file_path = "jarvis.mp3"
    if os.path.exists(file_path):
        os.remove(file_path)
    tts = edge_tts.Communicate(text or "Ini suara default.", voice="id-ID-ArdiNeural")
    await tts.save(file_path)
    return file_path

# 🔊 Wrapper to run TTS and play (tanpa ffmpeg, pakai playsound)
def SpeakText(text):
    def run():
        asyncio.run(generate_tts(text))
        # Jangan mainkan audio di sisi laptop
        # sound = AudioSegment.from_file(file_path, format="mp3")
        # play(sound)
    threading.Thread(target=run).start()


# 🧠 Endpoint: POST /ask
@app.route('/ask', methods=['POST'])
def ask_chatgpt():
    data = request.json
    prompt = data.get("prompt", "")

    try:
        response = client.chat.completions.create(
            model="gpt-3.5-turbo",
            messages=[{"role": "user", "content": prompt}]
        )
        reply = response.choices[0].message.content

        db.session.add(ChatHistory(prompt=prompt, reply=reply))
        db.session.commit()

        SpeakText(reply)

        return jsonify({"reply": reply})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# 📜 Endpoint: GET /history
@app.route('/history', methods=['GET'])
def get_history():
    results = ChatHistory.query.order_by(ChatHistory.created_at.desc()).all()
    return jsonify([
        {"prompt": h.prompt, "reply": h.reply, "created_at": h.created_at.isoformat()}
        for h in results
    ])

# 🎤 Endpoint: GET /listen
@app.route('/listen', methods=['GET'])
def listen_from_microphone():
    r = sr.Recognizer()
    with sr.Microphone() as source:
        print("🎤 Silakan bicara...")
        audio = r.listen(source)

    try:
        text = r.recognize_google(audio, language="id-ID")
        print("🗣️ Anda berkata:", text)

        messages = [
            {"role": "system", "content": "Kamu adalah Badrol, teman dekat pengguna. Kamu robot ramah, baik hati dan tidak sombong. kamu diciptakan oleh Haqi,Naufal,Alif,dan rizal"},
            {"role": "user", "content": text}
        ]
        response = client.chat.completions.create(
            model="gpt-3.5-turbo",
            messages=messages
        )
        reply = response.choices[0].message.content

        db.session.add(ChatHistory(prompt=text, reply=reply))
        db.session.commit()

        # ⏳ TUNGGU proses generate dan save selesai
        asyncio.run(generate_tts(reply))  # ← tunggu sampai jarvis.mp3 selesai dibuat

        return jsonify({
            "reply": reply,
            "audio_url": f"http://{request.host}/jarvis.mp3"
        })

    except sr.UnknownValueError:
        return jsonify({"reply": "Maaf, tidak bisa mengenali suara."})


# 🎧 Endpoint: serve MP3
@app.route('/jarvis.mp3')
def serve_audio():
    return send_file("jarvis.mp3", mimetype="audio/mpeg")


@app.route('/beep.mp3')
def serve_beep():
    return send_file("beep.mp3", mimetype="audio/mpeg")


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5001)
