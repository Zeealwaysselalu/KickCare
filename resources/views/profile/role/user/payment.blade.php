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
                    <h3 class="font-bold text-gray-800 text-sm mb-4 uppercase tracking-wider text-gray-400">Ringkasan
                        Pesanan</h3>

                    <div class="space-y-4">
                        @foreach ($transaction->transaction_item as $item)
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $item->shoes_name }}</p>
                                    <p
                                        class="text-xs text-gray-400 mt-0.5 font-medium uppercase tracking-wider bg-gray-100 inline-block px-1.5 py-0.5 rounded">
                                        {{ $item->service }}
                                    </p>
                                </div>
                                <p class="text-sm font-bold text-gray-800">Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                        @endforeach

                        <hr class="border-gray-100 my-2">

                        <div class="space-y-2 text-xs">
                            <div class="flex justify-between text-gray-500">
                                <p>Subtotal</p>
                                <p>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <p>Diskon Member ({{ strtoupper(Auth::user()->status_member ?? 'None') }})</p>
                                <p>- Rp 0</p>
                            </div>
                            <div
                                class="flex justify-between text-gray-800 font-extrabold text-base pt-2 border-t border-dashed border-gray-200">
                                <p>Total Bayar</p>
                                <p class="text-blue-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 md:col-span-7 flex flex-col justify-between bg-white">
                    <div class="space-y-5 my-auto py-2">

                        <div>
                            <h3 class="text-gray-800 font-extrabold text-base">Pilih Metode Pembayaran</h3>
                            <p class="text-gray-400 text-[11px] mt-0.5">Silakan pilih salah satu metode pembayaran
                                instan di bawah ini.</p>
                        </div>

                        <div class="grid grid-cols-2 gap-2">

                            <label
                                class="relative border border-gray-200 p-2.5 rounded-xl flex items-center gap-2 cursor-pointer transition-all hover:border-gray-300 hover:bg-gray-50/50 focus-within:border-blue-600 focus-within:bg-blue-50/10 group">
                                <input type="radio" name="payment_mock" value="qris"
                                    class="w-3.5 h-3.5 text-blue-600 focus:ring-blue-500">
                                <div class="leading-none">
                                    <p class="text-[11px] font-bold text-gray-800 uppercase tracking-tight">QRIS / GPN
                                    </p>
                                    <p class="text-[9px] text-gray-400 mt-0.5">Otomatis</p>
                                </div>
                            </label>

                            <label
                                class="relative border border-gray-200 p-2.5 rounded-xl flex items-center gap-2 cursor-pointer transition-all hover:border-gray-300 hover:bg-gray-50/50 focus-within:border-blue-600 focus-within:bg-blue-50/10 group">
                                <input type="radio" name="payment_mock" value="va" checked
                                    class="w-3.5 h-3.5 text-blue-600 focus:ring-blue-500">
                                <div class="leading-none">
                                    <p class="text-[11px] font-bold text-gray-800 uppercase tracking-tight">Virtual
                                        Account</p>
                                    <p class="text-[9px] text-gray-400 mt-0.5">Transfer Bank</p>
                                </div>
                            </label>

                            <label
                                class="relative border border-gray-200 p-2.5 rounded-xl flex items-center gap-2 cursor-pointer transition-all hover:border-gray-300 hover:bg-gray-50/50 focus-within:border-blue-600 focus-within:bg-blue-50/10 group">
                                <input type="radio" name="payment_mock" value="ewallet"
                                    class="w-3.5 h-3.5 text-blue-600 focus:ring-blue-500">
                                <div class="leading-none">
                                    <p class="text-[11px] font-bold text-gray-800 uppercase tracking-tight">E-Wallet</p>
                                    <p class="text-[9px] text-gray-400 mt-0.5">GoPay / OVO / Dana</p>
                                </div>
                            </label>

                            <label
                                class="relative border border-gray-200 p-2.5 rounded-xl flex items-center gap-2 cursor-pointer transition-all hover:border-gray-300 hover:bg-gray-50/50 focus-within:border-blue-600 focus-within:bg-blue-50/10 group">
                                <input type="radio" name="payment_mock" value="cc"
                                    class="w-3.5 h-3.5 text-blue-600 focus:ring-blue-500">
                                <div class="leading-none">
                                    <p class="text-[11px] font-bold text-gray-800 uppercase tracking-tight">Kartu Kredit
                                    </p>
                                    <p class="text-[9px] text-gray-400 mt-0.5">Visa / MasterCard</p>
                                </div>
                            </label>

                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-50">
                        <button type="button" id="pay-button"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl text-xs font-bold shadow-lg shadow-blue-100 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Proses Pembayaran Simulasi
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- Tempat menaruh script Snap Token/Payment Gateway JavaScript SDK kamu di masa mendatang --}}
    {{-- @push('scripts') --}}
    {{-- <script type="text/javascript"> --}}
    {{--    document.getElementById('pay-button').onclick = function(){ ... } --}}
    {{-- </script> --}}
    {{-- @endpush --}}
</x-app-layout>
