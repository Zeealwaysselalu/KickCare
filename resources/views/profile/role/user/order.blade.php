<x-app-layout>
    <div class="p-6 sm:p-10 bg-gray-50 min-h-screen font-roboto">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 animate-up">
            <div>
                <h1 class="font-montserrat font-extrabold text-3xl text-gray-800 uppercase italic tracking-tight">
                    Pesanan <span class="text-blue-600">Saya</span>
                </h1>
                <p class="text-gray-500 mt-1 text-sm">Pantau status pencucian dan riwayat transaksi sepatu Anda.</p>
            </div>

            <div class="flex gap-4 mt-4 md:mt-0">
                <div class="bg-white px-4 py-2 rounded-xl border border-gray-100 shadow-sm">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Total Pesanan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $allTransactions->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                <h3 class="font-bold text-gray-700 text-sm">Riwayat Transaksi</h3>
                <button class="text-blue-600 text-xs font-medium hover:underline">Download Report</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="p-4 text-[12px] uppercase tracking-wider text-gray-400 font-bold">Nama Sepatu
                            </th>
                            <th class="p-4 text-[12px] uppercase tracking-wider text-gray-400 font-bold">Tanggal</th>
                            <th class="p-4 text-[12px] uppercase tracking-wider text-gray-400 font-bold">Status</th>
                            <th class="p-4 text-[12px] uppercase tracking-wider text-gray-400 font-bold">Total Harga
                            </th>
                            <th class="p-4 text-[12px] uppercase tracking-wider text-gray-400 font-bold text-center">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($allTransactions as $transaction)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-blue-100 group-hover:text-blue-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                </path>
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[14px] font-semibold text-gray-800">{{ $transaction->shoes_name }}</span>
                                    </div>
                                </td>
                                <td class="p-4 text-[13px] text-gray-500 whitespace-nowrap">
                                    {{ $transaction->transaction_date->format('d M Y') }}
                                </td>
                                <td class="p-4 whitespace-nowrap">
                                    @if ($transaction->status === 'pending')
                                        <span
                                            class="inline-flex items-center bg-blue-50 text-blue-600 text-[11px] px-3 py-1 rounded-full font-bold uppercase tracking-tighter border border-blue-100">
                                            <span
                                                class="w-1.5 h-1.5 bg-blue-600 rounded-full mr-1.5 animate-pulse"></span>
                                            Sedang Dicuci
                                        </span>
                                    @elseif ($transaction->status === 'completed')
                                        <span
                                            class="inline-flex items-center bg-green-50 text-green-600 text-[11px] px-3 py-1 rounded-full font-bold uppercase tracking-tighter border border-green-100">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Selesai
                                        </span>
                                    @elseif ($transaction->status === 'cancelled')
                                        <span
                                            class="inline-flex items-center bg-red-50 text-red-600 text-[11px] px-3 py-1 rounded-full font-bold uppercase tracking-tighter border border-red-100">
                                            Dibatalkan
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-[14px] font-bold text-gray-800 whitespace-nowrap font-mono">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    <a href="#"
                                        class="p-2 hover:bg-white rounded-lg text-gray-400 hover:text-blue-600 shadow-sm border border-transparent hover:border-gray-100 transition inline-block">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 font-medium">Kamu belum memiliki transaksi apa pun.</p>
                                        <a href="#"
                                            class="mt-4 text-blue-600 font-bold text-sm hover:underline italic">Pesan
                                            Treatment Sekarang →</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50/30 border-t border-gray-50">
                <p class="text-[11px] text-gray-400 font-medium uppercase tracking-widest">KickCare Dashboard System
                    v1.0</p>
            </div>
        </div>
    </div>
</x-app-layout>
