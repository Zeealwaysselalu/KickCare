<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">

        {{-- HEADER SECTION --}}
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                    Admin <span class="text-blue-600">Dashboard</span>
                </h1>
                <p class="font-roboto text-gray-500 text-sm mt-1">
                    Pantau performa bisnis dan operasional KickCare hari ini.
                </p>
            </div>
        </header>

        {{-- STATS CARDS SECTION (GRID LAYER) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            {{-- Card 1: Total Omset --}}
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100 transition hover:shadow-md group relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="font-montserrat font-semibold text-[10px] text-gray-400 uppercase tracking-[2px] mb-4">
                        Total Omset
                    </h2>
                    <div class="flex items-center justify-between">
                        <span class="font-roboto font-bold text-2xl text-gray-800 leading-none">
                            Rp {{ number_format($totalRevenueMonth ?? 0, 0, ',', '.') }}
                        </span>
                        <div class="p-2 bg-green-50 rounded-xl">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Pengaduan Masuk --}}
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100 transition hover:shadow-md group relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="font-montserrat font-bold text-[11px] text-gray-400 uppercase tracking-[2px] mb-6">
                        Pengaduan Masuk
                    </h2>
                    <div class="flex items-end justify-between">
                        <div>
                            <span class="font-roboto font-black text-5xl text-red-500 leading-none tracking-tighter">
                                {{ $totalComplaints ?? 0 }}
                            </span>
                            <p class="text-[10px] text-gray-400 mt-2 font-medium italic">*Perlu respon cepat</p>
                        </div>
                        <div class="p-4 bg-red-50 rounded-2xl transition-all text-red-500 shadow-sm border border-red-100">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 3: Siap Ambil --}}
            <div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100 transition hover:shadow-md group relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="font-montserrat font-bold text-[11px] text-gray-400 uppercase tracking-[2px] mb-6">
                        Siap Ambil
                    </h2>
                    <div class="flex items-end justify-between">
                        <div>
                            <span class="font-roboto font-black text-5xl text-emerald-500 leading-none tracking-tighter">
                                {{ $readyOrdersCount ?? 0 }}
                            </span>
                            <p class="text-[10px] text-gray-400 mt-2 font-medium">Sepatu selesai diproses</p>
                        </div>
                        <div class="p-4 bg-emerald-50 rounded-2xl text-emerald-500 shadow-sm border border-emerald-100">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{-- FIX: Tag penutup Grid diletakkan di sini agar batas area 3 card atas selesai --}}

        {{-- WORKSHOP QUEUE SECTION --}}
        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 class="font-montserrat font-bold text-lg text-gray-800 italic uppercase tracking-tight">
                        Antrian <span class="text-blue-600">Workshop</span>
                    </h2>
                </div>

                <form action="{{ route('dashboard') }}" method="GET" class="relative group w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Pesanan..."
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-xs font-roboto focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none">
                    <div class="absolute left-3 top-2.5 text-gray-400 group-focus-within:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                Detail Sepatu
                            </th>
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                Progres
                            </th>
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                Metode Pembayaran
                            </th>
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($allTransactions as $t)
                            @php
                                $item = $t->transaction_item->first();
                                $prog = $t->detail_transaction->progress_status;
                                $paymentMethod = $t->detail_transaction->payment_method ?? 'Cash';

                                $statusColors = [
                                    'paying' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    'pending' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'sorting' => 'bg-purple-50 text-purple-600 border-purple-100',
                                    'washing' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
                                    'drying' => 'bg-orange-50 text-orange-600 border-orange-100',
                                    'ready' => 'bg-green-50 text-green-600 border-green-100',
                                    'cleared' => 'bg-emerald-600 text-white border-emerald-700',
                                    'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                ];
                            @endphp
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="font-black text-gray-800 italic uppercase leading-none tracking-tight">
                                            {{ $item->shoes_name ?? 'N/A' }}
                                        </span>
                                        <span class="text-[10px] font-mono text-gray-400 mt-1 uppercase tracking-tighter">
                                            #{{ $t->transaction_code }} • <span class="text-blue-500 font-bold">{{ $item->service ?? '-' }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $statusColors[$prog] ?? 'bg-gray-50 text-gray-600' }}">
                                        {{ $prog }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-[10px] font-bold text-gray-700 uppercase tracking-wider bg-gray-100 px-2.5 py-1 rounded-md border border-gray-200 shadow-sm">
                                        {{ $paymentMethod }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button title="Update Progres" data-id="{{ $t->id }}"
                                        class="btn-detail bg-gray-900 hover:bg-blue-600 text-white text-[9px] font-black px-4 py-2 rounded-xl transition-all shadow-sm uppercase tracking-widest">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center text-gray-400 italic">Antrian Workshop Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <x-modal-detail />
</x-app-layout>
