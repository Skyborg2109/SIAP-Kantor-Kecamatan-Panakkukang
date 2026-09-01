# PRODUCT REQUIREMENTS DOCUMENT (PRD)

# SIAP PANAKKUKANG

### Sistem Informasi Antrian & Informasi Pelayanan Kecamatan Panakkukang

**Versi Dokumen:** 2.0
**Tanggal:** 28 Agustus 2026
**Status:** Draft / Initial Development PRD
**Platform:** Web-Based Application
**Architecture:** Laravel Full-Stack
**Backend & Web Framework:** Laravel
**Frontend:** Blade + Livewire
**CSS Framework:** Tailwind CSS
**Database:** MySQL
**Real-Time Communication:** Laravel Reverb / WebSockets
**Authentication:** Laravel Breeze
**Local Development:** Laragon
**Deployment:** Local Server / Internal Network

---

# 1. PRODUCT OVERVIEW

## 1.1 Nama Produk

**SIAP Panakkukang**

**Sistem Informasi Antrian & Informasi Pelayanan Kecamatan Panakkukang**

---

## 1.2 Product Vision

Membangun sistem pelayanan berbasis web yang membantu masyarakat memperoleh informasi pelayanan dengan mudah, membantu petugas mengelola antrean secara digital, serta mengoptimalkan monitor yang tersedia pada ruang pelayanan sebagai media informasi publik.

SIAP Panakkukang dirancang bukan hanya sebagai sistem nomor antrean, tetapi sebagai:

> **Digital Queue & Public Information System**

yang menggabungkan pengelolaan antrean, pemanggilan nomor secara real-time, audio announcement, serta penyampaian informasi pelayanan dalam satu sistem.

---

# 2. BACKGROUND

Berdasarkan hasil observasi selama pelaksanaan Kuliah Kerja Lapangan (KKL) pada bagian pelayanan masyarakat Kantor Kecamatan Panakkukang, ditemukan bahwa monitor yang tersedia di ruang pelayanan belum dimanfaatkan secara optimal.

Monitor masih menampilkan gambar atau informasi statis sehingga belum mampu memberikan informasi secara langsung kepada masyarakat yang sedang menunggu pelayanan.

Masyarakat masih membutuhkan bantuan petugas untuk memperoleh informasi mengenai:

* jenis pelayanan;
* persyaratan dokumen;
* prosedur pelayanan;
* pengurusan KTP;
* pengurusan Kartu Keluarga;
* pendaftaran dan aktivasi IKD;
* nomor antrean;
* loket pelayanan;
* pengumuman pelayanan.

Kondisi tersebut menyebabkan terjadinya ketergantungan masyarakat kepada petugas untuk memperoleh informasi dasar dan menyebabkan petugas berulang kali memberikan penjelasan yang sama.

Berdasarkan permasalahan tersebut, diperlukan sistem digital yang dapat mengintegrasikan:

1. pengambilan nomor antrean;
2. pengelolaan antrean;
3. pemanggilan antrean;
4. public display;
5. audio announcement;
6. informasi pelayanan;
7. informasi IKD;
8. pengumuman;
9. statistik pelayanan.

---

# 3. PROBLEM STATEMENT

## 3.1 Masalah Utama

Belum tersedianya sistem berbasis web yang mengintegrasikan pengelolaan antrean dan media informasi pelayanan masyarakat pada ruang pelayanan Kecamatan Panakkukang.

## 3.2 Permasalahan yang Ditemukan

### 3.2.1 Monitor Belum Dimanfaatkan Secara Optimal

Monitor yang telah tersedia belum digunakan sebagai media informasi pelayanan dan antrean secara dinamis.

### 3.2.2 Masyarakat Bergantung pada Petugas

Masyarakat harus bertanya secara langsung mengenai persyaratan dan prosedur pelayanan.

### 3.2.3 Antrean Belum Terintegrasi

Informasi nomor antrean belum terintegrasi dengan sistem digital yang dapat ditampilkan pada monitor.

### 3.2.4 Pemanggilan Belum Terpusat

Belum terdapat mekanisme terintegrasi untuk memanggil nomor, menampilkan nomor pada monitor, dan memberikan informasi loket.

### 3.2.5 Informasi IKD Belum Tersampaikan Secara Digital

Masyarakat yang datang untuk melakukan pendaftaran atau aktivasi IKD belum memiliki media informasi digital yang mudah diakses di ruang pelayanan.

---

# 4. PRODUCT GOALS

## 4.1 Primary Goal

Membangun sistem informasi berbasis web yang mampu mengelola antrean pelayanan dan menampilkan informasi pelayanan secara real-time pada monitor ruang pelayanan.

## 4.2 Secondary Goals

Sistem diharapkan dapat:

* meningkatkan keteraturan antrean;
* mempermudah masyarakat memperoleh informasi;
* mengurangi pertanyaan berulang kepada petugas;
* meningkatkan efisiensi pelayanan;
* mengoptimalkan penggunaan monitor;
* membantu petugas mengelola antrean;
* menyediakan statistik pelayanan;
* menjadi dasar digitalisasi pelayanan di masa mendatang.

---

# 5. PRODUCT OBJECTIVES

| Objective            | Target                                         |
| -------------------- | ---------------------------------------------- |
| Digitalisasi antrean | Nomor antrean dibuat dan dikelola oleh sistem  |
| Real-time display    | Nomor yang dipanggil muncul secara langsung    |
| Audio calling        | Panggilan dapat disampaikan melalui suara      |
| Informasi pelayanan  | Persyaratan dan prosedur dapat ditampilkan     |
| Informasi IKD        | Informasi IKD dapat ditampilkan secara digital |
| Pengelolaan konten   | Admin dapat memperbarui informasi              |
| Statistik            | Data antrean dapat dianalisis                  |

---

# 6. TARGET USERS

## 6.1 Masyarakat

Masyarakat yang datang untuk mendapatkan pelayanan administrasi kependudukan.

### Kebutuhan

* mengetahui layanan;
* mengetahui persyaratan;
* memperoleh nomor antrean;
* mengetahui nomor yang dipanggil;
* mengetahui loket;
* mendapatkan informasi IKD;
* mengetahui pengumuman.

---

## 6.2 Petugas Pelayanan

Petugas yang melayani masyarakat.

### Kebutuhan

* melihat antrean;
* memanggil nomor;
* memanggil ulang;
* melewati nomor;
* menyelesaikan pelayanan;
* mengetahui status antrean.

---

## 6.3 Administrator

Operator atau pihak yang bertanggung jawab mengelola sistem.

### Kebutuhan

* mengelola akun;
* mengelola layanan;
* mengelola loket;
* mengelola informasi;
* mengelola pengumuman;
* mengatur display;
* melihat statistik.

---

# 7. USER PERSONAS

## Persona 1 — Masyarakat

**Nama:** Andi
**Usia:** 30 tahun
**Tujuan:** Mengurus perubahan data Kartu Keluarga.

### Pain Points

* tidak mengetahui persyaratan;
* tidak mengetahui loket;
* tidak mengetahui antrean;
* harus bertanya kepada petugas.

### Expected Experience

Datang → memilih layanan → mengambil nomor → melihat informasi → menunggu → nomor dipanggil → menuju loket.

---

## Persona 2 — Petugas

**Role:** Petugas Pelayanan

### Pain Points

* harus memanggil antrean;
* menjawab pertanyaan yang sama berulang kali;
* perlu mengetahui status antrean.

### Expected Experience

Login → pilih loket → lihat antrean → panggil → layani → selesai.

---

## Persona 3 — Admin

**Role:** Administrator Sistem

### Pain Points

* informasi pelayanan dapat berubah;
* konten display perlu diperbarui;
* membutuhkan laporan pelayanan.

### Expected Experience

Login → kelola layanan → kelola informasi → kelola display → lihat statistik.

---

# 8. PRODUCT SCOPE

# 8.1 IN SCOPE — MVP

## Authentication

* login;
* logout;
* role management;
* session management.

## Queue Management

* generate nomor;
* pemilihan layanan;
* status antrean;
* panggil berikutnya;
* panggil ulang;
* lewati;
* mulai pelayanan;
* selesaikan pelayanan;
* reset antrean harian.

## Public Display

* nomor aktif;
* loket;
* jenis layanan;
* antrean berikutnya;
* tanggal;
* waktu;
* informasi pelayanan;
* IKD;
* pengumuman.

## Audio Announcement

* text-to-speech;
* pemanggilan nomor;
* nama loket;
* jenis pelayanan.

## Service Information

* daftar layanan;
* deskripsi;
* persyaratan;
* prosedur.

## IKD Information

* pengertian;
* manfaat;
* persyaratan;
* prosedur;
* FAQ.

## Admin Management

* pengguna;
* layanan;
* loket;
* informasi;
* pengumuman;
* konten display.

## Statistics

* total antrean;
* selesai;
* menunggu;
* dilewati;
* berdasarkan layanan.

---

# 9. OUT OF SCOPE — MVP

Fitur berikut tidak termasuk dalam MVP:

* aplikasi Android/iOS;
* pembayaran online;
* integrasi database Dukcapil;
* verifikasi biometrik;
* tanda tangan digital;
* WhatsApp notification;
* online booking dari luar kantor;
* chatbot AI;
* video conference.

Fitur tersebut dapat masuk dalam roadmap versi berikutnya.

---

# 10. CORE FEATURES

# 10.1 Authentication

Sistem menggunakan autentikasi Laravel.

### Role

```text
ADMIN
PETUGAS
```

### Requirements

* username/email;
* password;
* password hashing;
* session authentication;
* authorization berdasarkan role;
* logout.

---

# 10.2 Queue Number Generation

Masyarakat memilih layanan dan memperoleh nomor antrean otomatis.

Contoh:

```text
KTP → A-001
KK  → B-001
IKD → C-001
AKTA → D-001
```

Nomor dapat menggunakan prefix berdasarkan kategori layanan.

### Requirements

* nomor otomatis;
* nomor unik;
* reset setiap hari;
* tanggal pembuatan;
* waktu pembuatan;
* status antrean.

---

# 10.3 Queue Status

Status antrean:

```text
WAITING
CALLED
SERVING
COMPLETED
SKIPPED
```

### WAITING

Menunggu dipanggil.

### CALLED

Sudah dipanggil.

### SERVING

Sedang dilayani.

### COMPLETED

Pelayanan selesai.

### SKIPPED

Antrean dilewati.

---

# 10.4 Queue Calling

Petugas dapat:

* panggil berikutnya;
* panggil ulang;
* mulai pelayanan;
* lewati;
* selesaikan.

Ketika nomor dipanggil, sistem mengirim event real-time melalui Laravel Reverb.

---

# 10.5 Public Display

Halaman:

```text
/display
```

didesain khusus untuk monitor besar.

### Informasi utama

* nomor aktif;
* loket;
* layanan.

### Informasi tambahan

* antrean berikutnya;
* informasi pelayanan;
* IKD;
* pengumuman;
* tanggal;
* waktu.

---

# 10.6 Audio Announcement

Saat nomor dipanggil, browser pada display akan memutar audio.

Contoh:

> "Nomor antrean A-023, silakan menuju Loket 02."

Sistem dapat memanfaatkan kemampuan Text-to-Speech pada browser untuk MVP.

---

# 10.7 Service Information

Setiap layanan mempunyai:

```text
Name
Code
Description
Requirements
Procedure
Status
```

Admin dapat memperbarui informasi tanpa mengubah source code.

---

# 10.8 IKD Information

Sistem menyediakan konten khusus:

**Informasi Identitas Kependudukan Digital**

Materi dapat meliputi:

* apa itu IKD;
* manfaat;
* persyaratan;
* prosedur;
* aktivasi;
* pertanyaan umum.

Konten harus disesuaikan dengan ketentuan/prosedur resmi yang berlaku di instansi.

---

# 10.9 Announcement

Admin dapat membuat pengumuman.

Contoh:

```text
PENGUMUMAN

Pelayanan administrasi kependudukan
akan ditutup sementara pada pukul 12.00
untuk waktu istirahat.
```

---

# 10.10 Statistics

Dashboard menampilkan:

```text
Total Antrian
Menunggu
Sedang Dilayani
Selesai
Dilewati
```

Statistik dapat difilter berdasarkan tanggal atau jenis layanan.

---

# 11. FUNCTIONAL REQUIREMENTS

| ID    | Requirement                                 |
| ----- | ------------------------------------------- |
| FR-01 | Sistem dapat melakukan autentikasi pengguna |
| FR-02 | Sistem menerapkan role Admin dan Petugas    |
| FR-03 | Sistem dapat menghasilkan nomor antrean     |
| FR-04 | Sistem dapat memanggil nomor berikutnya     |
| FR-05 | Sistem dapat memanggil ulang nomor          |
| FR-06 | Sistem dapat melewati nomor                 |
| FR-07 | Sistem dapat menyelesaikan antrean          |
| FR-08 | Display menerima perubahan secara real-time |
| FR-09 | Sistem dapat memainkan audio pemanggilan    |
| FR-10 | Admin dapat mengelola layanan               |
| FR-11 | Admin dapat mengelola persyaratan           |
| FR-12 | Admin dapat mengelola informasi             |
| FR-13 | Admin dapat mengelola pengumuman            |
| FR-14 | Admin dapat mengelola pengguna              |
| FR-15 | Admin dapat mengelola loket                 |
| FR-16 | Sistem menyediakan statistik                |

---

# 12. NON-FUNCTIONAL REQUIREMENTS

## NFR-01 Performance

Aplikasi harus merespons operasi pengguna dengan cepat dalam kondisi jaringan normal.

## NFR-02 Real-Time

Perubahan nomor antrean harus dapat diterima display tanpa melakukan refresh manual.

## NFR-03 Usability

Antarmuka petugas harus sederhana dan mudah dipelajari.

## NFR-04 Accessibility

Nomor antrean pada monitor harus memiliki ukuran besar dan kontras tinggi.

## NFR-05 Reliability

Sistem harus dapat digunakan selama jam operasional pelayanan.

## NFR-06 Security

* password menggunakan hashing;
* authorization berdasarkan role;
* CSRF protection;
* validasi input;
* protected routes;
* session security;
* database backup.

## NFR-07 Maintainability

Kode Laravel menggunakan struktur MVC yang jelas serta pemisahan tanggung jawab antara Controller, Model, Service, Event, dan Livewire Component.

---

# 13. USER FLOW

# 13.1 Masyarakat

```text
Mulai
 ↓
Datang
 ↓
Pilih Layanan
 ↓
Ambil Nomor
 ↓
Nomor Diterima
 ↓
Menunggu
 ↓
Melihat Display
 ↓
Nomor Dipanggil
 ↓
Menuju Loket
 ↓
Pelayanan
 ↓
Selesai
```

---

# 13.2 Petugas

```text
Login
 ↓
Dashboard
 ↓
Pilih Loket
 ↓
Lihat Antrean
 ↓
Panggil Berikutnya
 ↓
Display Diperbarui
 ↓
Layani Masyarakat
 ↓
Selesai
 ↓
Panggil Berikutnya
```

---

# 13.3 Admin

```text
Login
 ↓
Dashboard
 ↓
Kelola Layanan
 ↓
Kelola Informasi
 ↓
Kelola Pengumuman
 ↓
Kelola Pengguna/Loket
 ↓
Lihat Statistik
```

---

# 14. INFORMATION ARCHITECTURE

```text
SIAP PANAKKUKANG
│
├── Public
│   ├── Ambil Antrian
│   ├── Display
│   ├── Informasi Pelayanan
│   ├── Informasi IKD
│   └── Pengumuman
│
├── Petugas
│   ├── Login
│   ├── Dashboard
│   ├── Antrean
│   └── Riwayat
│
└── Admin
    ├── Login
    ├── Dashboard
    ├── Antrean
    ├── Layanan
    ├── Loket
    ├── Pengguna
    ├── Informasi
    ├── Pengumuman
    ├── Display
    └── Statistik
```

---

# 15. SYSTEM PAGES

## Public

### PUB-01 Landing / Information

Halaman informasi umum.

### PUB-02 Take Queue

Pengambilan nomor antrean.

### PUB-03 Queue Ticket

Menampilkan nomor yang diperoleh.

### PUB-04 Public Display

Tampilan monitor.

### PUB-05 Service Information

Informasi layanan.

### PUB-06 IKD Information

Informasi IKD.

---

# Petugas

### OFF-01 Login

Login petugas.

### OFF-02 Dashboard

Ringkasan antrean.

### OFF-03 Queue Management

Pengelolaan antrean.

### OFF-04 History

Riwayat pelayanan.

### OFF-05 Profile

Profil petugas.

---

# Admin

### ADM-01 Dashboard

Ringkasan sistem.

### ADM-02 Queue Management

Pemantauan antrean.

### ADM-03 Service Management

CRUD layanan.

### ADM-04 Counter Management

CRUD loket.

### ADM-05 User Management

CRUD pengguna.

### ADM-06 Information Management

CRUD informasi.

### ADM-07 Announcement Management

CRUD pengumuman.

### ADM-08 Display Management

Mengatur konten display.

### ADM-09 Statistics

Laporan pelayanan.

---

# 16. ROLE & PERMISSION

| Feature           | Admin |  Petugas | Masyarakat |
| ----------------- | ----: | -------: | ---------: |
| Login             |     ✓ |        ✓ |          - |
| Ambil nomor       |     - |        - |          ✓ |
| Lihat display     |     ✓ |        ✓ |          ✓ |
| Panggil antrean   |     ✓ |        ✓ |          - |
| Recall            |     ✓ |        ✓ |          - |
| Skip              |     ✓ |        ✓ |          - |
| Complete          |     ✓ |        ✓ |          - |
| Kelola layanan    |     ✓ |        - |          - |
| Kelola loket      |     ✓ |        - |          - |
| Kelola pengguna   |     ✓ |        - |          - |
| Kelola informasi  |     ✓ |        - |          - |
| Kelola pengumuman |     ✓ |        - |          - |
| Kelola display    |     ✓ |        - |          - |
| Statistik         |     ✓ | Terbatas |          - |

---

# 17. DATA MODEL OVERVIEW

Entitas utama:

```text
users
services
service_requirements
counters
queues
information
announcements
display_contents
```

Relasi:

```text
User
 │
 └── Counter

Service
 ├── Queue
 └── ServiceRequirement

Counter
 └── Queue
```

---

# 18. TECHNICAL ARCHITECTURE

SIAP Panakkukang menggunakan pendekatan **Laravel Full-Stack Monolith**.

```text
┌──────────────────────────────────────────────┐
│                Browser / Client              │
│                                              │
│  Admin │ Petugas │ Ambil Antrian │ Display  │
└───────────────────────┬──────────────────────┘
                        │
                        ▼
┌──────────────────────────────────────────────┐
│                  Laravel                     │
│                                              │
│  Routing                                      │
│  Controllers                                  │
│  Blade                                       │
│  Livewire                                    │
│  Authentication                              │
│  Validation                                  │
│  Business Logic                              │
│  Events                                      │
│  Broadcasting                                │
└───────────────────────┬──────────────────────┘
                        │
               ┌────────┴─────────┐
               │                  │
               ▼                  ▼
          MySQL Database     Laravel Reverb
                                  │
                                  │ WebSocket
                                  ▼
                            Public Display
```

---

# 19. TECHNOLOGY STACK

## 19.1 Backend

**Laravel**

Digunakan sebagai framework utama aplikasi.

Fungsi:

* routing;
* authentication;
* authorization;
* business logic;
* database interaction;
* validation;
* broadcasting;
* queue management.

---

## 19.2 Frontend

### Blade

Digunakan sebagai template engine Laravel.

### Livewire

Digunakan untuk komponen interaktif tanpa harus membuat frontend SPA terpisah.

Contoh:

* tombol panggil;
* daftar antrean;
* dashboard;
* statistik;
* CRUD.

---

## 19.3 CSS

**Tailwind CSS**

Digunakan untuk:

* layout;
* responsive interface;
* dashboard;
* public display;
* component styling.

---

## 19.4 Database

**MySQL**

Alasan:

* mudah digunakan;
* kompatibel dengan Laravel;
* cocok untuk sistem CRUD;
* mudah dijalankan melalui Laragon;
* mudah dipelihara untuk proyek KKL.

---

## 19.5 Authentication

**Laravel Breeze**

Digunakan untuk:

* login;
* logout;
* session;
* authentication scaffolding.

Role dan permission diatur pada level aplikasi.

---

## 19.6 Real-Time

**Laravel Reverb**

Digunakan untuk mengirimkan perubahan antrean secara real-time.

Contoh:

```text
Petugas
 ↓
Panggil A-023
 ↓
Laravel Event
 ↓
Laravel Reverb
 ↓
Public Display
 ↓
A-023
```

---

## 19.7 Development Environment

**Laragon**

Digunakan untuk local development.

Komponen:

```text
PHP
MySQL
Apache/Nginx
Composer
Node.js/NPM
```

---

# 20. LARAVEL APPLICATION ARCHITECTURE

Struktur project yang direkomendasikan:

```text
siap-panakkukang/
│
├── app/
│   ├── Events/
│   │   ├── QueueCalled.php
│   │   ├── QueueRecalled.php
│   │   ├── QueueSkipped.php
│   │   └── QueueCompleted.php
│   │
│   ├── Http/
│   │   └── Controllers/
│   │
│   ├── Livewire/
│   │   ├── Admin/
│   │   ├── Petugas/
│   │   ├── Queue/
│   │   └── Display/
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Queue.php
│   │   ├── Service.php
│   │   ├── Counter.php
│   │   ├── Information.php
│   │   └── Announcement.php
│   │
│   └── Services/
│       └── QueueService.php
│
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
│
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── admin/
│   │   ├── petugas/
│   │   ├── queue/
│   │   └── display/
│   │
│   └── css/
│
├── routes/
│   ├── web.php
│   └── channels.php
│
└── public/
```

---

# 21. REAL-TIME SYSTEM

Ketika petugas menekan:

**Panggil Berikutnya**

proses:

```text
1. Livewire Action
       ↓
2. QueueService
       ↓
3. Update Queue Database
       ↓
4. Dispatch QueueCalled Event
       ↓
5. Laravel Broadcasting
       ↓
6. Laravel Reverb
       ↓
7. Public Display menerima event
       ↓
8. Update nomor
       ↓
9. Play audio
```

---

# 22. WEBSOCKET EVENT

Contoh event:

```text
QUEUE_CALLED
QUEUE_RECALLED
QUEUE_SKIPPED
QUEUE_COMPLETED
DISPLAY_UPDATED
ANNOUNCEMENT_UPDATED
```

Contoh payload:

```json
{
    "queue_number": "A-023",
    "counter": "Loket 02",
    "service": "Pelayanan KTP"
}
```

---

# 23. ROUTE STRUCTURE

Contoh route:

```text
/
├── /login
│
├── /queue
│   ├── /take
│   └── /ticket/{id}
│
├── /display
│
├── /information
│
├── /ikd
│
├── /petugas
│   ├── /dashboard
│   ├── /queue
│   └── /history
│
└── /admin
    ├── /dashboard
    ├── /users
    ├── /services
    ├── /counters
    ├── /information
    ├── /announcements
    ├── /display
    └── /statistics
```

---

# 24. BUSINESS RULES

## BR-01

Nomor antrean hanya dapat dibuat pada waktu pelayanan aktif.

## BR-02

Nomor antrean di-reset setiap hari.

## BR-03

Nomor antrean harus unik pada hari berjalan.

## BR-04

Petugas hanya dapat mengelola loket yang ditugaskan kepadanya.

## BR-05

Satu antrean tidak boleh dilayani oleh dua petugas secara bersamaan.

## BR-06

Antrean yang dilewati tetap dicatat dalam riwayat.

## BR-07

Informasi nonaktif tidak ditampilkan pada display.

## BR-08

Pengumuman nonaktif tidak muncul pada display.

---

# 25. SECURITY REQUIREMENTS

Laravel Security yang digunakan:

* password hashing;
* CSRF protection;
* middleware authentication;
* authorization;
* request validation;
* protected routes;
* session security;
* mass-assignment protection;
* database backup.

Sistem tidak boleh menyimpan data pribadi masyarakat yang tidak diperlukan untuk pengelolaan antrean.

---

# 26. PUBLIC DISPLAY BEHAVIOR

Display memiliki beberapa mode:

### Mode 1 — Queue

Nomor aktif dan antrean berikutnya.

### Mode 2 — Service Information

Informasi pelayanan.

### Mode 3 — IKD

Informasi IKD.

### Mode 4 — Announcement

Pengumuman.

Contoh rotasi:

```text
QUEUE
 ↓
KTP INFORMATION
 ↓
KK INFORMATION
 ↓
IKD INFORMATION
 ↓
ANNOUNCEMENT
 ↓
QUEUE
```

Konten dapat berganti otomatis sesuai interval yang ditentukan admin.

Ketika terdapat nomor baru yang dipanggil, sistem memprioritaskan tampilan antrean dan pemanggilan suara.

---

# 27. STATISTICS

Dashboard statistik:

```text
TODAY

Total Queue       : 87
Waiting           : 18
Serving           : 1
Completed         : 64
Skipped           : 4
```

Statistik berdasarkan layanan:

```text
KTP      █████████████
KK       ██████████
IKD      ███████
AKTA     ████
LAINNYA  ██
```

Data tersebut dapat menjadi informasi evaluasi pelayanan.

---

# 28. ACCEPTANCE CRITERIA

## AC-01 — Generate Queue

**Given:** layanan KTP aktif
**When:** masyarakat mengambil antrean
**Then:** sistem menghasilkan nomor unik.

## AC-02 — Call Queue

**Given:** antrean tersedia
**When:** petugas menekan "Panggil Berikutnya"
**Then:** sistem memanggil antrean berikutnya.

## AC-03 — Display

**Given:** nomor A-023 dipanggil
**When:** event diterima
**Then:** display menampilkan A-023.

## AC-04 — Audio

**Given:** nomor A-023 dipanggil
**When:** display menerima event
**Then:** browser memutar audio pemanggilan.

## AC-05 — Service Information

**Given:** informasi layanan aktif
**When:** display memasuki mode informasi
**Then:** informasi tersebut tampil.

## AC-06 — Announcement

**Given:** pengumuman aktif
**When:** display memasuki mode pengumuman
**Then:** pengumuman tampil.

---

# 29. RISKS & MITIGATION

| Risiko                     | Dampak                             | Mitigasi              |
| -------------------------- | ---------------------------------- | --------------------- |
| Jaringan terputus          | Display tidak menerima event       | Gunakan jaringan LAN  |
| Server mati                | Semua layanan berhenti             | Backup dan monitoring |
| Petugas belum terbiasa     | Kesalahan penggunaan               | Training              |
| Audio tidak jelas          | Panggilan tidak terdengar          | Speaker eksternal     |
| Informasi tidak diperbarui | Masyarakat menerima informasi lama | CMS Admin             |
| Listrik mati               | Sistem tidak tersedia              | UPS                   |
| Database rusak             | Kehilangan data                    | Backup berkala        |

---

# 30. DEPLOYMENT ARCHITECTURE

Untuk tahap awal KKL, sistem dapat ditempatkan pada server lokal kantor.

```text
                 LOCAL NETWORK
                       │
             ┌─────────┴─────────┐
             │                   │
          Server              Client
             │                   │
      Laravel + MySQL       Browser
             │                   │
       Laravel Reverb       ┌────┼──────────┐
                            │    │          │
                         Admin Petugas   Display
```

Contoh:

```text
Server:
192.168.1.100

Admin:
192.168.1.100/admin

Petugas:
192.168.1.100/petugas

Display:
192.168.1.100/display

Ambil Antrian:
192.168.1.100/queue/take
```

---

# 31. DEVELOPMENT ROADMAP

## PHASE 1 — Analysis

* observasi;
* wawancara petugas;
* validasi kebutuhan;
* identifikasi layanan;
* identifikasi loket;
* dokumentasi proses existing.

## PHASE 2 — System Design

* use case;
* user flow;
* ERD;
* database design;
* architecture;
* wireframe;
* UI design.

## PHASE 3 — Laravel Foundation

* setup Laravel;
* konfigurasi database;
* authentication;
* role management;
* layout;
* Tailwind;
* Livewire.

## PHASE 4 — Queue System

* service;
* counter;
* queue;
* generate number;
* call;
* recall;
* skip;
* complete.

## PHASE 5 — Public Display

* monitor UI;
* real-time update;
* WebSocket/Reverb;
* audio;
* information carousel.

## PHASE 6 — CMS

* service information;
* requirements;
* IKD;
* announcement;
* display content.

## PHASE 7 — Statistics

* dashboard;
* daily statistics;
* service statistics;
* history.

## PHASE 8 — Testing

* functional testing;
* integration testing;
* real-time testing;
* usability testing;
* UAT.

## PHASE 9 — Deployment

* server setup;
* LAN configuration;
* display setup;
* training petugas.

---

# 32. MVP DEFINITION

MVP dianggap selesai apabila sistem mampu menjalankan:

```text
Masyarakat
     ↓
Pilih Layanan
     ↓
Ambil Nomor
     ↓
Menunggu
     ↓
Petugas Login
     ↓
Panggil Nomor
     ↓
Laravel Event
     ↓
Laravel Reverb
     ↓
Public Display
     ↓
Audio
     ↓
Masyarakat Menuju Loket
     ↓
Pelayanan
     ↓
Selesai
```

Serta admin dapat mengelola:

```text
Layanan
Loket
Petugas
Informasi
IKD
Pengumuman
Display
Statistik
```

---

# 33. SUCCESS METRICS

## Operational

* jumlah antrean;
* jumlah antrean selesai;
* jumlah antrean dilewati;
* waktu tunggu;
* waktu pelayanan.

## Information

* jumlah layanan yang memiliki informasi;
* jumlah konten IKD;
* jumlah pengumuman aktif.

## User Experience

Sistem dianggap berhasil apabila:

* masyarakat dapat mengetahui antrean melalui monitor;
* masyarakat dapat mengetahui persyaratan tanpa harus selalu bertanya;
* petugas dapat mengelola antrean secara digital;
* nomor antrean tampil secara real-time;
* informasi dapat diperbarui tanpa mengubah kode program.

---

# 34. FUTURE ROADMAP

## Version 2

* QR Code nomor antrean;
* estimasi waktu tunggu;
* riwayat antrean masyarakat;
* survey kepuasan;
* laporan PDF/Excel;
* multi-loket yang lebih fleksibel.

## Version 3

* antrean online;
* notifikasi WhatsApp;
* booking jadwal;
* dashboard pimpinan.

## Version 4

* integrasi layanan digital;
* integrasi sistem pemerintah apabila tersedia dan diizinkan;
* smart display;
* analitik pelayanan.

---

# 35. FEATURE PRIORITY

| Priority | Feature               |
| -------- | --------------------- |
| P0       | Authentication        |
| P0       | Generate Queue        |
| P0       | Queue Calling         |
| P0       | Public Display        |
| P0       | Real-Time             |
| P0       | Audio                 |
| P0       | Service Information   |
| P0       | IKD Information       |
| P1       | Announcement          |
| P1       | Counter Management    |
| P1       | User Management       |
| P1       | Statistics            |
| P2       | QR Code               |
| P2       | Survey                |
| P2       | Online Queue          |
| P3       | WhatsApp Notification |

**P0:** Wajib MVP
**P1:** Prioritas setelah MVP
**P2:** Pengembangan berikutnya
**P3:** Future Feature

---

# 36. PRODUCT SUCCESS DEFINITION

SIAP Panakkukang dianggap berhasil apabila:

1. masyarakat dapat mengambil nomor antrean dengan mudah;
2. petugas dapat mengelola antrean melalui browser;
3. nomor antrean dapat ditampilkan secara real-time;
4. sistem dapat memutar audio pemanggilan;
5. monitor menampilkan informasi pelayanan;
6. informasi IKD dapat diakses pada display;
7. admin dapat memperbarui informasi;
8. statistik pelayanan tersedia;
9. seluruh sistem dapat dioperasikan melalui browser tanpa aplikasi mobile.

---

# 37. PRODUCT STATEMENT

> **SIAP Panakkukang adalah sistem informasi pelayanan berbasis web yang mengintegrasikan pengelolaan antrean, pemanggilan nomor secara real-time, audio announcement, dan media informasi pelayanan untuk membantu masyarakat dan petugas dalam proses pelayanan pada Kantor Kecamatan Panakkukang.**

---

# 38. FINAL PRODUCT VISION

### KONDISI SEBELUM SISTEM

```text
Monitor Statis
       +
Antrean Manual
       +
Informasi dari Petugas
```

### KONDISI SETELAH SISTEM

```text
Digital Queue
       +
Real-Time Display
       +
Audio Calling
       +
Service Information
       +
IKD Information
       +
Announcement
       +
Statistics
```

### Tagline

> **“Menunggu Lebih Tertib, Informasi Lebih Jelas, Pelayanan Lebih Efektif.”**

---

# 39. DEVELOPMENT DOCUMENT ROADMAP

Setelah PRD ini, dokumentasi teknis proyek dilanjutkan dengan:

```text
01 Product Vision
02 PRD
03 User Flow
04 Use Case Diagram
05 Activity Diagram
06 System Architecture
07 ERD
08 Database Schema
09 Laravel Architecture
10 UI/UX Design System
11 Wireframe
12 High-Fidelity UI
13 Component Library
14 WebSocket Specification
15 Testing Plan
16 Deployment Guide
17 User Manual
```

Dokumen-dokumen tersebut menjadi blueprint utama sebelum tahap coding dimulai.
