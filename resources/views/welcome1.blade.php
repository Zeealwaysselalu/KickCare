<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>KickCare – Beranda</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<!-- ── NAV ── -->
<nav>
  <a class="logo" href="#">
    <div class="logo-icon">
      <svg viewBox="0 0 24 24"><path d="M20.5 10.5c-.28 0-.5.22-.5.5v1h-1v-1.5A4.5 4.5 0 0 0 14.5 6h-5A4.5 4.5 0 0 0 5 10.5V12H4v-1a.5.5 0 0 0-1 0v4a.5.5 0 0 0 1 0v-1h1v1.5A4.5 4.5 0 0 0 9.5 20h5a4.5 4.5 0 0 0 4.5-4.5V14h1v1a.5.5 0 0 0 1 0v-4a.5.5 0 0 0-.5-.5zM17 15.5A2.5 2.5 0 0 1 14.5 18h-5A2.5 2.5 0 0 1 7 15.5v-5A2.5 2.5 0 0 1 9.5 8h5A2.5 2.5 0 0 1 17 10.5v5z"/></svg>
    </div>
    <div class="logo-text">
      <strong>KickCare</strong>
      <span>Premium Shoe &amp; Repair Services</span>
    </div>
  </a>
  <ul class="nav-links">
    <li><a href="wel" class="active">Beranda</a></li>
    <li><a href="status">Cek Status</a></li>
    <li><a href="login" class="btn-login">Login</a></li>
  </ul>
</nav>

<!-- ── HERO ── -->
<section class="hero-section">
  <div class="container">
    <div class="hero-row">
      <div class="hero-text">
        <h1>Sepatu Rusak atau kotor?<br>Kami bikin baru lagi!</h1>
        <p>Membersihkan dan merepair<br>sepatu oleh KickCare</p>
        <a href="#" class="btn-pesan">Pesan Sekarang</a>
      </div>
      <div class="hero-image">
        <div class="before-after">
          <span class="ba-label left">Sebelum</span>
          <span class="ba-label right">Sesudah</span>
          <div class="ba-divider"></div>
          <!-- Dirty side -->
          <div class="ba-side dirty">
            <svg class="shoe-svg" viewBox="0 0 120 70" fill="none">
              <ellipse cx="60" cy="52" rx="52" ry="12" fill="#8B5E3C" opacity=".4"/>
              <path d="M10 50 Q20 30 50 28 Q80 26 100 38 Q110 44 108 52 Q90 58 60 60 Q30 60 10 50Z" fill="#7B4A22"/>
              <path d="M50 28 Q55 15 70 14 Q85 13 95 22 Q100 28 100 38" fill="#6B3A18"/>
              <path d="M55 28 L58 16 M65 27 L66 14 M75 28 L78 17" stroke="#5A2E10" stroke-width="1.5" opacity=".6"/>
              <path d="M10 50 Q30 44 60 44 Q90 44 108 50" stroke="#5A2E10" stroke-width="1" opacity=".5"/>
            </svg>
          </div>
          <!-- Clean side -->
          <div class="ba-side clean">
            <svg class="shoe-svg" viewBox="0 0 120 70" fill="none">
              <ellipse cx="60" cy="52" rx="52" ry="12" fill="#B0C8E8" opacity=".35"/>
              <path d="M10 50 Q20 30 50 28 Q80 26 100 38 Q110 44 108 52 Q90 58 60 60 Q30 60 10 50Z" fill="#E8EFF8"/>
              <path d="M50 28 Q55 15 70 14 Q85 13 95 22 Q100 28 100 38" fill="#D0DCF0"/>
              <path d="M55 28 L58 16 M65 27 L66 14 M75 28 L78 17" stroke="#A0B8D8" stroke-width="1.5" opacity=".7"/>
              <path d="M10 50 Q30 44 60 44 Q90 44 108 50" stroke="#A0B8D8" stroke-width="1" opacity=".5"/>
              <path d="M12 48 Q60 42 107 48" stroke="white" stroke-width="2" opacity=".6"/>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── KATEGORI LAYANAN ── -->
<section class="kategori-section">
  <div class="container">
    <div class="section-header">
      <h2>Kategori Layanan</h2>
      <div class="underline-bar"></div>
      <p>Kami membedakan penanganan berdasarkan kebutuhan sepatu Anda.</p>
    </div>
    <div class="layanan-grid">

      <div class="layanan-card">
        <div class="layanan-icon-box">
          <svg viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 0 0-2 2v4m6-6h10a2 2 0 0 1 2 2v4M9 3v18m0 0h10a2 2 0 0 0 2-2v-4M9 21H5a2 2 0 0 1-2-2v-4m0 0h18"/><circle cx="12" cy="12" r="3"/></svg>
          <span>Sepatunya di Bakar</span>
        </div>
        <p class="layanan-desc">Pencucian mendetail, anti-bakteri, dan penghilangan noda membandel.</p>
      </div>

      <div class="layanan-card">
        <div class="layanan-icon-box">
          <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
          <span>Repair &amp; Reglue</span>
        </div>
        <p class="layanan-desc">Jahit sol, reglue (lem ulang), hingga penambalan kulit yang robek.</p>
      </div>

      <div class="layanan-card">
        <div class="layanan-icon-box">
          <svg viewBox="0 0 24 24"><path d="M2 13.5V19a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5.5"/><path d="M2 13.5A10.5 10.5 0 0 0 12 21a10.5 10.5 0 0 0 10-7.5"/><path d="M12 3v10M8 7l4-4 4 4"/></svg>
          <span>Repaint &amp; Un yellowing</span>
        </div>
        <p class="layanan-desc">Kembalikan warna asli yang pudar atau ganti warna baru (Custom).</p>
      </div>

    </div>
  </div>
</section>

<!-- ── GALERI WORKSHOP ── -->
<section class="galeri-section">
  <div class="container">
    <div class="section-header">
      <h2>Galeri Workshop Kami</h2>
      <div class="underline-bar"></div>
    </div>
    <div class="galeri-grid">

      <div class="galeri-card">
        <div class="galeri-placeholder">
          <svg viewBox="0 0 24 24" fill="none" stroke="#1A8FE3" stroke-width="1.5">
            <rect x="3" y="3" width="18" height="18" rx="3"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <polyline points="21 15 16 10 5 21"/>
          </svg>
        </div>
        <div class="galeri-card-footer"></div>
      </div>

      <div class="galeri-card">
        <div class="galeri-placeholder">
          <svg viewBox="0 0 24 24" fill="none" stroke="#1A8FE3" stroke-width="1.5">
            <rect x="3" y="3" width="18" height="18" rx="3"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <polyline points="21 15 16 10 5 21"/>
          </svg>
        </div>
        <div class="galeri-card-footer"></div>
      </div>

      <div class="galeri-card">
        <div class="galeri-placeholder">
          <svg viewBox="0 0 24 24" fill="none" stroke="#1A8FE3" stroke-width="1.5">
            <rect x="3" y="3" width="18" height="18" rx="3"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <polyline points="21 15 16 10 5 21"/>
          </svg>
        </div>
        <div class="galeri-card-footer"></div>
      </div>

    </div>
  </div>
</section>

<main>
  <div class="section-header">
    <h2>Outlet Kami</h2>
    <div class="underline-bar"></div>
  </div>

  <div class="outlet-grid">

    <!-- Card 1 -->
    <div class="card">
      <span class="badge">Kota Veteran</span>
      <div class="card-body">
        <p class="card-name">SMKN 4 Tangerang (Main Store)</p>
        <p class="card-hours">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          Senin – Jum'at&nbsp;&nbsp;10.00 – 18.00
        </p>
      </div>
      <div class="card-divider"></div>
      <div class="card-actions">
        <button class="btn btn-primary">Lokasi</button>
        <button class="btn btn-secondary">Whatsapp</button>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="card">
      <span class="badge">Kota Veteran</span>
      <div class="card-body">
        <p class="card-name">SMKN 4 Tangerang (Main Store)</p>
        <p class="card-hours">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          Senin – Jum'at&nbsp;&nbsp;10.00 – 18.00
        </p>
      </div>
      <div class="card-divider"></div>
      <div class="card-actions">
        <button class="btn btn-primary">Lokasi</button>
        <button class="btn btn-secondary">Whatsapp</button>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="card">
      <span class="badge">Kota Veteran</span>
      <div class="card-body">
        <p class="card-name">SMKN 4 Tangerang (Main Store)</p>
        <p class="card-hours">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          Senin – Jum'at&nbsp;&nbsp;10.00 – 18.00
        </p>
      </div>
      <div class="card-divider"></div>
      <div class="card-actions">
        <button class="btn btn-primary">Lokasi</button>
        <button class="btn btn-secondary">Whatsapp</button>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="card">
      <span class="badge">Kota Veteran</span>
      <div class="card-body">
        <p class="card-name">SMKN 4 Tangerang (Main Store)</p>
        <p class="card-hours">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
          Senin – Jum'at&nbsp;&nbsp;10.00 – 18.00
        </p>
      </div>
      <div class="card-divider"></div>
      <div class="card-actions">
        <button class="btn btn-primary">Lokasi</button>
        <button class="btn btn-secondary">Whatsapp</button>
      </div>
    </div>

  </div>
</main>

<!-- ── ABOUT ── -->
<section class="about-section">
  <div class="container">
    <div class="about-header">
      <h2>About KickCare</h2>
      <div class="underline-bar"></div>
    </div>
    <div class="about-inner">
      <div class="about-text-col">
        <p>Didirikan pada awal tahun 2026, KickCare lahir dari sebuah keyakinan sederhana: sepatu bukan sekadar alas kaki, melainkan fondasi dari kepercayaan diri Anda. Di era modern ini, kami memahami bahwa mobilitas yang tinggi menuntut penampilan yang prima, namun waktu seringkali menjadi kendala.</p>
        <p>KickCare hadir sebagai solusi perawatan sepatu premium (Premium Shoe Treatment) yang menggabungkan teknik pembersihan mendetail dengan teknologi perawatan modern. Kami tidak hanya "mencuci", kami merawat. Mulai dari sneakers kesayangan, sepatu formal kulit, hingga boots, tim ahli kami memahami karakteristik setiap material untuk mencegah kerusakan dan mengembalikan pesona sepatu Anda seperti baru.</p>
      </div>
      <div class="logo-card">
        <div class="logo-card-inner">
          <div class="brand-icon">
            <svg viewBox="0 0 24 24"><path d="M20.5 10.5c-.28 0-.5.22-.5.5v1h-1v-1.5A4.5 4.5 0 0 0 14.5 6h-5A4.5 4.5 0 0 0 5 10.5V12H4v-1a.5.5 0 0 0-1 0v4a.5.5 0 0 0 1 0v-1h1v1.5A4.5 4.5 0 0 0 9.5 20h5a4.5 4.5 0 0 0 4.5-4.5V14h1v1a.5.5 0 0 0 1 0v-4a.5.5 0 0 0-.5-.5zM17 15.5A2.5 2.5 0 0 1 14.5 18h-5A2.5 2.5 0 0 1 7 15.5v-5A2.5 2.5 0 0 1 9.5 8h5A2.5 2.5 0 0 1 17 10.5v5z"/></svg>
          </div>
          <span class="brand-name">KickCare</span>
          <span class="brand-sub">Premium Shoe &amp;<br>Repair Services</span>
        </div>
      </div>
    </div>

    <!-- SOCIALS -->
    <div class="socials-wrap">
      <p class="socials-label">Get connected with us!</p>
      <div class="socials-row">
        <a href="#" class="social-btn fb" aria-label="Facebook">
          <svg viewBox="0 0 24 24" fill="white"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
        </a>
        <a href="#" class="social-btn ig" aria-label="Instagram">
          <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <circle cx="12" cy="12" r="4"/>
            <circle cx="17.5" cy="6.5" r="1" fill="white" stroke="none"/>
          </svg>
        </a>
        <a href="#" class="social-btn wa" aria-label="WhatsApp">
          <svg viewBox="0 0 24 24" fill="white">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.554 4.116 1.524 5.847L.057 23.862a.5.5 0 0 0 .61.61l6.015-1.467A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-1.877 0-3.638-.5-5.158-1.375l-.37-.217-3.567.87.87-3.567-.217-.37A9.953 9.953 0 0 1 2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

</body>
</html>
