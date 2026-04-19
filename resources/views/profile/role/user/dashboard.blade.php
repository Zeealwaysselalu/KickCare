<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">

        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="font-montserrat font-bold text-[32px] text-gray-800 leading-tight">
                    Halo, {{ Auth::user()->username }}
                </h1>
                <p class="text-[#6B7280] text-sm mt-1">Pantau status cuci sepatu Anda di sini.</p>
            </div>
            <div class="hidden sm:flex items-center">
                <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white card-shadow overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff"
                        alt="Avatar">
                </div>
            </div>
        </header>

        <div class="grid grid-cols-12 gap-6">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">

                @if ($dataprofil->status_member === 'bronze')
                    <div
                        class="bg-gradient-to-br from-[#A855F7] to-[#EC4899] rounded-[14px] p-8 relative overflow-hidden card-shadow animate-up">
                        <div class="relative z-10">
                            <span
                                class="bg-white/20 text-white font-roboto text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Standard Status
                            </span>

                            <h2
                                class="font-montserrat font-extrabold text-[24px] text-[#F3E8FF] mt-4 uppercase leading-tight">
                                Member Bronze</h2>

                            <p class="font-roboto text-white/90 text-sm mt-2 max-w-xs leading-relaxed">
                                Dapatkan prioritas antrean dan diskon 5% untuk setiap Unyellowing Treatment.
                            </p>

                            <button
                                class="mt-6 bg-white text-[#A855F7] font-roboto font-medium px-6 py-2 rounded-lg text-[14px] hover:bg-gray-100 transition shadow-sm">
                                Lihat Benefit
                            </button>
                        </div>

                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full"></div>
                    </div>
                @elseif ($dataprofil->status_member === 'silver')
                    <div class="bg-gradient-to-br from-[#22C55E] to-[#14B8A6] rounded-[14px] p-8 relative overflow-hidden card-shadow animate-up"
                        style="animation-delay: 0.2s">
                        <div class="relative z-10">
                            <span
                                class="bg-white/20 text-white font-roboto text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Elite Status
                            </span>

                            <h2
                                class="font-montserrat font-extrabold text-[24px] text-[#D1FAE5] mt-4 uppercase leading-tight">
                                Member Silver
                            </h2>

                            <p class="font-roboto text-white/90 text-sm mt-2 max-w-xs leading-relaxed">
                                Nikmati Gratis Layanan Antar-Jemput (S&K) & diskon 10% untuk Repaint Treatment.
                            </p>

                            <button
                                class="mt-6 bg-white text-[#22C55E] font-roboto font-medium px-6 py-2 rounded-lg text-[14px] hover:bg-gray-100 transition shadow-sm">
                                Lihat Benefit
                            </button>
                        </div>

                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full"></div>
                    </div>
                @elseif ($dataprofil->status_member == 'gold')
                    <div class="bg-gradient-to-br from-[#3B82F6] to-[#06B6D4] rounded-[14px] p-8 relative overflow-hidden card-shadow animate-up"
                        style="animation-delay: 0.3s">
                        <div class="relative z-10">
                            <span
                                class="bg-white/20 text-white font-roboto text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Premium Status
                            </span>

                            <h2
                                class="font-montserrat font-extrabold text-[24px] text-[#F4B400] mt-4 uppercase leading-tight">
                                Member Gold
                            </h2>

                            <p class="font-roboto text-white/90 text-sm mt-2 max-w-xs leading-relaxed">
                                Nikmati diskon 20% untuk setiap Deep Clean Treatment sepanjang tahun.
                            </p>

                            <button
                                class="mt-6 bg-white text-[#3B82F6] font-roboto font-medium px-6 py-2 rounded-lg text-[14px] hover:bg-gray-100 transition shadow-sm">
                                Lihat Benefit
                            </button>
                        </div>

                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full"></div>
                    </div>
                @endif
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
                            <button
                                class="bg-gray-100 text-[#1F2937] text-[12px] font-semibold px-3 py-1.5 rounded-lg group-hover:bg-[#3B82F6] group-hover:text-white transition">Pilih</button>
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
                            <button
                                class="bg-gray-100 text-[#1F2937] text-[12px] font-semibold px-3 py-1.5 rounded-lg group-hover:bg-[#3B82F6] group-hover:text-white transition">Pilih</button>
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
                            <button
                                class="bg-gray-100 text-[#1F2937] text-[12px] font-semibold px-3 py-1.5 rounded-lg group-hover:bg-[#3B82F6] group-hover:text-white transition">Pilih</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 mt-4">
                <h2 class="font-montserrat font-semibold text-[20px] mb-4 text-gray-800">Aktivitas Terakhir</h2>
                <div class="bg-white rounded-[14px] card-shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            @forelse ($allTransactions as $transaction)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4 text-[14px] font-medium text-[#1F2937]">
                                        {{ $transaction->shoes_name }}</td>
                                    <td class="p-4 text-[13px] text-[#6B7280] whitespace-nowrap">
                                        {{ $transaction->transaction_date->format('d M Y') }}</td>
                                    <td class="p-4 whitespace-nowrap">
                                        @if ($transaction->status === 'pending')
                                            <span
                                                class="bg-blue-100 text-blue-600 text-[12px] px-3 py-1 rounded-full font-medium">Sedang
                                                Dicuci</span>
                                        @elseif ($transaction->status === 'completed')
                                            <span
                                                class="bg-green-100 text-green-600 text-[12px] px-3 py-1 rounded-full font-medium">Selesai</span>
                                        @elseif ($transaction->status === 'cancelled')
                                            <span
                                                class="bg-red-100 text-red-600 text-[12px] px-3 py-1 rounded-full font-medium">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-[14px] font-bold text-[#1F2937] whitespace-nowrap">Rp
                                        {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500">Kamu belum memulai
                                        transaksi!</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
