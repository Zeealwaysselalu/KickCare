<x-app-layout>
    <div class="bg-gray-50 rounded-[20px] p-6 self-start border border-gray-100">
        <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Rincian Pembayaran</h4>
        <div class="space-y-4">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Harga Layanan</span>
                <span class="text-gray-800 font-medium font-mono">Rp
                    {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>

            <div class="border-t border-dashed border-gray-200 my-2"></div>

            <div class="flex justify-between items-center">
                <div>
                    <span class="block font-bold text-gray-800">Total Bayar</span>
                    <span class="text-[10px] text-green-600 font-bold uppercase tracking-tight">Lunas</span>
                </div>
                <span class="text-2xl font-bold text-blue-600 font-mono tracking-tighter">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="mt-6 p-4 bg-blue-100/40 rounded-xl border border-blue-100 flex items-start gap-3">
            <svg class="w-5 h-5 text-blue-600 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            <p class="text-[11px] text-blue-800 leading-relaxed font-medium">
                Tunjukkan nota digital ini kepada kasir saat pengambilan sepatu di outlet KickCare.
            </p>
        </div>
    </div>
</x-app-layout>
