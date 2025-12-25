# Panduan Mengganti Warna Template Mazer

## 📋 Daftar Isi
1. [Pengenalan](#pengenalan)
2. [Cara Cepat](#cara-cepat)
3. [Cara Detail](#cara-detail)
4. [Contoh Warna](#contoh-warna)
5. [Troubleshooting](#troubleshooting)

---

## 🎨 Pengenalan

Template Mazer menggunakan **CSS Variables (Custom Properties)** untuk mengatur warna tema. Ini memudahkan kita untuk mengganti warna tanpa harus mengedit file CSS utama.

### Warna yang Bisa Diubah:
- **Primary** (Warna Utama) - Default: Biru `#435ebe`
- **Secondary** (Warna Sekunder) - Default: Abu-abu `#6c757d`
- **Success** (Sukses) - Default: Hijau `#198754`
- **Info** (Informasi) - Default: Cyan `#0dcaf0`
- **Warning** (Peringatan) - Default: Kuning `#ffc107`
- **Danger** (Bahaya) - Default: Merah `#dc3545`

---

## ⚡ Cara Cepat

### Langkah 1: Buka File Custom CSS
File sudah dibuat di: `public/custom/css/custom_mazer_colors.css`

### Langkah 2: Pilih Warna
Uncomment (hapus `/*` dan `*/`) salah satu contoh warna yang sudah disediakan:

```css
/* CONTOH 1: Warna Hijau (Cocok untuk Koperasi) */
:root {
    --bs-primary: #28a745;
    --bs-primary-rgb: 40, 167, 69;
    --bs-primary-text-emphasis: #0f3d1a;
    --bs-primary-bg-subtle: #d4edda;
    --bs-primary-border-subtle: #a9d9b5;
    --bs-link-color: #28a745;
    --bs-link-hover-color: #218838;
}
```

### Langkah 3: Include di Layout
Tambahkan di file layout utama (setelah `app.css`):

```html
<link rel="stylesheet" href="{{ asset('custom/css/custom_mazer_colors.css') }}">
```

### Langkah 4: Refresh Browser
Tekan `Ctrl + F5` untuk hard refresh dan lihat perubahannya!

---

## 🔧 Cara Detail

### Membuat Warna Custom Sendiri

#### 1. Pilih Warna Utama
Gunakan color picker atau pilih dari website seperti:
- [Coolors.co](https://coolors.co/)
- [Adobe Color](https://color.adobe.com/)
- [Material Design Colors](https://materialui.co/colors)

Contoh: Kita pilih warna **Teal** `#009688`

#### 2. Konversi ke RGB
Gunakan [ColorHexa](https://www.colorhexa.com/) atau Chrome DevTools

**Teal** `#009688` = `rgb(0, 150, 136)`

#### 3. Buat Variasi Warna

Anda perlu membuat 5 variasi warna:

| Variasi | Keterangan | Cara Membuat |
|---------|------------|--------------|
| **Primary** | Warna utama | Warna yang Anda pilih |
| **Text Emphasis** | Untuk teks | Buat lebih gelap 60-70% |
| **BG Subtle** | Background terang | Buat lebih terang 90-95% |
| **Border Subtle** | Border | Buat lebih terang 70-80% |
| **Hover** | Saat di-hover | Buat lebih gelap 10-15% |

**Tool untuk membuat variasi:**
- [Tint & Shade Generator](https://maketintsandshades.com/)
- [Color Shades Generator](https://www.0to255.com/)

#### 4. Tulis CSS Variables

```css
:root {
    /* Warna Utama */
    --bs-primary: #009688;
    --bs-primary-rgb: 0, 150, 136;
    
    /* Variasi */
    --bs-primary-text-emphasis: #00332e;  /* Gelap untuk teks */
    --bs-primary-bg-subtle: #e0f2f1;      /* Sangat terang untuk background */
    --bs-primary-border-subtle: #b2dfdb;  /* Terang untuk border */
    
    /* Link */
    --bs-link-color: #009688;
    --bs-link-hover-color: #00796b;       /* Sedikit lebih gelap */
}
```

---

## 🎨 Contoh Warna

### 1. Hijau Koperasi (Recommended untuk KUD)
```css
:root {
    --bs-primary: #28a745;
    --bs-primary-rgb: 40, 167, 69;
    --bs-primary-text-emphasis: #0f3d1a;
    --bs-primary-bg-subtle: #d4edda;
    --bs-primary-border-subtle: #a9d9b5;
    --bs-link-color: #28a745;
    --bs-link-hover-color: #218838;
}
```

### 2. Merah Marun (Elegan)
```css
:root {
    --bs-primary: #8b2635;
    --bs-primary-rgb: 139, 38, 53;
    --bs-primary-text-emphasis: #3a1016;
    --bs-primary-bg-subtle: #f0d5d9;
    --bs-primary-border-subtle: #d9a5ad;
    --bs-link-color: #8b2635;
    --bs-link-hover-color: #6d1e2a;
}
```

### 3. Biru Tua (Professional)
```css
:root {
    --bs-primary: #003d82;
    --bs-primary-rgb: 0, 61, 130;
    --bs-primary-text-emphasis: #001a37;
    --bs-primary-bg-subtle: #ccd9e8;
    --bs-primary-border-subtle: #99b3d1;
    --bs-link-color: #003d82;
    --bs-link-hover-color: #002a5c;
}
```

### 4. Orange (Energik)
```css
:root {
    --bs-primary: #ff6b35;
    --bs-primary-rgb: 255, 107, 53;
    --bs-primary-text-emphasis: #662b15;
    --bs-primary-bg-subtle: #ffe0d5;
    --bs-primary-border-subtle: #ffc1ab;
    --bs-link-color: #ff6b35;
    --bs-link-hover-color: #e55a2b;
}
```

### 5. Ungu (Modern)
```css
:root {
    --bs-primary: #6f42c1;
    --bs-primary-rgb: 111, 66, 193;
    --bs-primary-text-emphasis: #2d1a4d;
    --bs-primary-bg-subtle: #e7dff7;
    --bs-primary-border-subtle: #cfbfef;
    --bs-link-color: #6f42c1;
    --bs-link-hover-color: #59359a;
}
```

---

## 🎯 Komponen yang Terpengaruh

Ketika Anda mengubah `--bs-primary`, komponen berikut akan berubah warnanya:

✅ Tombol Primary (`.btn-primary`)  
✅ Link/Tautan  
✅ Sidebar menu aktif  
✅ Progress bar  
✅ Badge primary  
✅ Alert primary  
✅ Form focus state  
✅ Checkbox/Radio yang dicentang  
✅ Pagination aktif  
✅ Semua komponen Bootstrap yang menggunakan warna primary  

---

## 🌙 Dark Mode

Jika ingin warna berbeda untuk dark mode:

```css
/* Light Mode */
:root {
    --bs-primary: #28a745;
}

/* Dark Mode */
[data-bs-theme="dark"] {
    --bs-primary: #4ade80;  /* Warna lebih terang untuk dark mode */
}
```

---

## 🎨 Warna Khusus Per Komponen

### Sidebar Saja
```css
#sidebar {
    --bs-primary: #ff6b35;
}
```

### Navbar Saja
```css
.navbar {
    --bs-primary: #6f42c1;
}
```

### Card Tertentu
```css
.card.special {
    --bs-primary: #003d82;
}
```

---

## ❗ Troubleshooting

### Warna Tidak Berubah?

1. **Pastikan file CSS sudah di-include**
   ```html
   <link rel="stylesheet" href="{{ asset('custom/css/custom_mazer_colors.css') }}">
   ```

2. **Pastikan urutan CSS benar**
   File custom harus SETELAH `app.css`:
   ```html
   <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('custom/css/custom_mazer_colors.css') }}">
   ```

3. **Clear cache browser**
   - Chrome/Edge: `Ctrl + Shift + Delete`
   - Atau hard refresh: `Ctrl + F5`

4. **Periksa console browser**
   - Buka DevTools (F12)
   - Lihat tab Console untuk error
   - Lihat tab Network untuk memastikan file ter-load

5. **Pastikan syntax CSS benar**
   - Tidak ada typo
   - Semua kurung kurawal `{}` tertutup
   - Titik koma `;` di akhir setiap property

### Warna Tidak Sesuai Harapan?

1. **Cek kontras warna**
   Gunakan [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/)
   - Minimal kontras 4.5:1 untuk teks normal
   - Minimal kontras 3:1 untuk teks besar

2. **Test di berbagai komponen**
   Buka halaman dengan berbagai komponen untuk melihat hasilnya

3. **Sesuaikan variasi warna**
   Jika warna terlalu terang/gelap, sesuaikan nilai:
   - `text-emphasis`: lebih gelap
   - `bg-subtle`: lebih terang
   - `border-subtle`: di tengah-tengah

---

## 📚 Referensi

### Tools Berguna:
- [Coolors](https://coolors.co/) - Generator palet warna
- [ColorHexa](https://www.colorhexa.com/) - Konversi warna
- [Adobe Color](https://color.adobe.com/) - Color wheel
- [Material Colors](https://materialui.co/colors) - Material Design colors
- [Contrast Checker](https://webaim.org/resources/contrastchecker/) - Cek kontras

### Dokumentasi:
- [Bootstrap Colors](https://getbootstrap.com/docs/5.3/customize/color/)
- [CSS Variables](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)
- [Mazer Documentation](https://zuramai.github.io/mazer/)

---

## 💡 Tips

1. **Konsisten dengan brand**
   Gunakan warna yang sesuai dengan logo/brand perusahaan

2. **Jangan terlalu banyak warna**
   Cukup ubah primary, sisanya biarkan default

3. **Test aksesibilitas**
   Pastikan warna mudah dibaca oleh semua orang

4. **Simpan kode warna**
   Dokumentasikan warna yang Anda gunakan untuk referensi

5. **Backup file**
   Sebelum mengubah, backup file CSS original

---

## 📞 Butuh Bantuan?

Jika masih ada kesulitan, silakan:
1. Periksa console browser (F12)
2. Cek file sudah ter-include dengan benar
3. Pastikan syntax CSS tidak ada error
4. Coba dengan contoh warna yang sudah disediakan dulu

---

**Selamat mencoba! 🎨**
