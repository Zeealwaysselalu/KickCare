<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KickCare – Cek Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- NAV -->
    <nav>
        <a class="logo" href="#">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20.5 10.5c-.28 0-.5.22-.5.5v1h-1v-1.5A4.5 4.5 0 0 0 14.5 6h-5A4.5 4.5 0 0 0 5 10.5V12H4v-1a.5.5 0 0 0-1 0v4a.5.5 0 0 0 1 0v-1h1v1.5A4.5 4.5 0 0 0 9.5 20h5a4.5 4.5 0 0 0 4.5-4.5V14h1v1a.5.5 0 0 0 1 0v-4a.5.5 0 0 0-.5-.5zM17 15.5A2.5 2.5 0 0 1 14.5 18h-5A2.5 2.5 0 0 1 7 15.5v-5A2.5 2.5 0 0 1 9.5 8h5A2.5 2.5 0 0 1 17 10.5v5z" />
                </svg>
            </div>
            <div class="logo-text">
                <strong>KickCare</strong>
                <span>Premium Shoe &amp; Repair Services</span>
            </div>
        </a>

        <ul class="nav-links">
            <li><a href="wel">Beranda</a></li>
            <li><a href="status" class="active">Cek Status</a></li>
            <li><a href="#" class="btn-login">Login</a></li>
        </ul>
    </nav>

    <!-- HERO -->
    <div class="hero">
        <h1>Lacak Sepatu Kamu</h1>
        <p>Penasaran sepatu kamu sudah sampai tahap mana?<br>Cek status sepatu kamu di sini tanpa perlu login!</p>
    </div>

    <!-- SEARCH CARD -->
    <div class="search-card">
        <div class="search-row">
            <input class="search-input" type="text"
                placeholder="Masukkan Kode Order / Nomor Invoice (Contoh: KC2026010100001)" />
            <button class="btn-cari">Cari</button>
        </div>
        <p class="hint">*Kode order tertera pada struk atau pesan email anda</p>
    </div>

</body>

</html>
