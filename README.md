# 🎙️ Voice Assistant Project

Voice Assistant berbasis ESP32, Python, dan Laravel.

## 🚀 Cara Menjalankan Proyek

### 1. Jalankan File `main.cpp` di PlatformIO
- Pastikan sudah menginstal [PlatformIO](https://platformio.org/).
- Buka file `main.cpp`.
- Klik `Build` untuk simulasi.
- Jika sudah tersambung dengan hardware, klik `Upload`.

### 2. Jalankan Server Python
- Masuk ke folder `voice-assistant`.
- Buka terminal, jalankan:
  ```bash
  python server.py
### 3. Jalankan Proyek Laravel
- Masuk ke folder proyek Laravel.
- Jalankan:
  ```bash
  php artisan serve
### 4. Mulai Interaksi
 - Buka aplikasi Laravel di browser
 - Daftar dan login
 - Di dashboard, klik tombol "Mulai" untuk memulai input audio (Speech to Text)
### 5. Output dan History
- Output suara akan keluar melalui speaker dan OLED display (Text to Speech)
- Riwayat percakapan akan muncul di dashboard
- selesai
