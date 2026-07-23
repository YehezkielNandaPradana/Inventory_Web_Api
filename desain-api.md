# Design System — Stokku (Versi Web)

**Tema:** Biru Muda & Putih · Clean · Modern
**Target:** Web app (admin dashboard) — sistem inventory
**Turunan dari:** Design System mobile (Flutter) — palet & prinsip sama, layout disesuaikan untuk layar lebar

---

## 1. Filosofi Desain

Prinsip inti tetap sama dengan versi mobile: *"data dulu, hiasan kemudian."* Tapi konteks pemakaian berbeda — di web, admin biasanya bekerja lebih lama di satu layar, sering butuh **melihat daftar dan detail barang sekaligus**, bukan berpindah-pindah layar seperti di HP.

Karena itu versi web menambahkan satu prinsip baru: **"list dan detail hidup berdampingan."** Layar dibagi jadi dua kolom — daftar barang di kiri (area kerja utama) dan panel detail di kanan (referensi cepat) — supaya admin tidak perlu bolak-balik klik untuk cek detail satu barang.

---

## 2. Color Palette

Sama persis dengan versi mobile, tidak ada token baru:

| Token | Hex | Penggunaan |
|---|---|---|
| `primary-blue` | `#2D7DD2` | Sidebar aktif, tombol utama, border fokus |
| `sky-blue` | `#5FA8E0` | Ikon ilustrasi kosong, aksen sekunder |
| `light-blue-bg` | `#EAF4FF` | Background sidebar hover, input, track capsule bar |
| `pure-white` | `#FFFFFF` | Background dasar, card, modal |
| `navy-text` | `#1B2B4B` | Judul, teks penting |
| `slate-text` | `#6B7A99` | Label, caption, placeholder |
| `success-green` | `#4CAF93` | Status "Stok Aman" |
| `warning-amber` | `#F2A93B` | Status "Stok Menipis" |
| `danger-red` | `#E5534B` | Status "Stok Habis" |

Tambahan khusus web: warna status dipakai juga sebagai `--status-color` (CSS custom property) yang di-*inject* per komponen, jadi satu badge/card/bar otomatis ambil warna yang tepat tanpa class terpisah untuk tiap status.

---

## 3. Tipografi

Sama seperti mobile — Poppins untuk judul, Inter untuk body & angka:

| Role | Font | Ukuran | Weight | Dipakai di |
|---|---|---|---|---|
| Judul Halaman (H1) | Poppins | 24sp | SemiBold | "Halo, Admin 👋" |
| Judul Panel (H2) | Poppins | 18sp | SemiBold | Judul modal |
| Judul Card/Item (H3) | Poppins | 15sp | Medium | Nama barang di card & detail |
| Angka Statistik | Poppins | 26sp | SemiBold | Stat card (Total Barang, dst) |
| Body / Deskripsi | Inter | 14sp | Regular | Kategori, deskripsi |
| Angka Stok (data) | Inter (tabular nums) | 16–20sp | SemiBold | Jumlah stok |
| Caption / label | Inter | 12sp | Medium/SemiBold | Label field, eyebrow tanggal |

---

## 4. Layout & Grid

Struktur khas web dua-kolom, tidak ada di versi mobile:

```
┌───────────┬──────────────────────────────────────────┐
│           │  Topbar (greeting · search · notif)       │
│  Sidebar  ├──────────────────────────────────────────┤
│  232px    │  Stat cards (4 kolom)                     │
│  fixed    ├──────────────────────────────────────────┤
│           │  Toolbar (tab filter · search · tambah)   │
│           ├───────────────────────────┬────────────────┤
│           │  Grid Item (auto-fill)    │  Detail Panel  │
│           │  min 260px per card       │  340px, sticky │
└───────────┴───────────────────────────┴────────────────┘
```

- Basis grid tetap **8px**, spacing memakai skala 4/8/12/16/24/32/40.
- Sidebar: lebar tetap 232px, `position: sticky`, tidak ikut scroll bersama konten.
- Grid item barang: `auto-fill, minmax(260px, 1fr)` — jumlah kolom menyesuaikan lebar layar otomatis.
- Panel detail: lebar tetap 340px di desktop, `position: sticky` supaya tetap terlihat saat daftar di-scroll.

**Breakpoint:**
| Lebar layar | Perubahan |
|---|---|
| `> 1080px` | Layout penuh 2 kolom (list + detail berdampingan) |
| `761px – 1080px` | Stat card jadi 2 kolom, detail panel berubah jadi bottom sheet (muncul saat item diklik) |
| `≤ 760px` | Sidebar hilang, digantikan bottom navigation + tombol FAB tambah barang (mengikuti pola mobile asli) |

---

## 5. Spacing & Radius

Identik dengan versi mobile:
- Card: radius `16px`, shadow biru lembut `rgba(45,125,210,0.08)`
- Tombol: radius `12px`
- Input field: radius `10px`
- Badge / pill status / tab filter: full-round

---

## 6. Komponen Utama (Web)

**Sidebar Navigation**
- Background putih, item aktif mendapat background `light-blue-bg` + teks/ikon `primary-blue`
- Logo "Stokku" di atas, kartu profil admin kecil di bagian bawah

**Topbar**
- Sapaan personal ("Halo, Admin 👋") + tanggal hari ini di atasnya
- Search bar global, tombol notifikasi (dengan dot indikator), avatar

**Stat Card**
- 4 kartu ringkasan: Total Barang, Stok Aman, Stok Menipis, Stok Habis
- Ikon berwarna sesuai kategori (biru netral untuk total, hijau/kuning/merah untuk status)

**Toolbar (Tab Filter + Aksi)**
- Tab pill "Semua / Stok Aman / Menipis / Habis" untuk memfilter daftar
- Search kecil khusus daftar barang + tombol utama "Tambah Barang"

**Item Card**
- Garis aksen kiri sesuai status (warisan langsung dari card mobile)
- Nama, kategori, jumlah stok, capsule bar, badge status
- Efek hover: naik 3px + shadow membesar; klik untuk memilih (border biru menyala saat terpilih)

**Detail Panel**
- Foto placeholder, nama & kategori, badge status, capsule bar besar, tombol "Edit Barang" (outline) dan "Kurangi Stok" (filled)
- Sticky di desktop; jadi bottom sheet yang slide-up di layar sempit, dengan scrim gelap di belakangnya

**Modal Tambah / Edit Barang**
- Field: Nama Barang, Kategori, Jumlah Stok, Stok Minimum
- Style input sesuai spesifikasi asli: label di atas, background `light-blue-bg`, border biru 1.5px saat fokus

**Empty State**
- Border putus-putus (dashed) biru muda, ilustrasi ikon kotak outline, teks ajakan aksi + tombol "Tambah Barang Pertama"

**Mobile Bottom Nav**
- Muncul hanya di layar sempit, meniru pola bottom nav Flutter asli lengkap dengan tombol FAB "+" di tengah

---

## 7. Ikonografi

- Tetap gaya **outline/line icon**, stroke 2px, ujung garis rounded (`stroke-linecap: round`)
- Dibuat custom sebagai inline SVG (bukan icon font/library luar) supaya ringan dan mudah diwarnai lewat `currentColor`
- Set ikon yang dipakai: home, package (kotak), barcode/scan, check (aman), alert (menipis), x (habis), search, bell, user, edit, minus, close, photo, chevron

---

## 8. Elemen Signature — Capsule Progress Bar

Elemen ini **tetap jadi identitas visual utama**, persis seperti di mobile, dan justru makin sering muncul karena di web dia dipakai di dua ukuran:
- **Versi kecil (8px tinggi)** — di setiap item card dalam daftar
- **Versi besar (10px tinggi)** — di panel detail, sebagai fokus utama info stok

Warna isi bar mengikuti status secara otomatis (hijau → kuning → merah), track selalu `light-blue-bg`, dan transisi lebar bar dianimasikan halus (`0.5s ease`) setiap kali stok berubah — misalnya saat tombol "Kurangi Stok" ditekan.

---

## 9. Interaksi & Motion

- Item card: fade-in bertahap saat halaman dimuat (staggered, delay 0.02s–0.24s per kartu)
- Hover card: naik 3px + shadow membesar
- Modal & bottom sheet: fade + scale/slide masuk-keluar (0.2–0.3s)
- Semua animasi dinonaktifkan otomatis jika sistem pengguna mengaktifkan `prefers-reduced-motion`

---

## 10. Do's & Don'ts

**Do:**
- Biarkan putih tetap mendominasi background utama, biru sebagai aksen (aturan mobile tetap berlaku di web)
- Gunakan panel detail untuk info mendalam, jangan bebani item card dengan terlalu banyak data
- Konsisten pakai capsule bar di setiap tempat yang menampilkan jumlah stok, baik ukuran kecil maupun besar

**Don't:**
- Jangan buat sidebar lebih dari 1 warna aksen aktif — hanya `primary-blue`
- Jangan ubah warna status untuk elemen non-stok (badge notifikasi, dsb tetap pakai warna netral)
- Jangan hilangkan bottom nav di mobile hanya karena versi web pakai sidebar — dua pola ini sengaja dipertahankan berbeda per device

---

## 11. File Terkait

- `stokku.html` — implementasi lengkap (HTML/CSS/JS satu file, tanpa dependency berat) yang merealisasikan seluruh spesifikasi di atas, siap dijadikan referensi atau dipecah menjadi Blade layout untuk backend Laravel.
