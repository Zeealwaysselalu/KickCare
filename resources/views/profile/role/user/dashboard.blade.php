<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        <header class="flex justify-between items-center mb-6">
            <div>
                <h1 class="font-montserrat font-bold text-[32px] text-gray-800 leading-tight">
                    Halo, {{ Auth::user()->username }}
                </h1>
                <p class="font-roboto text-[#6B7280] text-sm mt-1">Pantau status cuci sepatu Anda di sini.</p>
            </div>
        </header>

        <div class="grid grid-cols-12 gap-6 items-stretch">

            <div class="col-span-12 lg:col-span-8 animate-up">
                @if ($dataprofil->status_member === 'bronze')
                    <div
                        class="bg-gradient-to-br from-[#A855F7] to-[#EC4899] rounded-[20px] p-8 relative overflow-hidden card-shadow h-full flex flex-col justify-center min-h-[200px]">
                        <div class="relative z-10">
                            <span
                                class="bg-white/20 text-white font-roboto text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">Standard
                                Tier</span>
                            <h2
                                class="font-montserrat font-extrabold text-[28px] text-white mt-3 uppercase italic leading-tight">
                                Member Bronze</h2>
                            <p class="font-roboto text-white/90 text-sm mt-1 max-w-xl">Diskon 5% untuk setiap
                                Unyellowing Treatment.</p>
                            <a href="{{ route('benefits') }}"
                                class="mt-5 inline-block bg-white/10 hover:bg-white/20 border border-white/30 text-white font-roboto font-medium px-6 py-2 rounded-full text-xs transition backdrop-blur-sm shadow-inner">Lihat
                                Benefit</a>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                    </div>
                @elseif ($dataprofil->status_member === 'silver')
                    <div
                        class="bg-gradient-to-br from-[#22C55E] to-[#14B8A6] rounded-[20px] p-8 relative overflow-hidden card-shadow h-full flex flex-col justify-center min-h-[200px]">
                        <div class="relative z-10">
                            <span
                                class="bg-white/20 text-white font-roboto text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">Elite
                                Tier</span>
                            <h2
                                class="font-montserrat font-extrabold text-[28px] text-white mt-3 uppercase italic leading-tight">
                                Member Silver</h2>
                            <p class="font-roboto text-white/90 text-sm mt-1 max-w-xl">Gratis Antar-Jemput & diskon 10%
                                Repaint Treatment.</p>
                            <a href="{{ route('benefits') }}"
                                class="mt-5 inline-block bg-white/10 hover:bg-white/20 border border-white/30 text-white font-roboto font-medium px-6 py-2 rounded-full text-xs transition backdrop-blur-sm shadow-inner">Lihat
                                Benefit</a>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                    </div>
                @elseif ($dataprofil->status_member == 'gold')
                    <div
                        class="bg-gradient-to-br from-[#3B82F6] to-[#06B6D4] rounded-[20px] p-8 relative overflow-hidden card-shadow h-full flex flex-col justify-center min-h-[200px]">
                        <div class="relative z-10">
                            <span
                                class="bg-white/20 text-white font-roboto text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">Premium
                                Tier</span>
                            <h2
                                class="font-montserrat font-extrabold text-[28px] text-[#F4B400] mt-3 uppercase italic leading-tight">
                                Member Gold</h2>
                            <p class="font-roboto text-white/95 text-sm mt-1 max-w-xl">Diskon 20% Deep Clean Treatment
                                sepanjang tahun.</p>
                            <a href="{{ route('benefits') }}"
                                class="mt-5 inline-block bg-white/10 hover:bg-white/20 border border-white/30 text-white font-roboto font-medium px-6 py-2 rounded-full text-xs transition backdrop-blur-sm shadow-inner">Lihat
                                Benefit</a>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                    </div>
                @endif
            </div>

            <div class="col-span-12 lg:col-span-4 animate-up" style="animation-delay: 100ms">
                <div class="bg-white border border-gray-100 rounded-[20px] p-6 card-shadow h-full flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-montserrat font-bold text-gray-800 text-lg">Status Terakhir</h3>
                        <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>

                    @php $latest = $latestTransactions->first(); @endphp

                    @if ($latest)
                        <div class="flex-1">
                            <div class="mb-4">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Sepatu</p>
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ $latest->shoes_name }}</p>
                            </div>

                            <div class="relative">
                                <div class="absolute left-[11px] top-2 bottom-2 w-0.5 bg-gray-100"></div>

                                <div class="relative flex items-start gap-4 mb-4">
                                    <div
                                        class="mt-1.5 w-[24px] h-[24px] rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10 {{ $latest->status == 'pending' ? 'bg-blue-500 ring-4 ring-blue-50' : 'bg-green-500' }}">
                                        @if ($latest->status == 'completed')
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs font-bold {{ $latest->status == 'pending' ? 'text-blue-600' : 'text-gray-400' }}">
                                            Sedang Dicuci</p>
                                        <p class="text-[10px] text-gray-400">{{ $latest->created_at->format('H:i') }}
                                            WIB</p>
                                    </div>
                                </div>

                                <div class="relative flex items-start gap-4">
                                    <div
                                        class="mt-1.5 w-[24px] h-[24px] rounded-full border-4 border-white shadow-sm flex items-center justify-center z-10 {{ $latest->status == 'completed' ? 'bg-green-500 ring-4 ring-green-50' : 'bg-gray-200' }}">
                                        @if ($latest->status == 'completed')
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p
                                            class="text-xs font-bold {{ $latest->status == 'completed' ? 'text-green-600' : 'text-gray-300' }}">
                                            Selesai & Siap Diambil</p>
                                        @if ($latest->status == 'completed')
                                            <p class="text-[10px] text-gray-400">
                                                {{ $latest->updated_at->format('d M') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center text-center">
                            <p class="text-sm text-gray-400">Belum ada aktivitas transaksi.</p>
                        </div>
                    @endif

                    <a href="{{ route('pesanan') }}"
                        class="mt-4 block text-center py-2 text-[11px] font-bold text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition uppercase tracking-wide">
                        Detail Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 mt-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-montserrat font-semibold text-[20px] text-gray-800">Pesan Layanan Baru</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                class="bg-white p-5 rounded-[14px] card-shadow border border-transparent hover:border-[#3B82F6] transition group cursor-pointer">
                <div
                    class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-[#3B82F6] mb-4 group-hover:bg-[#3B82F6] group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h3 class="font-montserrat font-bold text-[#1F2937] text-lg">Deep Clean</h3>
                <p class="text-[#6B7280] text-xs mt-1 leading-relaxed">Pembersihan menyeluruh luar & dalam.</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-[#3B82F6] font-bold text-sm">Rp 65k</span>
                    <a href="{{ route('transactions.create', ['service' => 'wash']) }}"
                        class="bg-gray-100 text-[#1F2937] text-[12px] font-semibold px-3 py-1.5 rounded-lg hover:bg-[#3B82F6] hover:text-white transition">
                        Pilih
                    </a>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-[14px] card-shadow border border-transparent hover:border-[#3B82F6] transition group cursor-pointer">
                <div
                    class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center text-[#F4B400] mb-4 group-hover:bg-[#F4B400] group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.364l-.707-.707M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="font-montserrat font-bold text-[#1F2937] text-lg">Unyellowing</h3>
                <p class="text-[#6B7280] text-xs mt-1 leading-relaxed">Menghilangkan noda kuning di midsole.</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-[#3B82F6] font-bold text-sm">Rp 100k</span>
                    <a href="{{ route('transactions.create', ['service' => 'unyellowing']) }}"
                        class="bg-gray-100 text-[#1F2937] text-[12px] font-semibold px-3 py-1.5 rounded-lg hover:bg-[#3B82F6] hover:text-white transition">
                        Pilih
                    </a>
                </div>
            </div>

            <div
                class="bg-white p-5 rounded-[14px] card-shadow border border-transparent hover:border-[#3B82F6] transition group cursor-pointer">
                <div
                    class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-500 mb-4 group-hover:bg-purple-500 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.172-1.172a4 4 0 115.656 5.656L16.657 13" />
                    </svg>
                </div>
                <h3 class="font-montserrat font-bold text-[#1F2937] text-lg">Repaint</h3>
                <p class="text-[#6B7280] text-xs mt-1 leading-relaxed">Kembalikan warna sepatu seperti baru.</p>
                <div class="mt-4 flex items-center justify-between">
                    <span class="text-[#3B82F6] font-bold text-sm">Rp 150k</span>
                    <a href="{{ route('transactions.create', ['service' => 'repaint']) }}"
                        class="bg-gray-100 text-[#1F2937] text-[12px] font-semibold px-3 py-1.5 rounded-lg hover:bg-[#3B82F6] hover:text-white transition">
                        Pilih
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 mt-4">
        <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
            <h2 class="font-montserrat font-semibold text-[20px] mb-4 text-gray-800">Aktivitas Terakhir</h2>
            <form action="{{ route('pesanan') }}" method="GET">
                <button type="submit" class="text-blue-600 text-xs font-medium hover:underline">Lihat
                    Semua</button>
            </form>
        </div>
        <div class="bg-white rounded-[14px] card-shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($latestTransactions as $transaction)
                            @php
                                $item = $transaction->transaction_item->first();
                                $status = $transaction->detail_transaction->status;
                            @endphp

                            <tr class="hover:bg-blue-50/20 transition-all group">

                                <td class="px-6 lg:px-8 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[14px] font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
                                            {{ $item->shoes_name ?? '-' }}
                                        </span>

                                        <div class="flex flex-wrap items-center gap-2 mt-1">
                                            <span
                                                class="text-[10px] bg-blue-50 text-blue-500 px-2 py-0.5 rounded font-bold uppercase">
                                                {{ $item->service ?? '-' }}
                                            </span>

                                            <span class="text-[10px] text-gray-400 italic font-mono">
                                                #{{ $transaction->transaction_code }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 lg:px-8 py-5 text-[13px] text-gray-500 font-medium whitespace-nowrap">
                                    {{ $transaction->created_at->format('d M Y') }}
                                </td>

                                <td class="px-6 lg:px-8 py-5 whitespace-nowrap">
                                    @if ($status === 'pending')
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-blue-100">
                                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                            Sedang Dicuci
                                        </span>
                                    @elseif ($status === 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-green-100">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                            </svg>
                                            Selesai
                                        </span>
                                    @elseif ($status === 'cancelled')
                                        <span
                                            class="inline-flex items-center bg-red-50 text-red-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-red-100">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 lg:px-8 py-5 text-[14px] font-bold text-gray-800 whitespace-nowrap">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </td>

                                <td class="px-6 lg:px-8 py-5">
                                    <div class="flex items-center gap-2">


                                        <button data-id="{{ $transaction->id }}" title="Detail"
                                            class="btn-detail w-9 h-9 flex items-center justify-center rounded-xl text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100">

                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>


                                        @if ($status === 'pending')
                                            <button data-action="{{ route('transactions.cancel', $transaction->id) }}"
                                                title="Batalkan"
                                                class="btn-cancel w-9 h-9 flex items-center justify-center rounded-xl text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all border border-transparent hover:border-red-100">

                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="py-20 px-6">
                                    <div class="flex flex-col items-center justify-center text-center">
                                        <div
                                            class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center border border-gray-100 mb-5">
                                            <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="1.5"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </div>

                                        <h3 class="text-gray-800 font-bold text-lg">
                                            Belum ada pesanan
                                        </h3>

                                        <p class="text-gray-400 text-sm mt-2 mb-6 max-w-sm leading-relaxed">
                                            Sepatu kotor? Yuk, pesan treatment sekarang dan
                                            kembalikan kilau sepatumu!
                                        </p>

                                        <a href="{{ route('transactions.create') }}"
                                            class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all active:scale-95">
                                            Mulai Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <x-modal-detail/>
</x-app-layout>
