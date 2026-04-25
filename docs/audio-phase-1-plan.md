# RENCANA PENGEMBANGAN MINI SITE AUDIO - PROYEK ABUABU

## TUJUAN
Membuat layout struktural yang berbeda secara fundamental (bukan hanya perubahan warna) untuk mini site audio sambil menjaga fungsionalitas inti (browsing, filtering, download, wishlist) dengan nuansa misterius dan absurd yang tetap ramah pengguna.

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

## RENCANA PHASE 2: IMPLEMENTASI DASAR
1. **Implementasi efek halus pada halaman detail audio** (show.blade.php):
   - Pergeseran gradien latar belakang ultra-pelan (animate-[shift_120s_linear_infinite])
   - Gerakan mikro pada judul dan artist (title-float, artist-float classes dengan keyframes)
   - Tombol wishlist dengan label naratif dan hover transform (wishlist-btn class)
   - Tambahkan style block untuk keyframes di bagian bawah file
2. **Verifikasi fungsionalitas inti tetap utuh**:
   - Tombol unduhan tetap bekerja dan jelas
   - Navigasi kembali ke katalog tetap fungsional
   - Semua informasi album tetap terbaca dan aksesibel
3. **Testing dasar**:
   - Cek tampilan di browser desktop (Chrome/Firefox)
   - Pastikan tidak ada error console
   - Verifikasi bahwa halaman tetap responsif

## RENCANA PHASE 3: PERLUASAN KE SEMUA VIEW AUDIO
1. **Apply efek serupa ke view audio lainnya**:
   - index.blade.php: Tambahkan efek latar belakang halus, mikro-interaksi pada kartu album
   - artist.blade.php: Efek latar belakang, tipografi fluid pada nama kunstenaar
   - genre.blade.php: Efet latar belakang, interaksi pada filter/tombol
   - new.blade.php: Efek latar belakang, interaksi pada daftar album baru
2. **Konsistensi efek**:
   - Gunakan variasi tema yang sama (kecepatan gerakan, intensitas transformasi) untuk menciptakan kesatuan
   - Sesuaikan intensitas efek berdasarkan konteks halaman (misalnya: lebih subtil di index, lebih ekspresif di show)
3. **Optimasi**:
   - Gabungkan style block ke dalam satu tempat jika memungkinkan untuk menghindari duplikasi
   - Pertimbangkan menggunakan variabel CSS untuk nilai yang sering diubah (kecepatan animasi, magnitudo transformasi)

## RENCANA PHASE 4: REFINEMENT DAN PENGUJIAN
1. **Uji coba pengguna**:
   - Ajak minimal 2-3 pengguna untuk mencoba fitur utama (browsing, filtering, detail, download)
   - Kumpulkan feedback tentang apakah efek mengganggu atau just menambah kesan
   - Perhatikan khususnya pengguna yang sensitif terhadap gerakan visual
2. **Pengujian perangkat dan browser**:
   - Uji di browser berbeda (Chrome, Firefox, Safari, Edge)
   - Uji di perangkat mobile dengan berbagai ukuran layar
   - Periksa performa pada perangkat dengan spesifikasi menengah-ke-bawah
3. **Penyesuaian berdasarkan feedback**:
   - Kurangi intensitas efek jika terasa mengganggu
   - Tambahkan opsi reduced motion jika diperlukan (menggunakan prefers-reduced-media)
   - Pastikan semua tetap bekerja dengan baik pada koneksi internet lambat
4. **Audit aksesibilitas**:
   - Periksa kontras warna tetap memenuhi standar WCAG
   - Verifikasi bahwa semua elemen interaktif masih memiliki fokus terlihat yang jelas
   - Pastikan teks tetap bisa diperbesar tanpa menghancurkan layout

## RENCANA PHASE 5: DOKUMENTASI DAN PENYELESAIAN
1. **Update dokumentasi teknis**:
   - Catat perubahan yang telah dilakukan di file ini (audio-phase-1-plan.md)
   - Tambahkan catatan tentang bagaimana efek diimplementasikan untuk referensi masa depan
   - Dokumentasikan library atau teknik khusus yang digunakan (jika ada)
2. **Review final**:
   - Bandingkan dengan tujuan awal: misterius/absurd namun tetap ramah pengguna
   - Pastikan tidak ada perubahan yang mengubah fungsionalitas inti
   - Verifikasi bahwa perbedaan struktural antara section audio, reading, dan tools tercapai
3. **Persiapan untuk fase berikutnya**:
   - Rencanakan aplikasi konsep serupa ke mini site reading dan tools
   - Catat pelajaran yang dapat dipakai untuk section-section lain
   - Siapkan rencana untuk monitoring penggunaan dan feedback pasca-luncur

## CATATAN KONDISI AWAL
File ini dibuat sebagai bagian dari persiapan Phase 1 untuk mini site audio.
Perubahan struktural akan dilakukan setelah pemahaman struktur kode yang cukup.
Fokus utama: membedakan struktural layout antara section audio, reading, dan tools.