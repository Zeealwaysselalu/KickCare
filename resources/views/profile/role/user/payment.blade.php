<x-app-layout>
    <div class="p-6 sm:p-10 font-roboto min-h-screen bg-gray-50/50 flex items-center justify-center">
        <div
            class="w-full max-w-5xl bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden animate-up">

            <div class="px-8 py-6 border-b border-gray-50 bg-white flex items-center justify-between">
                <div>
                    <h1 class="font-montserrat font-extrabold text-2xl text-gray-800 uppercase italic tracking-tight">
                        Selesaikan <span class="text-blue-600">Pembayaran</span>
                    </h1>
                    <p class="text-gray-500 mt-0.5 text-xs">Pesanan #{{ $transaction->transaction_code }}</p>
                </div>
                <a href="{{ route('pesanan') }}"
                    class="text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">
                    &larr; Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 divide-y md:divide-y-0 md:divide-x divide-gray-100">

                <div class="p-8 md:col-span-5 bg-gray-50/30">
                    <h3 class="font-bold text-gray-800 text-sm mb-4 uppercase tracking-wider text-gray-400">
                        Ringkasan Pesanan
                    </h3>

                    <div class="mb-5 p-3.5 bg-white border border-gray-100 rounded-2xl">
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold">Pelanggan</p>
                        <p class="font-extrabold text-gray-800 text-sm mt-0.5">
                            {{ $transaction->user->name ?? 'Pelanggan Umum' }}
                        </p>
                        @if (isset($transaction->user->status_member))
                            <span
                                class="inline-block mt-1 text-[9px] font-extrabold uppercase tracking-widest px-2 py-0.5 bg-blue-50 text-blue-600 rounded-full border border-blue-100">
                                Member {{ $transaction->user->status_member }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <p class="text-[10px] uppercase tracking-wider text-gray-400 font-bold mb-1">Detail Item</p>

                        @foreach ($transaction->transaction_item as $item)
                            <div
                                class="flex justify-between items-start p-3 bg-white border border-gray-100 rounded-2xl shadow-sm/50">
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">
                                        {{ $item->shoes_name }}
                                    </p>

                                    <div class="mt-1.5 flex items-center gap-1.5">
                                        <span
                                            class="text-[10px] text-blue-600 font-bold uppercase tracking-wider bg-blue-50/60 border border-blue-100 px-2 py-0.5 rounded-md">
                                            {{ $item->service }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="space-y-2 text-xs pt-2">
                            <div
                                class="flex justify-between text-gray-800 font-extrabold text-base pt-3 border-t border-dashed border-gray-200">
                                <p>Total Bayar</p>
                                <p class="text-blue-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 md:col-span-7 bg-white">
                    <form id="payment-form" action="{{ route('payment.process', $transaction->id) }}" method="POST"
                        class="h-full flex flex-col justify-between space-y-6">
                        @csrf

                        <div class="space-y-5 my-auto py-2">
                            <div>
                                <h3 class="text-gray-800 font-extrabold text-base">Pilih Metode Pembayaran</h3>
                                <p class="text-gray-400 text-[11px] mt-0.5">Silakan pilih salah satu metode pembayaran
                                    instan di bawah ini.</p>
                            </div>

                            <div class="grid grid-cols-2 gap-2">
                                <label
                                    class="relative border border-gray-200 p-2.5 rounded-xl flex items-center gap-2 cursor-pointer transition-all hover:border-gray-300 hover:bg-gray-50/50 focus-within:border-blue-600 focus-within:bg-blue-50/10 group">
                                    <input type="radio" name="payment_mock" value="qris" checked
                                        class="w-3.5 h-3.5 text-blue-600 focus:ring-blue-500">
                                    <div class="leading-none">
                                        <p class="text-[11px] font-bold text-gray-800 uppercase tracking-tight">QRIS</p>
                                        <p class="text-[9px] text-gray-400 mt-0.5">Bayar dengan QRIS</p>
                                    </div>
                                </label>

                                <label
                                    class="relative border border-gray-200 p-2.5 rounded-xl flex items-center gap-2 cursor-pointer transition-all hover:border-gray-300 hover:bg-gray-50/50 focus-within:border-blue-600 focus-within:bg-blue-50/10 group {{ auth()->user()->balance < $transaction->total_price ? 'opacity-50' : '' }}">
                                    <input type="radio" name="payment_mock" value="balance"
                                        {{ auth()->user()->balance < $transaction->total_price ? 'disabled' : '' }}
                                        class="w-3.5 h-3.5 text-blue-600 focus:ring-blue-500 disabled:opacity-50">
                                    <div class="leading-none">
                                        <p class="text-[11px] font-bold text-gray-800 uppercase tracking-tight">Saldo
                                            Akun</p>
                                        @if (auth()->user()->balance < $transaction->total_price)
                                            <p class="text-[9px] text-red-600 mt-0.5 font-semibold">Saldo tidak cukup
                                            </p>
                                        @else
                                            <p class="text-[9px] text-gray-400 mt-0.5">
                                                Rp {{ number_format(auth()->user()->balance ?? 0, 0, ',', '.') }}
                                            </p>
                                        @endif
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-50">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl text-xs font-bold shadow-lg shadow-blue-100 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Proses Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-modal-qris :transaction="$transaction" />
</x-app-layout>
