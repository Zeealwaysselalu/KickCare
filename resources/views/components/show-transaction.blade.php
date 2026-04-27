<div class="bg-white rounded-[24px] p-6 self-start relative overflow-hidden max-w-sm mx-auto">
    <div class="relative z-10">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-1">Nota Digital KickCare</h4>
                <p class="font-roboto text-[11px] text-gray-400">{{ $transaction->created_at->format('d M Y') }}</p>
            </div>
            <span class="bg-blue-100 text-blue-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                {{ $transaction->status }}
            </span>
        </div>

        <div class="mb-5 flex flex-col items-center">
            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-1">Customer</p>
            <h2 class="font-montserrat font-extrabold text-lg text-gray-800 uppercase">
                {{ $transaction->customer_name ?? 'Guest Customer' }}
            </h2>
        </div>

        <div class="mb-6 text-center py-5 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
            <span class="block text-[10px] text-blue-600 font-bold uppercase mb-1">Item & Treatment</span>
            <h3 class="font-montserrat font-bold text-[18px] text-gray-800 leading-tight px-4">
                {{ $transaction->shoes_name }}
            </h3>
            <div class="flex items-center justify-center gap-2 mt-2">
                <span class="px-2 py-0.5 bg-gray-200 text-gray-600 rounded text-[9px] font-bold uppercase">
                    {{ $transaction->shoes_color ?? 'Multi Color' }}
                </span>
                <span class="text-gray-300">•</span>
                <span class="text-[11px] text-gray-500 font-medium italic">
                    {{ ucfirst($transaction->service) }} Service
                </span>
            </div>
        </div>

        <div class="space-y-3 mb-6 bg-white p-2">
            <div class="flex justify-between text-[12px]">
                <span class="font-roboto text-gray-400 italic">No. Referensi</span>
                <span class="text-gray-800 font-bold font-mono">{{ $transaction->id }}</span>
            </div>
            <div class="flex justify-between text-[12px]">
                <span class="font-roboto text-gray-400 italic">Outlet</span>
                <span class="text-gray-800 font-medium">{{ $transaction->outlet->name ?? 'Pusat' }}</span>
            </div>
            <div class="pt-2 border-t border-gray-100 flex justify-between items-center">
                <span class="font-roboto text-gray-500 text-[13px]">Total Pembayaran</span>
                <span class="text-blue-600 font-black font-mono text-base">
                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center p-5 bg-gray-50 border-2 border-gray-100 rounded-2xl mb-6">
            <div class="bg-white p-2 border border-gray-200 rounded-xl shadow-sm">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ $transaction->transaction_code }}"
                    alt="QR Code" class="w-[110px] h-[110px]">
            </div>
            <p class="font-roboto text-[9px] text-gray-400 mt-4 uppercase tracking-[0.4em] font-bold">Valid ID: {{ $transaction->transaction_code }}</p>
        </div>

        <div class="p-4 bg-blue-600 rounded-xl flex items-start gap-3 shadow-lg shadow-blue-200">
            <svg class="w-5 h-5 text-white shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="font-roboto text-[10px] text-blue-50 leading-relaxed">
                Harap simpan nota digital ini. Status pesanan dapat dipantau melalui dashboard atau scan QR di atas.
            </p>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-3 bg-[url('https://www.transparenttextures.com/patterns/zigzag.png')] opacity-20 bg-blue-900"></div>
</div>