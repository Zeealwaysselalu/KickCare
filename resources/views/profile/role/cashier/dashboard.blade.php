<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-montserrat font-bold text-[32px] text-gray-800 leading-tight">
                    Halo, {{ Auth::user()->username }}
                </h1>
                <p class="font-roboto text-[#6B7280] text-sm mt-1">Pantau performa dan pesanan KickCare hari ini.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('transactions.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-montserrat font-bold text-xs uppercase tracking-widest shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Pesanan Baru
                </a>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100 transition hover:shadow-md group">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="font-montserrat font-semibold text-[10px] text-gray-400 uppercase tracking-[2px]">Pesanan
                        Bulan Ini</h2>
                    <span
                        class="text-[9px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded-full font-bold uppercase tracking-tighter">
                        {{ now()->format('M Y') }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-roboto font-bold text-4xl text-gray-800 leading-none">
                        {{ $totalOrdersMonth ?? 0 }}
                    </span>
                    <div class="p-3 bg-gray-50 rounded-2xl group-hover:bg-blue-50 transition-colors">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100 transition hover:shadow-md group">
                <h2 class="font-montserrat font-semibold text-[10px] text-gray-400 uppercase tracking-[2px] mb-4">Sedang
                    Diproses</h2>
                <div class="flex items-center justify-between">
                    <span class="font-roboto font-bold text-4xl text-[#3B82F6] leading-none">
                        {{ $processingOrders ?? 0 }}
                    </span>
                    <div class="p-3 bg-blue-50 rounded-2xl">
                        <svg class="w-6 h-6 text-blue-500 animate-spin-slow" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100 transition hover:shadow-md group">
                <h2 class="font-montserrat font-semibold text-[10px] text-gray-400 uppercase tracking-[2px] mb-4">Omzet
                    Bulan Ini</h2>
                <div class="flex items-center justify-between">
                    <span class="font-roboto font-bold text-2xl text-gray-800 leading-none">
                        Rp {{ number_format($totalRevenueMonth ?? 0, 0, ',', '.') }}
                    </span>
                    <div class="p-3 bg-green-50 rounded-2xl">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
            <div
                class="px-8 py-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h2 class="font-montserrat font-bold text-lg text-gray-800 italic uppercase tracking-tight">
                    Pesanan <span class="text-blue-600">Terakhir</span>
                </h2>

                <form action="{{ route('dashboard') }}" method="GET" class="relative group w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Kode atau Nama..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-roboto focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none">

                    <div
                        class="absolute left-3 top-2.5 text-gray-400 group-focus-within:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    @if (request('search'))
                        <a href="{{ route('dashboard') }}"
                            class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th
                                class="px-8 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                ID & Tanggal</th>
                            <th
                                class="px-8 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                Pelanggan</th>
                            <th
                                class="px-8 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                Treatment</th>
                            <th
                                class="px-8 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px] text-center">
                                Status</th>
                            <th
                                class="px-8 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px] text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($latestTransactions as $transaction)
                            @php
                                $firstItem = $transaction->transaction_item->first();
                                $status = $transaction->detail_transaction->status ?? 'pending';
                                $statusClasses = match ($status) {
                                    'completed' => 'bg-green-50 text-green-600 border-green-100',
                                    'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                    default => 'bg-blue-50 text-blue-600 border-blue-100',
                                };
                            @endphp
                            <tr class="hover:bg-blue-50/20 transition duration-150 group">
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-mono font-bold text-sm text-gray-800">#{{ $transaction->transaction_code }}</span>
                                        <span
                                            class="text-[10px] text-gray-400 font-medium">{{ $transaction->created_at->format('d/m/y H:i') }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col">
                                            <span
                                                class="font-roboto font-bold text-sm text-gray-800">{{ $firstItem->customer_name ?? 'Guest' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-roboto font-bold text-xs text-gray-700 uppercase">{{ $firstItem->service ?? 'Wash' }}</span>
                                        <span
                                            class="text-[10px] text-blue-500 font-medium">{{ $firstItem->shoes_name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-center">
                                    <span
                                        class="inline-flex items-center px-4 py-1 rounded-full font-roboto font-bold text-[9px] uppercase tracking-widest border {{ $statusClasses }}">
                                        {{ $status === 'pending' ? 'Diproses' : ($status === 'completed' ? 'Selesai' : 'Batal') }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button data-id="{{ $transaction->id }}"
                                            class="btn-detail p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center text-gray-400 font-roboto text-sm">
                                    Belum ada data transaksi masuk hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-8 py-5 bg-gray-50/50 border-t border-gray-100">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <span class="font-roboto text-[10px] text-gray-400 uppercase font-bold tracking-widest ">
                            Menampilkan {{ $latestTransactions->firstItem() }} - {{ $latestTransactions->lastItem() }}
                            dari {{ $latestTransactions->total() }} transaksi
                        </span>
                        <div class="white-pagination">
                            {{ $latestTransactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal-detail />
</x-app-layout>
