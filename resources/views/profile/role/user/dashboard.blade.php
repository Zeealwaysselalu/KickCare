<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-montserrat font-bold text-[32px] text-gray-800 leading-tight">
                    Halo, {{ Auth::user()->name }}
                </h1>
                <p class="font-roboto text-[#6B7280] text-sm mt-1">Pantau status cuci sepatu Anda di sini.</p>
            </div>
        </header>

        <div class="grid grid-cols-12 gap-6 items-stretch">
            {{-- MEMBER CARD SECTION --}}
            <div class="col-span-12 lg:col-span-8 animate-up">
                @php
                    $memberConfig = [
                        'bronze' => [
                            'gradient' => 'from-[#A855F7] to-[#EC4899]',
                            'tier' => 'Standard Tier',
                            'label' => 'Member Bronze',
                            'desc' => 'Diskon 5% untuk setiap Unyellowing Treatment.',
                            'text' => 'text-white',
                        ],
                        'silver' => [
                            'gradient' => 'from-[#22C55E] to-[#14B8A6]',
                            'tier' => 'Elite Tier',
                            'label' => 'Member Silver',
                            'desc' => 'Gratis Antar-Jemput & diskon 10% Repaint Treatment.',
                            'text' => 'text-white',
                        ],
                        'gold' => [
                            'gradient' => 'from-[#3B82F6] to-[#06B6D4]',
                            'tier' => 'Premium Tier',
                            'label' => 'Member Gold',
                            'desc' => 'Diskon 20% Deep Clean Treatment sepanjang tahun.',
                            'text' => 'text-[#F4B400]',
                        ],
                    ];
                    $m = $memberConfig[$dataprofil->status_member] ?? $memberConfig['bronze'];
                @endphp

                <div class="bg-gradient-to-br {{ $m['gradient'] }} rounded-[20px] p-8 relative overflow-hidden card-shadow h-full flex flex-col justify-center min-h-[200px]">
                    <div class="relative z-10">
                        <span class="bg-white/20 text-white font-roboto text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">
                            {{ $m['tier'] }}
                        </span>
                        <h2 class="font-montserrat font-extrabold text-[28px] {{ $m['text'] }} mt-3 uppercase italic leading-tight">
                            {{ $m['label'] }}
                        </h2>
                        <p class="font-roboto text-white/90 text-sm mt-1 max-w-xl">{{ $m['desc'] }}</p>
                        <a href="{{ route('benefits') }}" class="mt-5 inline-block bg-white/10 hover:bg-white/20 border border-white/30 text-white font-roboto font-medium px-6 py-2 rounded-full text-xs transition backdrop-blur-sm shadow-inner">
                            Lihat Benefit
                        </a>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                </div>
            </div>

            {{-- LATEST STATUS CARD --}}
            <div class="col-span-12 lg:col-span-4 animate-up" style="animation-delay: 100ms">
                <div class="bg-white border border-gray-100 rounded-[20px] p-6 card-shadow h-full flex flex-col">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-montserrat font-bold text-gray-800 text-lg">Status Terakhir</h3>
                        <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>

                    @php
                        $latest = $latestTransactions->first();
                        $detail = $latest ? $latest->detail_transaction : null;
                        $prog = $detail ? $detail->progress_status : 'pending';
                        $mainStatus = $detail ? $detail->status : 'pending';
                        $item = $latest ? $latest->transaction_item->first() : null;

                        $statusMap = [
                            'paying' => ['label' => 'Menunggu Pembayaran', 'desc' => 'Pesanan sedang menunggu pembayaran.', 'color' => 'amber'],
                            'pending' => ['label' => 'Pesanan Diterima', 'desc' => 'Menunggu antrean.', 'color' => 'blue'],
                            'sorting' => ['label' => 'Pengecekan', 'desc' => 'Memeriksa kondisi.', 'color' => 'blue'],
                            'washing' => ['label' => 'Sedang Dicuci', 'desc' => 'Pembersihan intensif.', 'color' => 'blue'],
                            'drying'  => ['label' => 'Pengeringan', 'desc' => 'Proses pengeringan.', 'color' => 'blue'],
                            'ready'   => ['label' => 'Siap Diambil', 'desc' => 'Sudah bersih & wangi!', 'color' => 'green'],
                            'cleared' => ['label' => 'Selesai', 'desc' => 'Sudah diambil. Terima kasih!', 'color' => 'emerald'],
                        ];

                        $current = $statusMap[$prog] ?? $statusMap['pending'];

                        // Map warna (Pastikan 'amber' sudah ada di sini)
                        $textColors = ['amber' => 'text-amber-700', 'blue' => 'text-blue-700', 'green' => 'text-green-700', 'emerald' => 'text-emerald-700'];
                        $descColors = ['amber' => 'text-amber-600', 'blue' => 'text-blue-600', 'green' => 'text-green-600', 'emerald' => 'text-emerald-600'];
                        $bgColors   = ['amber' => 'bg-amber-500', 'blue' => 'bg-blue-500', 'green' => 'bg-green-500', 'emerald' => 'bg-emerald-500'];
                        $ringColors = ['amber' => 'ring-amber-50', 'blue' => 'ring-blue-50', 'green' => 'ring-green-50', 'emerald' => 'ring-emerald-50'];
                        $cardBgs    = ['amber' => 'bg-amber-50/30', 'blue' => 'bg-blue-50/30', 'green' => 'bg-green-50/30', 'emerald' => 'bg-emerald-50/30'];
                        $borderBgs  = ['amber' => 'border-amber-100/50', 'blue' => 'border-blue-100/50', 'green' => 'border-green-100/50', 'emerald' => 'border-emerald-100/50'];
                    @endphp

                    <div class="flex-1 flex flex-col justify-center">
                        @if ($latest && $detail && $mainStatus !== 'cancelled')
                            <div class="mb-4">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                    {{ $prog === 'cleared' ? 'Riwayat Terakhir' : 'Sedang Diproses' }}
                                </p>
                                <h4 class="text-sm font-bold text-gray-800 truncate">{{ $item->shoes_name ?? 'Sepatu' }}</h4>
                            </div>

                            <div class="p-4 relative {{ $cardBgs[$current['color']] }} rounded-2xl border {{ $borderBgs[$current['color']] }}">
                                <div class="flex items-center gap-4">
                                    <div class="rounded-xl flex items-center justify-center text-white">
                                        @if ($prog == 'ready' || $prog == 'cleared')
                                            <div class="w-7 h-7 rounded-full {{ $bgColors[$current['color']] }} flex items-center justify-center shadow-lg shadow-{{ $current['color'] }}-200">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-6 h-6 rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10 {{ $bgColors[$current['color']] ?? $bgColors['blue'] }} {{ $ringColors[$current['color']] ?? $ringColors['blue'] }} ring-4">
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-extrabold {{ $textColors[$current['color']] }} uppercase tracking-tight">
                                            {{ $current['label'] }}
                                        </h5>
                                        <p class="text-[10px] {{ $descColors[$current['color']] }} leading-tight mt-0.5 font-medium">
                                            {{ $current['desc'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <button data-id="{{ $latest->id }}" class="btn-status mt-4 block w-full text-center py-2.5 text-[11px] font-bold text-blue-600 bg-blue-50 rounded-xl hover:bg-blue-100 transition-all uppercase tracking-wide">
                                Detail Pesanan
                            </button>
                        @elseif($mainStatus === 'cancelled')
                            <div class="text-center py-4 text-red-500">
                                <svg class="w-10 h-10 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <p class="text-xs font-bold uppercase">Pesanan Dibatalkan</p>
                            </div>
                        @else
                            <div class="text-center py-6 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-[11px] font-medium leading-relaxed">Belum ada aktivitas cuci aktif.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- SERVICES SECTION --}}
            <div class="col-span-12 mt-4">
                <h2 class="font-montserrat font-semibold text-[20px] text-gray-800 mb-5">Pesan Layanan Baru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @php
                        $services = [
                            ['key' => 'wash', 'label' => 'Deep Clean', 'price' => '65k', 'desc' => 'Pembersihan menyeluruh luar & dalam.', 'color' => 'blue', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                            ['key' => 'unyellowing', 'label' => 'Unyellowing', 'price' => '100k', 'desc' => 'Menghilangkan noda kuning di midsole.', 'color' => 'yellow', 'icon' => 'M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                            ['key' => 'repaint', 'label' => 'Repaint', 'price' => '150k', 'desc' => 'Kembalikan warna sepatu seperti baru.', 'color' => 'purple', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.172-1.172a4 4 0 115.656 5.656L16.657 13'],
                        ];
                    @endphp

                    @foreach ($services as $s)
                        <div class="bg-white p-5 rounded-[18px] card-shadow border border-transparent hover:border-blue-500 transition-all group cursor-pointer">
                            <div class="w-12 h-12 bg-{{ $s['color'] }}-50 rounded-xl flex items-center justify-center text-{{ $s['color'] }}-500 mb-4 group-hover:bg-blue-500 group-hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}" />
                                </svg>
                            </div>
                            <h3 class="font-montserrat font-bold text-gray-800 text-lg">{{ $s['label'] }}</h3>
                            <p class="text-gray-500 text-xs mt-1 leading-relaxed">{{ $s['desc'] }}</p>
                            <div class="mt-4 flex items-center justify-between border-t border-gray-50 pt-4">
                                <span class="text-blue-600 font-bold text-sm">Rp {{ $s['price'] }}</span>
                                <a href="{{ route('transactions.create', ['service' => $s['key']]) }}" class="bg-gray-50 text-gray-800 text-[11px] font-bold px-4 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                    Pilih
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- LATEST ACTIVITY TABLE --}}
            <div class="col-span-12 mt-8">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-montserrat font-semibold text-[20px] text-gray-800">Aktivitas Terakhir</h2>
                    <a href="{{ route('pesanan') }}" class="text-blue-600 text-xs font-bold hover:underline">Lihat Semua</a>
                </div>

                <div class="bg-white rounded-[20px] card-shadow overflow-hidden border border-gray-50">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <tbody class="divide-y divide-gray-50">
                                @forelse ($latestTransactions as $transaction)
                                    @php
                                        $item = $transaction->transaction_item->first();
                                        $statusGlobal = $transaction->detail_transaction->status;
                                        $progStatus = $transaction->detail_transaction->progress_status;
                                    @endphp
                                    <tr class="hover:bg-blue-50/20 transition-all group">
                                        <td class="px-6 py-5">
                                            <div class="flex flex-col">
                                                <span class="text-[14px] font-bold text-gray-800 group-hover:text-blue-600 transition-colors italic">
                                                    {{ $item->shoes_name ?? '-' }}
                                                </span>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[9px] bg-blue-50 text-blue-500 px-2 py-0.5 rounded font-bold uppercase tracking-tighter">
                                                        {{ $item->service ?? '-' }}
                                                    </span>
                                                    <span class="text-[9px] text-gray-400 font-mono italic">#{{ $transaction->transaction_code }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-[13px] text-gray-400 font-medium whitespace-nowrap">
                                            {{ $transaction->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            @if ($progStatus === 'paying')
                                                <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-amber-100">
                                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                    Menunggu
                                                </span>
                                            @elseif ($progStatus === 'cleared')
                                                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-emerald-100">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                                                    Selesai & Diambil
                                                </span>
                                            @elseif ($statusGlobal === 'pending')
                                                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-blue-100">
                                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                                    Sedang Dicuci
                                                </span>
                                            @elseif ($statusGlobal === 'completed')
                                                <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-green-100">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" /></svg>
                                                    Siap Diambil
                                                </span>
                                            @else
                                                <span class="inline-flex items-center bg-red-50 text-red-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-red-100">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 text-[14px] font-bold text-gray-800 whitespace-nowrap text-right">
                                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center justify-end gap-2">
                                                <button data-id="{{ $transaction->id }}" class="btn-detail w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all border border-gray-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                </button>
                                                @if ($progStatus === 'paying')
                                                    <button data-action="{{ route('transactions.cancel', $transaction->id) }}" class="btn-cancel w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition-all border border-red-100 shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-20 text-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                            </div>
                                            <h3 class="text-gray-800 font-bold">Belum ada pesanan</h3>
                                            <p class="text-gray-400 text-xs mt-1">Yuk, kembalikan kilau sepatumu!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal-detail />
    <x-modal-cancel />
    @php $latest = $latestTransactions->first(); @endphp
    <x-modal-status :latest="$latest" />
</x-app-layout>
