# PERSIAPAN PENGEMBANGAN MINI SITE AUDIO - PROYEK ABUABU

## TUJUAN
Membuat layout struktural yang berbeda secara fundamental (bukan hanya perubahan warna) untuk mini site audio sambil menjaga fungsionalitas inti (browsing, filtering, download, wishlist).

## FAKTA STRUKTUR SAAT INI (OBSERVASI)
- Routes audio terdefinisi di web.php dengan prefix '/browse/audio'
- Controller AudioStoreController menangani index, artists, artist, genre, newReleases, show, download
- Data berasal dari AudioStore::albums() (database atau config)
- Views saat ini menggunakan layout aplikasi umum (resources/views/layouts/app.blade.php kemungkinan besar)
- Tailwind digunakan untuk styling dengan kelas utility standar

## RENCANA PHASE 1: PERSIAPAN DASAR
1. **Pemetaan file terkait audio** (sudah dilakukan di atas)
2. **Identifikasi titik integrasi layout**:
   - Di mana layout dipilih? (Controller? View?)
   - Apakah ada mekanisme untuk melewarkan variabel layout ke views?
3. **Analisis struktur view audio saat ini**:
   - Apakah menggunakan @extends('layouts.app') atau serupa?
   - Bagaimana konten diorganisasikan? (sections, komponen)
4. **Siapkan struktur direktori baru** (untuk implementasi nanti):
   ```
   resources/
     views/
       layouts/
         audio.blade.php   # Layout khusus audio
       sections/
         audio/
           index.blade.php
           show.blade.php
           artist.blade.php
           genre.blade.php
           new.blade.php
           download.blade.php
   ```
5. **Rencana perubahan struktural (bukan hanya warna)**:
   - Audio: Layout dengan sidebar filter kiri yang dapat disembunyikan + area konten utama yang responsif
   - Fokus pada perbedaan struktur HTML (flex vs grid vs block) dan hierarki visual

## TINDAKAN SEKARANG YANG DAPAT DILAKUKAN (TANPA MODIFIKASI FILE)
1. **Observasi kode existing**:
   - Buka `resources/views/audio/index.blade.php` dan catat struktur HTML saat ini
   - Perhatikan penggunaan kelas Tailwind (flex, grid, spacing, tipografi)
   - Identifikasi bagian yang bisa dipertahankan (logika data, loop album) vs yang perlu diubah (struktur layout)

2. **Buat sketsa kertas untuk layout audio baru**:
   - Header: Apakah tetap menggunakan navigasi global atau versi khusus audio?
   - Sidebar: Filter genre, pencarian, navigasi kunstenaar
   - Konten utama: Kartu album dengan hover efek misterius
   - Footer: Informasi minimal atau elemen "absurd" kecil
   - Responsivitas: Bagaimana berubah di mobile?

3. **Persiapan pertanyaan untuk klarifikasi lebih lanjut**:
   - Apakah navigasi global harus tetap ada di semua section, atau audio bisa memiliki navigasi sendiri yang lebih khusus?
   - Sejauh mana elemen "absurd" boleh mengganggu fungsi utama? (Misalnya: apakah navigasi yang hilang sampai setelah 3 detik tidak beraktivitas masih diterima?)
   - Apakah ada batasan waktu muat yang ketat untuk mini site ini?

## LANJUTAN SETELAH PHASE 1
Setelah Phase 1 selesai (paham struktur esistensi dan memiliki sketsa layout), langkah berikutnya akan meliputi:
- Implementasi layout audio dasar di resources/views/layouts/audio.blade.php
- Modifikasi satu view audio (misalnya index.blade.php) untuk menggunakan layout baru
- Verifikasi bahwa semua fungsi inti tetap bekerja
- Pengulangan berdasarkan pengalaman sebelum menerapkan ke semua view audio

## CATATAN KONDISI AWAL
File ini dibuat sebagai bagian dari persiapan Phase 1 untuk mini site audio.
Perubahan struktural akan dilakukan setelah pemahaman struktur kode yang cukup.
Fokus utama: membedakan struktural layout antara section audio, reading, dan tools.