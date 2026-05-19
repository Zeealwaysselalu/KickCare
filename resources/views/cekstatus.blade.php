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

    <nav>
        <a class="logo" href="/">
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
            <li><a href="/">Beranda</a></li>
            <li><a href="{{ route('cekstatus') }}" class="active">Cek Status</a></li>
            <li><a href="{{ route('login') }}" class="btn-login">Login</a></li>
        </ul>
    </nav>

    <div class="hero">
        <h1>Lacak Sepatu Kamu</h1>
        <p>Penasaran sepatu kamu sudah sampai tahap mana?<br>Cek status sepatu kamu di sini tanpa perlu login!</p>
    </div>

    <div class="search-card">
        <form action="{{ route('cekstatus') }}" method="GET">
            <div class="search-row">
                <input class="search-input" type="text" name="search" value="{{ request('search') }}"
                    placeholder="Masukkan Kode Order / Nomor Invoice (Contoh: KC2026...)" />
                <button type="submit" class="btn-cari">Cari</button>
            </div>
        </form>
        <p class="hint">*Kode order tertera pada struk atau pesan email anda</p>
    </div>

    <div class="max-w-2xl mx-auto px-6 mt-10 space-y-4">
        @forelse ($transactions as $t)
            @php
                $item = $t->transaction_item->first();
                $prog = $t->detail_transaction->progress_status;
            @endphp

            <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">#{{ $t->transaction_code }}</p>
                    <h3 class="font-montserrat font-bold text-lg uppercase ">{{ $item->shoes_name ?? 'Sepatu' }}</h3>
                    <p class="text-xs text-gray-400 uppercase">{{ $item->service }}</p>
                </div>
                <div class="text-right">
                    <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-blue-50 text-blue-600 border border-blue-100">
                        {{ $prog }}
                    </span>
                    <p class="text-[9px] text-gray-400 mt-2 italic">{{ $t->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        @empty
            @if (request('search'))
                <div class="text-center py-20">
                    <div class="text-gray-200 mb-4 flex justify-center">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs italic">Data tidak ditemukan. Silakan
                        periksa kembali kode Anda.</p>
                </div>
            @endif
        @endforelse
    </div>

</body>
</html>
