Web Travel - Fullstack Laravel

Web Travel ini adalah aplikasi fullstack yang dibuat menggunakan Laravel sebagai backend dan Tailwind CSS untuk tampilan frontend. Database yang digunakan adalah PostgreSQL.

Sebelum memulai setup, pastikan kamu sudah menginstal:
PHP >= 8.1
Composer
Laravel
PostgreSQL

Cara Setup Project :
1️. Clone Repository
2. Install Dependencies Laravel
    -  composer install
3. Sesuaikan File .env
   - DB_CONNECTION=pgsql
   - DB_HOST=127.0.0.1
   - DB_PORT=5432
   - DB_DATABASE=nama_database
   - DB_USERNAME=nama_user
   - DB_PASSWORD=password
4. Generate Key
    - php artisan key:generate
5. Jalankan Migrasi Database
    - php artisan migrate --seed
6. Jalankan Server Laravel
    - php artisan serve


Autentikasi & Token
1️. Registrasi Akun Admin
   Buat akun admin di database secara manual atau melalui fitur registrasi.
2️. Login & Simpan Token
   Saat login, API akan mengembalikan token. Simpan token ini di LocalStorage agar bisa mengakses API yang dilindungi.
   - localStorage.setItem("auth_token", data.token);
3️. Menggunakan Token untuk API
  Gunakan token di Authorization Header saat mengambil data:
  fetch("/api/travel", {
  method: "GET",
  headers: {
    "Authorization": "Bearer " + localStorage.getItem("auth_token"),
    "Accept": "application/json"
    }
  })
