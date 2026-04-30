<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="font-montserrat font-bold text-[32px] text-gray-800 leading-tight">
                    Halo, {{ Auth::user()->username }}
                </h1>
                <p class="font-roboto text-[#6B7280] text-sm mt-1">Pantau performa dan pesanan KickCare hari ini.</p>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="hidden sm:flex items-center gap-1.5 bg-yellow-50 text-[#F4B400] px-3 py-1 rounded-full border border-yellow-200">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span class="font-roboto font-medium text-xs uppercase tracking-wider">Kasir On Duty</span>
                </div>
            </div>
        </header>

        {{-- Statistics Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-[16px] shadow-sm border border-gray-100 transition hover:shadow-md">
                <h2 class="font-montserrat font-semibold text-sm text-gray-500 uppercase tracking-wider mb-4">Total
                    Pesanan</h2>
                <div class="flex items-end justify-between">
                    <span
                        class="font-roboto font-bold text-4xl text-gray-800 leading-none">{{ $totalOrders ?? 0 }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[16px] shadow-sm border border-gray-100 transition hover:shadow-md">
                <h2 class="font-montserrat font-semibold text-sm text-gray-500 uppercase tracking-wider mb-4">Pesanan
                    Diproses</h2>
                <div class="flex items-end justify-between">
                    <span
                        class="font-roboto font-bold text-4xl text-gray-800 leading-none text-[#3B82F6]">{{ $processingOrders ?? 0 }}</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[16px] shadow-sm border border-gray-100 transition hover:shadow-md">
                <h2 class="font-montserrat font-semibold text-sm text-gray-500 uppercase tracking-wider mb-4">Pendapatan
                </h2>
                <div class="flex items-end justify-between">
                    <span class="font-roboto font-bold text-3xl text-gray-800 leading-none">Rp
                        {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Main Content Table --}}
        <div class="bg-white rounded-[20px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
                <h2 class="font-montserrat font-bold text-lg text-gray-800 italic uppercase tracking-tight">
                    Pesanan <span class="text-blue-600">Terakhir</span>
                </h2>
                <a href="{{ route('pesanan') }}"
                    class="text-xs font-bold text-blue-600 hover:text-blue-700 transition uppercase tracking-widest">
                    Lihat Semua
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th
                                class="px-6 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                ID Pesanan</th>
                            <th
                                class="px-6 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                Pelanggan</th>
                            <th
                                class="px-6 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                Layanan</th>
                            <th
                                class="px-6 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px]">
                                Status</th>
                            <th
                                class="px-6 py-4 font-roboto font-bold text-[10px] text-gray-400 uppercase tracking-[2px] text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($latestTransactions as $transaction)
                            <tr class="hover:bg-blue-50/30 transition duration-150 group">
                                <td class="px-6 py-4 font-roboto font-medium text-sm text-gray-800">
                                    #{{ $transaction->transaction_code ?? $transaction->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-[10px]">
                                            {{ strtoupper(substr($transaction->customer_name, 0, 2)) }}
                                        </div>
                                        <span
                                            class="font-roboto font-medium text-sm text-gray-800">{{ $transaction->customer_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-roboto text-sm text-gray-600 uppercase">
                                    {{ $transaction->types ?? $transaction->service }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($transaction->status === 'pending')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-bold text-[10px] uppercase tracking-wider bg-blue-50 text-[#3B82F6]">
                                            Diproses
                                        </span>
                                    @elseif ($transaction->status === 'completed')
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-bold text-[10px] uppercase tracking-wider bg-green-50 text-green-600">
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-bold text-[10px] uppercase tracking-wider bg-red-50 text-red-600">
                                            {{ $transaction->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="font-montserrat font-bold text-[11px] text-blue-600 hover:text-blue-800 uppercase tracking-widest transition group-hover:translate-x-1 inline-block">
                                        Detail →
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-10 text-center text-gray-400 font-roboto text-sm italic">
                                    Belum ada data transaksi masuk hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer Pagination / Info --}}
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex justify-between items-center">
                <span class="font-roboto text-[11px] text-gray-400 uppercase tracking-widest">
                    Menampilkan {{ count($latestTransactions ?? []) }} transaksi terbaru
                </span>
                <div class="flex gap-2">
                    {{-- Pagination Laravel Jika Ada: {{ $latestTransactions->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
