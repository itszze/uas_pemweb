# Catatan Terkait Nginx, Docker, dan HTML

## Nginx
Nginx adalah web server yang memiliki performa tinggi, sering digunakan oleh situs besar seperti Google dan Netflix. Keunggulannya meliputi kemampuan sebagai load balancer, caching, dan proxy server.

**Kelebihan:**
- Dapat menangani ribuan koneksi simultan
- Dokumentasi lengkap
- Terus berkembang mengikuti teknologi

**Kekurangan:**
- Kurang optimal di Windows
- Dukungan komunitas lebih kecil dibanding Apache

**Referensi:**
- [Nginx Official](https://nginx.org/en/)
- [Nginx Wiki](https://www.nginx.com/resources/wiki/)

---

## Docker
Docker adalah teknologi container yang mempermudah deployment aplikasi dalam lingkungan yang terisolasi.

**Kelebihan:**
- Portabilitas tinggi
- Isolasi aplikasi lebih baik
- Efisiensi penggunaan sumber daya

**Kekurangan:**
- Membutuhkan waktu untuk mempelajari konsepnya
- Menambah kompleksitas dalam pengelolaan

**Referensi:**
- [Docker Docs](https://docs.docker.com/get-started/overview/)
- [Docker Containers](https://www.docker.com/resources/what-container/)

---

## Konfigurasi `docker-compose.yml` dengan Nginx

```yaml
version: '3'

services:
  web:
    image: nginx:latest
    ports:
      - "80:80"
    volumes:
      - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf
      - ./src/:/usr/share/nginx/html
      - ./latihan:/usr/share/nginx/html/latihan
```

## `nginx.conf`
```nginx
server {
    listen 80;
    server_name localhost;
    root /usr/share/nginx/html;
    index index.html index.htm;
    
    location / {
        try_files $uri $uri/ =404;
    }
    
    location /latihan {
        alias /usr/share/nginx/html/latihan;
        index index.html index.htm home.html;
        try_files $uri $uri.html $uri/ =404;
    }
}
```

---

## HTML
**Tag HTML penting:**
1. `<div>` - Mengelompokkan elemen dalam halaman web
2. `<a>` - Membuat hyperlink ke halaman lain
3. `<form>` - Mengelola input pengguna
4. `<h1>` - `<h6>` - Heading dengan berbagai tingkat
5. `<img>` - Menampilkan gambar
6. `<p>` - Paragraf teks
7. `<ul>` dan `<li>` - Membuat daftar tidak berurutan

**Referensi:**
- [MDN - HTML Elements](https://developer.mozilla.org/en-US/docs/Web/HTML)

