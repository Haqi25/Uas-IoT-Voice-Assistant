#include <Wire.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>
#include <U8g2lib.h>
#include <Audio.h> // dari ESP32-audioI2S

// Inisialisasi OLED dengan U8G2 (I2C, 128x64, SSD1306)
U8G2_SSD1306_128X64_NONAME_F_HW_I2C u8g2(U8G2_R0);
Audio audio;
const int buttonPin = 14;
bool lastButtonState = HIGH;
bool isListening = false;

const char* ssid = "Redmi 10C";
const char* password = "12345678";


void setup() {
  Serial.begin(115200);
  pinMode(buttonPin, INPUT_PULLUP);

  u8g2.begin();
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_6x10_tf);
  u8g2.drawStr(0, 10, "Menghubungkan WiFi...");
  u8g2.sendBuffer();
 // konfigurasi pin sesuai:
  audio.setPinout(27, 26, 33); // BCLK, LRC, DIN
  audio.setVolume(20); // 0 - 21
    
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("WiFi Terhubung!");
  u8g2.clearBuffer();
  u8g2.drawStr(0, 10, "WiFi Terhubung!");
  u8g2.sendBuffer();
  delay(1000);
}

void tampilkanOLED(String text) {
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_6x10_tf); // Font kecil agar muat banyak

  u8g2.drawStr(0, 10, "ChatGPT:");

  int y = 25;
  int start = 0;
  while (start < text.length() && y < 64) {
    String line = text.substring(start, start + 20);
    u8g2.setCursor(0, y);
    u8g2.print(line);
    start += 20;
    y += 12;
  }

  u8g2.sendBuffer();
}



void jalankanVoiceAssistant() {
  HTTPClient http;
  http.begin("http://192.168.148.119:5001/listen");
  int code = http.GET();

  if (code == 200) {
    String res = http.getString();
    StaticJsonDocument<1024> doc;
    deserializeJson(doc, res);

    String reply = doc["reply"].as<String>();
    tampilkanOLED(reply);
  }

  http.end();
}

void scrollText(String text) {
  const int delayMs = 100;
  int maxIndex = text.length() - 1;

  for (int start = 0; start <= maxIndex; start++) {
    u8g2.clearBuffer();
    
    // Baris atas tetap: judul
    u8g2.setCursor(0, 10);
    u8g2.print("ChatGPT:");

    // Baris bawah: teks berjalan
 String scrollLine = text.substring(start, min(start + 20, (int)text.length()));


    u8g2.setCursor(0, 30);
    u8g2.print(scrollLine);

    u8g2.sendBuffer();
    delay(delayMs);
  }

  // Optional: biar tetap menampilkan akhir teks selama 1 detik
  delay(1000);
}
void tampilkanChatGPT(String text) {
  u8g2.clearBuffer();
  u8g2.setFont(u8g2_font_6x10_tf); // Font kecil agar muat banyak

  u8g2.drawStr(0, 10, "ChatGPT:");

  int y = 25;
  int maxLines = 4;
  int charsPerLine = 20;

  for (int i = 0; i < maxLines; i++) {
    int startIdx = i * charsPerLine;

    if (startIdx >= text.length()) {
      break; // Tidak ada lagi teks
    }

    String line = text.substring(startIdx, min(startIdx + charsPerLine, (int)text.length()));
    u8g2.setCursor(0, y);
    u8g2.print(line);
    y += 12;
  }

  u8g2.sendBuffer();
}


void scrollText(const String& text, int delayTime = 150) {
  const int maxChars = 20; // jumlah karakter yang muat dalam satu baris
  int start = 0;
  
  while (start < text.length()) {
    String line = text.substring(start, start + maxChars);
    
    u8g2.clearBuffer();
    u8g2.setCursor(0, 10);
    u8g2.print("ChatGPT:");
    u8g2.setCursor(0, 25);
    u8g2.print(line);
    u8g2.sendBuffer();

    delay(delayTime);
    start++;
  }
}

void scrollPages(String text, int pageDelay = 3000) {
  const int charsPerLine = 20;
  int totalChars = text.length();
  int lines = (totalChars + charsPerLine - 1) / charsPerLine; // Total baris
  int pages = (lines + 1) / 2; // 2 baris per halaman

  for (int p = 0; p < pages; p++) {
    u8g2.clearBuffer();
    u8g2.setCursor(0, 10);
    u8g2.print("ChatGPT:");

    int line1Index = p * 2 * charsPerLine;
    int line2Index = line1Index + charsPerLine;

    String line1 = text.substring(line1Index, min(line1Index + charsPerLine, totalChars));
    String line2 = text.substring(line2Index, min(line2Index + charsPerLine, totalChars));

    u8g2.setCursor(0, 30);
    u8g2.print(line1);

    u8g2.setCursor(0, 45);
    u8g2.print(line2);

    u8g2.sendBuffer();
    delay(pageDelay);
  }
}


bool hasTriggeredListen = false; // Tambahkan di bagian global

void loop() {
  // Panggil status Laravel
  HTTPClient http;
  http.begin("http://192.168.148.119:8000/api/esp32/status");
  int httpCode = http.GET();

  if (httpCode > 0) {
    String response = http.getString();
    Serial.println("Status response: " + response);

    StaticJsonDocument<256> doc;
    DeserializationError error = deserializeJson(doc, response);
    if (!error) {
      bool isListening = doc["is_listening"];

      if (isListening && !hasTriggeredListen) {
        // Tampilkan di OLED
        u8g2.clearBuffer();
        u8g2.setCursor(0, 10);
        u8g2.print("Mendengarkan...");
        u8g2.sendBuffer();

        // Trigger endpoint listen di Python
        HTTPClient httpListen;
        httpListen.begin("http://192.168.148.119:5001/listen");
        httpListen.setTimeout(10000);
        int listenCode = httpListen.GET();

        delay(5000); // beri waktu Flask menyimpan file
// Ganti ini dengan URL dari server Python
  audio.connecttohost("http://192.168.148.119:5001/jarvis.mp3");

  while (audio.isRunning()) {
    audio.loop();
  }
        if (listenCode > 0) {
          String result = httpListen.getString();
          Serial.println(">> Response dari /listen:");
          Serial.println(result);

          StaticJsonDocument<2048> listenDoc;
          if (!deserializeJson(listenDoc, result)) {
            String reply = listenDoc["reply"];
        tampilkanChatGPT(reply);// Panggil fungsi scroll halaman
      

          } else {
            u8g2.clearBuffer();
            u8g2.setCursor(100, 10);
            u8g2.print("1/3");
            u8g2.print("Gagal parsing");
            u8g2.sendBuffer();
          }
        }

        httpListen.end();

        // Supaya tidak trigger lagi sebelum status dimatikan
        hasTriggeredListen = true;
      } else if (!isListening) {
        // Reset trigger jika status dinonaktifkan
        hasTriggeredListen = false;
      }
    } else {
      Serial.println("❌ JSON error parsing status");
    }

  } else {
    Serial.println("❌ Gagal panggil /status");
  }

  http.end();
  delay(1000); // Delay untuk mengurangi beban server
}
