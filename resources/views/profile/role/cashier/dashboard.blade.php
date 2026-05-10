<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        {{-- HEADER DASHBOARD --}}
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="font-montserrat font-bold text-[28px] text-gray-800 leading-tight">
                    Dashboard Kasir
                </h1>
                <p class="font-roboto text-gray-500 text-sm mt-1">Kelola pesanan masuk dan pantau progres cuci hari ini.
                </p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="pr-4">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Jam Operasional</p>
                    <p class="text-xs font-bold text-gray-700">09:00 - 21:00 WIB</p>
                </div>
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
                <p class="text-[10px] text-gray-400 mt-4 font-medium italic">*Sorting, Washing, Drying</p>
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
                <p class="text-[10px] text-gray-400 mt-4 font-medium italic">*Menunggu pelanggan</p>
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
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Detail
                                Sepatu</th>
                            <th
                                class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                Status Global</th>
                            <th
                                class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">
                                Progres Produksi</th>
                            <th
                                class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($allTransactions as $t)
                            @php
                                $item = $t->transaction_item->first();
                                $prog = $t->detail_transaction->progress_status;
                                $status = $t->detail_transaction->status;

                                $colors = [
                                    'waiting' => 'bg-amber-50 text-amber-700 border-amber-200 ring-amber-500/20',
                                    'pending' => 'bg-blue-50 text-blue-600 border-blue-100',
                                    'sorting' => 'bg-purple-50 text-purple-600 border-purple-100',
                                    'washing' => 'bg-cyan-50 text-cyan-600 border-cyan-100',
                                    'drying' => 'bg-orange-50 text-orange-600 border-orange-100',
                                    'ready' => 'bg-green-50 text-green-600 border-green-100',
                                    'cleared' => 'bg-emerald-600 text-white border-emerald-700',
                                    'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                ];
                            @endphp
                            <tr
                                class="{{ $prog === 'waiting' ? 'bg-amber-50/20' : '' }} hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="font-black text-gray-800 italic uppercase leading-none tracking-tight">
                                                {{ $item->shoes_name ?? 'N/A' }}
                                            </span>
                                            @if ($prog === 'waiting')
                                                <span
                                                    class="bg-amber-500 text-[8px] text-white px-1.5 py-0.5 rounded font-black animate-bounce uppercase">New</span>
                                            @endif
                                        </div>
                                        <span
                                            class="text-[10px] font-mono text-gray-400 mt-1 uppercase tracking-tighter">
                                            #{{ $t->transaction_code }} • <span
                                                class="text-blue-500 font-bold">{{ $item->service }}</span>
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if ($status === 'pending')
                                        <span
                                            class="text-[9px] font-black uppercase px-3 py-1 rounded-full bg-blue-50 text-blue-600 border border-blue-100 tracking-widest">Active</span>
                                    @elseif($status === 'completed')
                                        <span
                                            class="text-[9px] font-black uppercase px-3 py-1 rounded-full bg-green-50 text-green-600 border border-green-100 tracking-widest">Done</span>
                                    @else
                                        <span
                                            class="text-[9px] font-black uppercase px-3 py-1 rounded-full bg-red-50 text-red-600 border border-red-100 tracking-widest">Cancelled</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if (in_array($prog, ['cleared', 'cancelled']))
                                        <span
                                            class="inline-flex items-center px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $colors[$prog] }}">
                                            {{ $prog }}
                                        </span>
                                    @else
                                        <div class="relative inline-block">
                                            @php
                                                // Definisikan urutan status (Index menentukan level)
                                                $statusOrder = [
                                                    'waiting',
                                                    'pending',
                                                    'sorting',
                                                    'washing',
                                                    'drying',
                                                    'ready',
                                                    'cleared',
                                                ];
                                                $currentIndex = array_search($prog, $statusOrder);
                                            @endphp

                                            <select
                                                onchange="confirmStatusUpdate(this, {{ $t->id }}, '{{ $prog }}')"
                                                class="text-[10px] font-black uppercase tracking-wider rounded-xl py-2 px-4 focus:ring-4 focus:ring-blue-100 transition-all cursor-pointer border shadow-sm {{ $colors[$prog] ?? 'bg-white text-gray-800 border-gray-200' }}">

                                                {{-- Status saat ini (disabled agar tidak bisa dipilih ulang) --}}
                                                <option value="{{ $prog }}" selected disabled>●
                                                    {{ strtoupper($prog) }}</option>

                                                <option disabled>──────────</option>

                                                {{-- Hanya tampilkan status yang index-nya lebih tinggi dari status sekarang --}}
                                                @foreach ($statusOrder as $index => $statusName)
                                                    @if ($index > $currentIndex)
                                                        <option value="{{ $statusName }}">
                                                            @if ($statusName == 'pending')
                                                                Accept Order
                                                            @else
                                                                {{ ucfirst($statusName) }}
                                                            @endif
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        @if ($prog === 'waiting')
                                            <form action="{{ route('kasir.approve', $t->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-amber-500 hover:bg-amber-600 text-white text-[9px] font-black px-4 py-2 rounded-lg transition-all shadow-md shadow-amber-100 uppercase tracking-widest">
                                                    Accept
                                                </button>
                                            </form>
                                        @endif

                                        <button title="Lihat Detail" data-id="{{ $t->id }}"
                                            class="btn-detail p-2 bg-white text-gray-400 hover:text-blue-600 rounded-lg transition-colors border border-gray-100 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
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
                                <td colspan="4" class="py-20 text-center">
                                    <div class="flex flex-col items-center opacity-20">
                                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-xl font-black italic uppercase tracking-widest">Antrean Kosong
                                        </p>
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
