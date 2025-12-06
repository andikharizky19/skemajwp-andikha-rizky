# Aplikasi To-Do List PHP

Aplikasi To-Do List sederhana berbasis PHP dengan struktur kode modular dan tampilan menggunakan Bootstrap.

## struktur Folder

todolist/
-  index.php         
-  style.css         

## Fitur Aplikasi

- Tambah tugas baru
- Ubah status tugas (belum / selesai) dengan checkbox
- Hapus tugas
- Data tersimpan sementara di session (tanpa database)
- Struktur modular dan rapi
- Menggunakan Bootstrap 5

## Cara Menjalankan

1. **Install XAMPP** (jika belum punya)
2. Simpan seluruh file dalam folder `htdocs/todolist`
3. Aktifkan `Apache` melalui XAMPP
4. Buka browser dan akses:
   ```
   http://localhost/todolist
   ```

## Penjelasan File

### `index.php`
- Menyimpan data ke dalam `$_SESSION`
- Menyediakan fungsi `getTasks()`, `addTask()`, `toggleStatus()`, `deleteTask()`
- Memproses permintaan dari form (`POST/GET`)
- Menangani logika perubahan data
- Mengatur redirect
- Menampilkan form dan daftar tugas
- Menggunakan komponen Bootstrap
- Tidak mengandung logika pemrosesan data

### `index.php`
- File ini berisi styling untuk memperindah tampilan

## Teknologi yang Digunakan

- PHP 7+
- HTML5 & Bootstrap 5
- Session sebagai penyimpanan sementara

## Catatan

- Data akan hilang setelah session berakhir (misal browser ditutup)
- Untuk menyimpan data permanen, gunakan file `.json` atau database (fitur lanjutan)

## Pengembang

Andikha Rizky 

