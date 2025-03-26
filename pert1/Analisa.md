# Analisa Terkait Nginx

## Apa itu Nginx?
Nginx adalah web server yang memiliki performa tinggi dengan fitur lengkap yang mudah dikonfigurasi. Nginx dirancang untuk menangani lalu lintas tinggi dan sering digunakan oleh website besar seperti Google, Netflix, Adobe, dan Cloudflare. 

## Bagaimana Nginx bekerja?
Nginx bekerja dengan menangani ribuan permintaan secara efisien. Saat pengguna mengakses situs web, browser mengirimkan permintaan ke server, yang kemudian mencari file yang diminta dan mengirimkannya kembali ke browser. Nginx mampu menangani banyak koneksi secara simultan dengan performa yang stabil. 

## Kapan Nginx digunakan?
Nginx digunakan untuk website yang membutuhkan server dengan kemampuan menangani ribuan permintaan dengan lalu lintas tinggi. 

## Kelebihan Nginx
1. **Multifungsi**: Dapat digunakan sebagai web server, load balancer, cache konten, dan proxy server.
2. **Pengganti hardware load balancer**: Lebih murah dan mudah dikonfigurasi dibandingkan hardware load balancer.
3. **Dokumentasi lengkap**: Menyediakan tutorial dan panduan yang mudah diikuti. 
4. **Pengembangan berkelanjutan**: Terus berkembang mengikuti perkembangan teknologi. blog/))

## Kekurangan Nginx
1. **Kompatibilitas terbatas**: Performa kurang optimal di Windows dan tidak mendukung beberapa sistem operasi tertentu.
2. **Dukungan komunitas terbatas**: Dokumentasi dan referensi masih kalah dibandingkan Apache. 

---

# Analisa Terkait Docker

## Apa itu Docker?
Docker adalah layanan untuk mengemas dan menjalankan aplikasi dalam lingkungan terisolasi yang disebut container. Dengan isolasi yang baik, Docker memungkinkan menjalankan banyak container secara bersamaan pada satu host. 

## Mengapa menggunakan Docker?
Docker memudahkan dalam menjalankan aplikasi di berbagai lingkungan tanpa perlu khawatir dengan perbedaan sistem. Aplikasi dikemas dalam satu paket yang siap dijalankan di mana saja, sehingga proses pengembangan dan deployment lebih efisien. 
## Kapan menggunakan Docker?
Docker digunakan untuk membangun dan mengelola aplikasi modern berbasis layanan mikro serta sistem pemrosesan data yang skalabel. 

## Kelebihan Docker
1. **Portabilitas**: Dapat dipindahkan antar lingkungan dengan mudah.
2. **Isolasi**: Memastikan keamanan antara sistem host dan aplikasi dalam container. 
3. **Efisiensi**: Lebih ringan dibandingkan mesin virtual.
4. **Scalability**: Dapat menangani beban lalu lintas tinggi dengan mudah. 

## Kekurangan Docker
1. **Proses pembelajaran yang cukup lama**.
2. **Menambah kompleksitas dalam pengelolaan aplikasi**.
3. **Overhead sumber daya dalam penggunaan disk dan memori**. 

---

# Konfigurasi `docker-compose.yml` dengan Nginx

## `docker-compose.yml` dan `.env`

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

```env
COMPOSE_PROJECT_NAME=esgul
REPOSITORY_NAME=pemweb
IMAGE_TAG=latest
```

### Penjelasan Konfigurasi
- `version`: Menentukan versi docker-compose.
- `services`: Menentukan layanan yang dijalankan, dalam hal ini `web`.
- `image`: Menggunakan image Nginx versi terbaru.
- `ports`: Meneruskan port 80 di host ke container.
- `volumes`: Menghubungkan direktori di host dengan container untuk mempermudah pengelolaan file.

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

Penjelasan tambahan:
- `location /latihan` menangani permintaan ke `/latihan` dan mencari file yang sesuai.
- `alias` mengarahkan ke folder latihan.
- `try_files` menangani permintaan file dengan fallback ke 404 jika tidak ditemukan.

---

# Analisa Terkait HTML

## 1. Tag `<div>`
Digunakan untuk mengelompokkan elemen dalam halaman web. 

## 2. Tag `<a>`
Digunakan untuk membuat hyperlink ke halaman lain. 

## 3. Tag `<form>`
Digunakan untuk mengelompokkan elemen dalam formulir. 

## 4. Tag `<h1>` - `<h6>`
Digunakan untuk heading dari yang terbesar (`h1`) hingga terkecil (`h6`). 

## 5. Tag `<img>`
Digunakan untuk menampilkan gambar pada halaman web. 

## 6. Tag `<p>`
Digunakan untuk menampilkan paragraf. 

## 7. Tag `<ul>` dan `<li>`
Digunakan untuk membuat daftar tidak berurutan. 

---

# Referensi
1. https://nginx.org/en/
2. https://www.nginx.com/resources/wiki/
3. https://docs.nginx.com/
4. https://docs.docker.com/get-started/overview/
5. https://www.docker.com/resources/what-container/
6. https://developer.mozilla.org/en-US/docs/Web/HTML

