<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Auth System - Laravel

Sistem autentikasi lengkap dengan Laravel yang mendukung login email/password dan Google OAuth.

## Fitur

- ✅ Login dengan email dan password
- ✅ Login dengan Google OAuth
- ✅ Database integration
- ✅ Session management
- ✅ Responsive UI dengan Tailwind CSS
- ✅ Dashboard user
- ✅ Logout functionality

## Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL/PostgreSQL/SQLite
- Google OAuth credentials

## Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd authsystem
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Configuration
Copy file `.env.example` ke `.env` dan sesuaikan konfigurasi:

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan:
```env
APP_NAME="Auth System"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=authsystem
DB_USERNAME=root
DB_PASSWORD=

# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Database Setup
```bash
php artisan migrate
```

### 6. Google OAuth Setup

#### Langkah 1: Buat Google Cloud Project
1. Kunjungi [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih yang sudah ada
3. Aktifkan Google+ API

#### Langkah 2: Buat OAuth 2.0 Credentials
1. Buka "Credentials" di sidebar
2. Klik "Create Credentials" → "OAuth 2.0 Client IDs"
3. Pilih "Web application"
4. Isi "Authorized redirect URIs" dengan: `http://localhost:8000/auth/google/callback`
5. Copy Client ID dan Client Secret

#### Langkah 3: Update .env
```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 7. Jalankan Application
```bash
php artisan serve
```

Buka browser dan kunjungi: `http://localhost:8000`

## Struktur Database

### Users Table
- `id` - Primary key
- `name` - Nama user
- `email` - Email user (unique)
- `password` - Password hash (nullable untuk social login)
- `google_id` - Google OAuth ID (nullable)
- `google_token` - Google access token (nullable)
- `google_refresh_token` - Google refresh token (nullable)
- `avatar` - URL avatar (nullable)
- `email_verified_at` - Timestamp verifikasi email
- `remember_token` - Remember me token
- `created_at` - Timestamp pembuatan
- `updated_at` - Timestamp update

## Routes

### Public Routes
- `GET /` - Welcome page
- `GET /login` - Login form
- `POST /login` - Login process
- `GET /auth/google` - Redirect ke Google OAuth
- `GET /auth/google/callback` - Google OAuth callback

### Protected Routes
- `GET /dashboard` - User dashboard
- `POST /logout` - Logout process

## Penggunaan

### Login dengan Email/Password
1. Buka `/login`
2. Masukkan email dan password
3. Klik "Masuk"

### Login dengan Google
1. Buka `/login`
2. Klik "Masuk dengan Google"
3. Pilih akun Google
4. Authorize aplikasi

### Dashboard
Setelah login berhasil, user akan diarahkan ke dashboard yang menampilkan:
- Informasi profil
- Metode login yang digunakan
- Status verifikasi akun
- Fitur yang tersedia

## Customization

### UI Styling
- Gunakan Tailwind CSS classes untuk styling
- Edit file di `resources/views/`
- Gunakan Font Awesome untuk icons

### Database
- Edit migrations di `database/migrations/`
- Edit User model di `app/Models/User.php`

### Authentication Logic
- Edit AuthController di `app/Http/Controllers/AuthController.php`
- Edit routes di `routes/web.php`

## Troubleshooting

### Error "Class 'Laravel\Socialite\SocialiteServiceProvider' not found"
```bash
composer require laravel/socialite
```

### Error "Invalid redirect URI"
- Pastikan redirect URI di Google Cloud Console sama dengan di `.env`
- Pastikan tidak ada trailing slash

### Database connection error
- Pastikan database sudah dibuat
- Periksa konfigurasi database di `.env`
- Pastikan service database berjalan

### Google OAuth error
- Periksa Client ID dan Client Secret
- Pastikan Google+ API sudah diaktifkan
- Periksa redirect URI

## Security Notes

- Jangan commit file `.env` ke repository
- Gunakan HTTPS di production
- Validasi semua input user
- Implement rate limiting untuk login attempts
- Gunakan strong passwords

## License

MIT License
