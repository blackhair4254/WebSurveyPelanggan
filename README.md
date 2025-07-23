# Survey Kepuasan Pelanggan

Web Survey untuk mengukur kualitas perusahaan berdasarkan kepuasan pelanggan, web ini dapat menerima survey dari pelanggan dan karyawan dapat melihat hasil survey yang dilakukan pelanggan.

## 🚀 Fitur
- Input survey kepuasan pelanggan
- Login Karyawan
- Tampilan hasil survey per-responden
- Score CSAT berdasar ISO 9001
- Edit dan hapus survey

---

## 🛠️ Cara Menjalankan Proyek Ini

Ikuti langkah langkah berikut untuk menjalankan web secara local :

```zsh(MacOS)
-- Start Terminal --

git clone https://github.com/blackhair4254/WebSurveyPelanggan.git
cd WebSurveyPelanggan
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate

-- End Terminal --

-- Buka Folder WebSurveyPelanggan menggunakan VS Code --
edit file .env lalu cari bagian berikut dan ubah seperti dibawah ini *note : username dan password sesuaikan dengan milik anda :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=survey_kepuasan_pelanggan
DB_USERNAME=root
DB_PASSWORD=
-- End Folder --

-- Start Terminal --

php artisan migrate --seed
Would you like to create it? -> pilih "yes"
php artisan serve
npm run dev

-- End Terminal --

Regards,

Naufal Alifiansyah S
