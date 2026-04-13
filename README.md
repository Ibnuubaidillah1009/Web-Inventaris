# Web-Inventaris

A comprehensive web-based inventory management system designed to efficiently track and manage various types of assets, consumables, and related operations within an organization. This system provides robust API endpoints for seamless integration with frontend applications.

## Fitur Utama

*   **Manajemen Aset Tetap:** Pencatatan, pembaruan, dan pelacakan aset tetap.
*   **Manajemen Barang Habis Pakai (Consumable):** Pengelolaan stok, pencatatan masuk dan keluar barang.
*   **Peminjaman Aset:** Sistem untuk meminjamkan dan mengembalikan aset.
*   **Mutasi Aset:** Pelacakan perubahan lokasi atau status aset.
*   **Pemusnahan Aset:** Pencatatan proses pemusnahan aset.
*   **Stock Opname:** Fitur untuk melakukan audit dan verifikasi stok barang.
*   **Manajemen Supplier:** Pencatatan dan pengelolaan data pemasok.
*   **Manajemen Lokasi:** Organisasi aset berdasarkan lokasi fisik (gedung, ruangan).
*   **Autentikasi API:** Sistem login berbasis token menggunakan Laravel Sanctum.

## Teknologi yang Digunakan

*   **Backend:** PHP 8+
    *   **Framework:** Laravel
    *   **Database:** MySQL
    *   **Autentikasi API:** Laravel Sanctum

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek secara lokal:

1.  **Clone Repository:**
    ```bash
    git clone https://github.com/Ibnuubaidillah1009/Web-Inventaris
    cd Web-Inventaris
    ```

2.  **Instal Dependensi Backend:**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment:**
    *   Salin file `.env.example` ke `.env`:
        ```bash
        cp .env.example .env
        ```
    *   Edit file `.env` dan sesuaikan koneksi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`), serta konfigurasi lainnya.
    *   Generate application key:
        ```bash
        php artisan key:generate
        ```

4.  **Migrasi Database dan Seeder (Opsional):**
    *   Jalankan migrasi database untuk membuat tabel:
        ```bash
        php artisan migrate
        ```
    *   Jika ada data awal yang ingin dimasukkan, jalankan seeder:
        ```bash
        php artisan db:seed
        ```

5.  **Instal Dependensi Frontend:**
    ```bash
    npm install
    ```

6.  **Jalankan Vite (untuk pengembangan):**
    *   Untuk mengkompilasi aset frontend dan menjalankannya di development server:
        ```bash
        npm run dev
        ```
    *   Untuk membangun aset frontend untuk produksi:
        ```bash
        npm run build
        ```

7.  **Jalankan Server Backend:**
    ```bash
    php artisan serve
    ```

Aplikasi backend akan berjalan di `http://127.0.0.1:8000` secara default. Frontend dapat diakses melalui URL yang disediakan oleh Vite atau jika Anda memiliki aplikasi frontend terpisah.

## Penggunaan API

Semua endpoint API didefinisikan dalam file `routes/api.php`. Anda bisa menggunakan Postman, Insomnia, atau klien HTTP lainnya untuk berinteraksi dengan API ini.

Contoh Alur:
1.  **Registrasi/Login User:** Gunakan endpoint `/api/register` atau `/api/login` untuk mendapatkan token autentikasi (Sanctum).
2.  **Akses Endpoint Terlindungi:** Sertakan token autentikasi di header permintaan sebagai `Authorization: Bearer <your_token>`.

## Struktur Proyek

*   `app/Http/Controllers/Api`: Berisi kontroler untuk API, diorganisir berdasarkan modul (Asset, Borrowing, Consumable, dll).
*   `app/Http/Requests`: Validasi permintaan HTTP.
*   `app/Http/Resources`: Transformasi model menjadi format JSON yang optimal untuk API.
*   `app/Models`: Definisi model Eloquent untuk representasi data database.
*   `database/migrations`: Skema database.
*   `routes/api.php`: Definisi endpoint API.
*   `resources/js`, `resources/css`: File sumber frontend.
*   `public`: Direktori aset yang dapat diakses publik.

---
