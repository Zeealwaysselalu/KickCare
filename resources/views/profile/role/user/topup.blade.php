<x-app-layout>
    <div class="p-6 sm:p-10 font-roboto min-h-screen bg-gray-50/50 flex items-center justify-center">
        <div class="w-full max-w-xl bg-white rounded-[28px] shadow-sm border border-gray-100 overflow-hidden">

            <div class="px-8 py-6 border-b border-gray-50 bg-white flex items-center justify-between">
                <div>
                    <h1 class="font-montserrat font-extrabold text-2xl text-gray-800 uppercase italic tracking-tight">
                        Isi Ulang <span class="text-blue-600">Saldo</span>
                    </h1>
                    <p class="text-gray-500 mt-0.5 text-xs">Tambahkan dana ke akun KickCare Anda</p>
                </div>
                <a href="{{ route('dashboard') }}"
                    class="text-xs font-bold text-gray-400 hover:text-gray-600 transition-colors">
                    &larr; Kembali
                </a>
            </div>

            <div class="p-8">
                <div class="mb-6 p-4 bg-blue-50/50 rounded-2xl border border-blue-100/50 flex items-center justify-between">
                    <div>
                        <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Saldo Anda Saat Ini</p>
                        <p class="text-xl font-black text-blue-600 mt-0.5">
                            Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                        </p>
                    </div>
                    <svg class="w-8 h-8 text-blue-500/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>

                @if ($errors->any())
                    <div class="mb-5 p-3.5 bg-red-50 border border-red-100 rounded-xl">
                        @foreach ($errors->all() as $error)
                            <p class="text-xs text-red-600 font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="space-y-6">
                    <div>
                        <label for="amount" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Masukkan Nominal Top Up
                        </label>
                        <div class="relative rounded-xl shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-400 font-extrabold text-sm">Rp</span>
                            </div>
                            <input type="number" id="amount" min="10000" max="10000000" required
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl text-gray-800 font-extrabold text-base focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-600 transition-all placeholder-gray-300"
                                placeholder="0">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1.5 font-medium">* Minimal pengisian Rp 10.000</p>
                    </div>

                    <div>
                        <p class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pilih Nominal Instan</p>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach([20000, 50000, 100000, 200000, 500000, 1000000] as $value)
                                <button type="button" onclick="setTopUpAmount({{ $value }})"
                                    class="py-2.5 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-700 hover:border-blue-600 hover:text-blue-600 hover:bg-blue-50/10 transition-all active:scale-95">
                                    {{ number_format($value, 0, ',', '.') }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="button" onclick="triggerTopUpQris()"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3.5 rounded-xl text-xs font-bold shadow-lg shadow-blue-100 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span>Lanjut Pembayaran QRIS</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $mockTransaction = (object) [
            'total_price' => 0,
            'transaction_code' => 'TOPUP-' . strtoupper(Str::random(6))
        ];
    @endphp
    <x-modal-qris :transaction="$mockTransaction" />
</x-app-layout>
