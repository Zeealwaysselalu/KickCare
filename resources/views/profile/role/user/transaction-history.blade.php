<x-app-layout>
    <div class="p-6 sm:p-10 font-roboto min-h-screen bg-gray-50/50">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 animate-up gap-4">
            <div>
                <h1 class="font-montserrat font-extrabold text-3xl text-gray-800 uppercase italic tracking-tight">
                    Pesanan <span class="text-blue-600">Saya</span>
                </h1>
                <p class="text-gray-500 mt-1 text-sm">Kelola pengerjaan dan riwayat transaksi dalam satu tempat.</p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <div class="bg-white px-5 py-2.5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center text-blue-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[9px] text-gray-400 uppercase font-bold tracking-widest leading-none mb-1">Total Pesanan</p>
                        <p class="text-lg font-bold text-gray-800 leading-none">{{ $allTransactions->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-50 bg-white flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800 text-sm">Riwayat Transaksi</h3>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('transactions.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-lg shadow-blue-200 transition-all active:scale-95">
                        + Pesanan Baru
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($allTransactions as $transaction)
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
                                    {{-- Mengubah tampilan badge terkait status paying --}}
                                    @if ($progStatus === 'paying')
                                        <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-amber-100">
                                            <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                            Menunggu Pembayaran
                                        </span>
                                    @elseif ($progStatus === 'cleared')
                                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-emerald-100">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                            </svg>
                                            Selesai & Diambil
                                        </span>
                                    @elseif ($statusGlobal === 'pending')
                                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-blue-100">
                                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                            Sedang Dicuci
                                        </span>
                                    @elseif ($statusGlobal === 'completed')
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 text-[10px] px-3 py-1 rounded-full font-bold uppercase border border-green-100">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                                            </svg>
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
                                        {{-- TOMBOL BAYAR SEKARANG (Hanya muncul jika status masih paying) --}}
                                        @if ($progStatus === 'paying')
                                            <a href="{{ route('payment.show', $transaction->id) }}"
                                                class="inline-flex items-center gap-1 bg-amber-500 hover:bg-amber-600 text-white text-[11px] px-3 py-1.5 rounded-lg font-bold shadow-md shadow-amber-100 transition-all active:scale-95 mr-1">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                </svg>
                                                Bayar
                                            </a>
                                        @endif

                                        <button data-id="{{ $transaction->id }}"
                                            class="btn-detail w-8 h-8 flex items-center justify-center rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all border border-gray-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>

                                        {{-- Kondisi pembatalan juga disesuaikan ke status paying --}}
                                        @if ($progStatus === 'paying')
                                            <button data-action="{{ route('transactions.cancel', $transaction->id) }}"
                                                class="btn-cancel w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition-all border border-red-100 shadow-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
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

    <x-modal-detail />
    <x-modal-cancel />
</x-app-layout>
