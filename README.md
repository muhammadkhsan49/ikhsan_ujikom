# Sistem Pendaftaran Calon Anggota Brimob

Aplikasi web modern untuk mengelola pendaftaran calon anggota Brigade Mobil (Brimob) Polri dengan fitur verifikasi, penjadwalan seleksi, dan sistem notifikasi real-time.

## 🎯 Fitur Utama

### Untuk Calon Peserta (User)
- ✅ Registrasi akun dengan email dan password
- ✅ Formulir pendaftaran multi-section yang lengkap:
  - Data Pribadi (nama, NIK, tempat/tanggal lahir)
  - Alamat Tinggal & Asal
  - Riwayat Pendidikan
  - Data Kesehatan & Fisik
  - Kontak Darurat
  - Upload Dokumen (KTP, Ijazah, Foto, Surat Kesehatan, dll)
- ✅ Riwayat pendaftaran dengan status tracking
- ✅ Unduh/Cetak sertifikat dalam format PDF
- ✅ Sistem notifikasi untuk update status
- ✅ Dashboard dengan statistik pendaftaran
- ✅ Dark theme dengan interface modern

### Untuk Admin
- ✅ Dashboard dengan statistik real-time
- ✅ Verifikasi pendaftaran (Terima/Tolak)
- ✅ Manajemen jadwal seleksi (6 tahap: Registrasi, Tes Kesehatan, Fisik, Psikologi, Wawancara, Hasil Akhir)
- ✅ Sistem notifikasi untuk peserta
- ✅ Export data ke Excel & PDF
- ✅ Riwayat notifikasi lengkap
- ✅ Sidebar navigasi yang user-friendly

## 🛠️ Stack Teknologi

- **Backend**: Laravel 11 (PHP Framework)
- **Database**: MySQL 8.0+
- **Frontend**: Bootstrap 5.3, Blade Template Engine
- **Export**: DomPDF (PDF), Laravel Excel (Excel)
- **Server**: Apache (XAMPP)
- **Authentication**: Laravel Built-in Auth dengan Role-based Access Control

## 📋 Sistem Database

### Entity Relationship Diagram (ERD)

```
                          ┌─────────────────┐
                          │     USERS       │
                          ├─────────────────┤
                          │ id (PK)         │
                          │ name            │
                          │ email (UNIQUE)  │
                          │ password        │
                          │ role (ENUM)     │
                          │ created_at      │
                          │ updated_at      │
                          └────────┬────────┘
                                   │
                    ┌──────────────┼──────────────┐
                    │              │              │
                    │ 1:∞          │ 1:∞          │ 1:∞
                    ▼              ▼              ▼
        ┌─────────────────────┐  ┌──────────────────────┐  ┌──────────────────┐
        │  REGISTRATIONS      │  │  NOTIFICATIONS       │  │ (jika ada relasi │
        ├─────────────────────┤  ├──────────────────────┤  │  dengan schedule)│
        │ id (PK)             │  │ id (PK)              │  │                  │
        │ user_id (FK)   ─────┼──┤ user_id (FK)    ─────┼──│ 1:∞ USERS        │
        │ registration_number │  │ registration_id (FK) │  │                  │
        │ status (ENUM)       │  │ title                │  │ SELECTION_       │
        │ full_name           │  │ message              │  │ SCHEDULES        │
        │ nik (UNIQUE)        │  │ type                 │  ├──────────────────┤
        │ email               │  │ is_read              │  │ id (PK)          │
        │ phone_number        │  │ read_at              │  │ title            │
        │ gender              │  │ created_at           │  │ stage (ENUM)     │
        │ date_of_birth       │  │ updated_at           │  │ start_date       │
        │ place_of_birth      │  └──────────────────────┘  │ end_date         │
        │ street_address      │                             │ location         │
        │ village             │                             │ quota            │
        │ district            │                             │ description      │
        │ regency             │                             │ created_at       │
        │ province            │                             │ updated_at       │
        │ postal_code         │                             └──────────────────┘
        │ education_level     │
        │ school_name         │
        │ major               │
        │ graduation_year     │
        │ height              │
        │ weight              │
        │ emergency_contact_* │
        │ verified_by         │
        │ verified_at         │
        │ verification_notes  │
        │ rejection_reason    │
        │ created_at          │
        │ updated_at          │
        └────────┬────────────┘
                 │
                 │ 1:∞
                 ▼
        ┌─────────────────────┐
        │    DOCUMENTS        │
        ├─────────────────────┤
        │ id (PK)             │
        │ registration_id (FK)│
        │ document_type       │
        │ file_path           │
        │ original_filename   │
        │ created_at          │
        │ updated_at          │
        └─────────────────────┘
```

### Penjelasan Relasi

| Relasi | From | To | Keterangan |
|--------|------|-----|-----------|
| **1:∞** | users | registrations | 1 pengguna bisa punya banyak pendaftaran |
| **1:∞** | users | notifications | 1 pengguna bisa punya banyak notifikasi |
| **1:∞** | registrations | documents | 1 pendaftaran bisa punya banyak dokumen |
| **1:∞** | registrations | notifications | 1 pendaftaran bisa trigger banyak notifikasi |
| **∞:1** | notifications | users | Banyak notifikasi untuk 1 pengguna |
| **Independent** | selection_schedules | - | Tabel independen untuk jadwal tahapan seleksi |

### Tabel & Kolom Lengkap

#### 1. **users**
```
id (PK)                    - INT, Primary Key
name                       - VARCHAR(255)
email (UNIQUE)             - VARCHAR(255), Unique
email_verified_at          - TIMESTAMP, Nullable
password                   - VARCHAR(255)
role (ENUM)                - ENUM('user', 'admin'), Default: 'user'
remember_token             - VARCHAR(100), Nullable
created_at                 - TIMESTAMP
updated_at                 - TIMESTAMP
```

#### 2. **registrations**
```
id (PK)                    - BIGINT, Primary Key
user_id (FK)               - BIGINT, Foreign Key → users.id
registration_number        - VARCHAR(255), Unique
status (ENUM)              - ENUM('draft', 'submitted', 'verified', 'rejected')

─── DATA DIRI ───
full_name                  - VARCHAR(255)
gender                     - VARCHAR(20)
date_of_birth              - DATE
place_of_birth             - VARCHAR(255)
nik                        - VARCHAR(255), Unique
phone_number               - VARCHAR(20)
email                      - VARCHAR(255)

─── ALAMAT ───
street_address             - TEXT
village                    - VARCHAR(255)
district                   - VARCHAR(255)
regency                    - VARCHAR(255)
province                   - VARCHAR(255)
postal_code                - VARCHAR(10)

─── PENDIDIKAN ───
education_level            - VARCHAR(100)
school_name                - VARCHAR(255)
major                      - VARCHAR(255), Nullable
graduation_year            - YEAR

─── FISIK ───
height                     - DECIMAL(5,2), cm
weight                     - DECIMAL(5,2), kg

─── KONTAK DARURAT ───
emergency_contact_name     - VARCHAR(255)
emergency_contact_relationship - VARCHAR(100)
emergency_contact_phone    - VARCHAR(20)

─── VERIFIKASI ───
verified_by                - VARCHAR(255), Nullable
verified_at                - TIMESTAMP, Nullable
verification_notes         - TEXT, Nullable
rejection_reason           - TEXT, Nullable

created_at                 - TIMESTAMP
updated_at                 - TIMESTAMP
```

#### 3. **documents**
```
id (PK)                    - BIGINT, Primary Key
registration_id (FK)       - BIGINT, Foreign Key → registrations.id
document_type (ENUM)       - ENUM('ktp', 'ijazah', 'foto_formal', 'surat_kesehatan')
file_path                  - VARCHAR(255)
original_filename          - VARCHAR(255)
created_at                 - TIMESTAMP
updated_at                 - TIMESTAMP
```

#### 4. **selection_schedules**
```
id (PK)                    - BIGINT, Primary Key
title                      - VARCHAR(255)
description                - TEXT, Nullable
start_date                 - DATETIME
end_date                   - DATETIME
stage (ENUM)               - ENUM('registrasi', 'tes_kesehatan', 'tes_fisik', 
                             'tes_psikologi', 'wawancara', 'hasil_akhir')
location                   - TEXT, Nullable
quota                      - INT, Nullable
created_at                 - TIMESTAMP
updated_at                 - TIMESTAMP
```

#### 5. **notifications**
```
id (PK)                    - BIGINT, Primary Key
user_id (FK)               - BIGINT, Foreign Key → users.id
registration_id (FK)       - BIGINT, Foreign Key → registrations.id, Nullable
title                      - VARCHAR(255)
message                    - TEXT
type                       - VARCHAR(100), Default: 'info' (info/warning/success/error)
is_read                    - BOOLEAN, Default: false
read_at                    - TIMESTAMP, Nullable
created_at                 - TIMESTAMP
updated_at                 - TIMESTAMP
```

#### 6. **password_reset_tokens** (Sistem)
```
email (PK)                 - VARCHAR(255)
token                      - VARCHAR(255)
created_at                 - TIMESTAMP, Nullable
```

#### 7. **sessions** (Sistem)
```
id (PK)                    - VARCHAR(255)
user_id (FK)               - BIGINT, Nullable
ip_address                 - VARCHAR(45), Nullable
user_agent                 - TEXT, Nullable
payload                    - LONGTEXT
last_activity              - INT
```

### Constraints & Relationships
- **Cascade Delete**: Ketika user/registration dihapus, semua related records (registrations, documents, notifications) otomatis terhapus
- **Unique Constraints**: `users.email`, `registrations.nik`, `registrations.registration_number`
- **Foreign Key Constraints**: Semua FK memiliki `ON DELETE CASCADE`

## 🚀 Instalasi

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Composer
- XAMPP atau Web Server lainnya
- Git

### Langkah Instalasi

#### 1. Clone Repository
```bash
git clone https://github.com/muhammadkhsan49/ikhsan_ujikom.git
cd pendaftaran_brimob
```

#### 2. Install Dependencies
```bash
composer install
```

#### 3. Setup File Environment
```bash
cp .env.example .env
```

Kemudian edit `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=brimob
DB_USERNAME=root
DB_PASSWORD=
```

#### 4. Generate Application Key
```bash
php artisan key:generate
```

#### 5. Buat Database
Buat database MySQL dengan nama `brimob`:
```bash
mysql -u root -p
CREATE DATABASE brimob;
EXIT;
```

#### 6. Jalankan Migration & Seeding
```bash
php artisan migrate --seed
```

Ini akan membuat semua tabel dan mengisi data demo.

#### 7. Link Storage (untuk upload dokumen)
```bash
php artisan storage:link
```

#### 8. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

## 📱 Cara Penggunaan

### Login Demo

#### Akun Admin
```
Email: admin@brimob.com
Password: password123
```

#### Akun User
```
Email: john@example.com
Password: password123

Email: jane@example.com
Password: password123
```

### Navigasi User (Peserta)
1. **Dashboard** - Lihat status pendaftaran dan tombol aksi
2. **Buat Pendaftaran Baru** - Isi formulir pendaftaran lengkap
3. **Riwayat Pendaftaran** - Lihat semua pendaftaran dan statusnya
4. **Notifikasi** - Terima update status dari admin
5. **Cetak Sertifikat** - Download sertifikat PDF setelah terverifikasi

### Navigasi Admin
1. **Dashboard** - Lihat statistik (Total, Pending, Verified, Rejected)
2. **Verifikasi Pendaftar** - Review dan approve/reject aplikasi
3. **Jadwal Seleksi** - Kelola 6 tahapan seleksi
4. **Notifikasi** - Kirim notifikasi ke peserta
5. **Export** - Download data dalam format Excel atau PDF

## 🎨 Tema Design

Aplikasi menggunakan **Dark Theme Modern** dengan palet warna:
- **Primary**: #000000 (Hitam)
- **Accent**: #fbbf24 (Gold/Kuning)
- **Success**: #10b981 (Hijau)
- **Danger**: #ef4444 (Merah)

Interface responsif dan optimal di desktop, tablet, dan mobile.

## 📁 Struktur Direktori

```
pendaftaran_brimob/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Kontroller aplikasi
│   │   └── Middleware/           # Custom middleware
│   ├── Models/                    # Eloquent Models
│   ├── Policies/                  # Authorization Policies
│   └── Exports/                   # Excel Export Classes
├── database/
│   ├── migrations/                # Skema database
│   ├── factories/                 # Model factories
│   └── seeders/                   # Database seeders
├── resources/
│   ├── views/                     # Blade templates
│   │   ├── auth/                  # Login/Register
│   │   ├── admin/                 # Admin panel
│   │   ├── user/                  # User dashboard
│   │   └── layouts/               # Layout templates
│   ├── css/                       # CSS files
│   └── js/                        # JavaScript files
├── routes/
│   └── web.php                    # Route definitions
├── config/                        # Konfigurasi aplikasi
├── storage/                       # File uploads & logs
└── public/                        # Aset publik
```

## 🔧 Konfigurasi Penting

### File `.env`
```env
APP_NAME="Pendaftaran Brimob"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=brimob
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=noreply@brimob.go.id
MAIL_FROM_NAME="Pendaftaran Brimob"
```

## 🚨 Troubleshooting

### Database Connection Error
```bash
# Pastikan MySQL sudah running
# Di XAMPP, klik start pada MySQL

# Cek konfigurasi .env
# Cek credentials database di .env
```

### Permission Denied pada Storage
```bash
# Berikan permission ke folder storage
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### Composer Dependencies Error
```bash
# Clear composer cache
composer clear-cache

# Re-install dependencies
composer install
```

### Page Blank/Error 500
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📊 Routes & Endpoints

### Public Routes
- `GET /` - Landing page
- `POST /register` - Register user baru
- `POST /login` - Login user

### User Routes (Protected)
- `GET /dashboard` - User dashboard
- `GET /registration/create` - Form pendaftaran
- `POST /registration` - Submit pendaftaran
- `GET /registration/history` - Riwayat pendaftaran
- `GET /registration/{id}` - Detail pendaftaran
- `GET /registration/{id}/pdf` - Download sertifikat PDF
- `GET /notifications` - Notifikasi user

### Admin Routes (Protected)
- `GET /admin` - Admin dashboard
- `GET /admin/verification` - List pendaftaran untuk verifikasi
- `GET /admin/verification/{id}` - Detail pendaftaran
- `POST /admin/verification/{id}/verify` - Approve pendaftaran
- `POST /admin/verification/{id}/reject` - Reject pendaftaran
- `GET /admin/schedules` - Jadwal seleksi
- `POST /admin/schedules` - Buat jadwal baru
- `GET /admin/notifications` - Riwayat notifikasi
- `GET /admin/export/excel` - Export Excel
- `GET /admin/export/pdf` - Export PDF

## 📝 License

Copyright © 2025 Sistem Pendaftaran Brimob. All rights reserved.

## 👨‍💻 Developer

Dikembangkan untuk kebutuhan pendaftaran calon anggota Brigade Mobil (Brimob) Polri.

Untuk informasi lebih lanjut atau pertanyaan, hubungi admin@brimob.go.id

---

**Last Updated**: November 2025
