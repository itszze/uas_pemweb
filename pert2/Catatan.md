# Topik: Website dan Teknologi Pendukungnya

Setiap situs web memiliki alamat unik, seperti google.com, yang disebut sebagai domain. Domain ini berfungsi sebagai identitas yang memungkinkan pengguna mengakses situs secara publik.
---

# HTML

HTML adalah bahasa standar yang digunakan untuk mengembangkan website.

## Elemen `<div>` pada HTML

Tag `<div>` digunakan untuk mengelompokkan elemen-elemen HTML lainnya. Contoh penggunaannya:

```html
<div>
    Ini adalah elemen div.
    <p>Paragraf di dalam elemen div.</p>
</div>
```

## Tag `<a>` (Anchor)

Tag ini digunakan untuk membuat hyperlink ke halaman lain. Contohnya:

```html
<a href="https://example.com">Kunjungi situs</a>
```

---

# Kegunaan Docker

Docker digunakan untuk menjalankan aplikasi, database, dan Nginx. Docker lebih mudah dikonfigurasi antara Windows dan VPS dibandingkan dengan XAMPP.

## A. Struktur `docker-compose.yml`

- `version`: Menentukan versi docker-compose yang digunakan.
- `services`: Menentukan layanan yang akan dijalankan.
  - `web`: Layanan ini menggunakan Nginx versi terbaru (`latest`).
  - `ports`: Menentukan port yang digunakan, misalnya `80:80`.
  - `volumes`: Menghubungkan direktori di dalam container dengan sistem host untuk penyimpanan data.

## B. Konfigurasi `nginx.conf`

- Nginx adalah web server yang dapat digunakan sebagai pengganti XAMPP. Selain itu, Nginx memiliki cakupan lebih luas seperti load balancing.
- Port yang digunakan dapat disesuaikan dengan pengaturan `listen` di `docker-compose.yml`.

---

# Analisis

Dalam analisis, minimal harus mencakup metode 5W + 1H serta analisis SWOT. Beberapa contoh pertanyaan yang dapat digunakan:

- **Apa itu Docker?** (What)
- **Kapan Docker digunakan?** (When)
- **Di mana Docker bisa diterapkan?** (Where)
- **Siapa yang menggunakan Docker?** (Who)
- **Mengapa Docker penting?** (Why)
- **Bagaimana cara kerja Docker?** (How)

Namun, tidak semua elemen 5W + 1H harus digunakan, melainkan hanya yang relevan dengan kebutuhan.

---

# Hal yang Wajib Dilakukan

Dalam setiap sesi, harus ada tiga komponen utama yang dikerjakan:
1. **Analisis**
2. **Coding (ngoding)**
3. **Catatan**

Semua hasil tersebut harus dikumpulkan kepada Pak Jep sebelum meninggalkan sesi. Jika tidak dikumpulkan, maka tidak diperbolehkan untuk keluar kelas.

---

# Project

- **Project Sebelum UTS:** Membuat website company profile.
- **Project Akhir:** Setiap mahasiswa mendapatkan kasus yang berbeda-beda dan harus mengembangkan website berdasarkan analisis yang telah dibuat.
- **Kriteria Penilaian:**
  - Kesesuaian antara analisis dan hasil akhir website.
  - Kualitas clean code.

---

# Sumber Referensi

Jika menggunakan kode, template, plugin, atau sumber lain dari pihak ketiga, pastikan untuk mencantumkan sumbernya dengan jelas agar tidak melanggar etika akademik dan profesional.

