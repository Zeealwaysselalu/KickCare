@props(['transaction'])

<div id="qris-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-900/60 backdrop-blur-xs p-4">
    <div class="bg-white rounded-[24px] max-w-sm w-full p-6 text-center shadow-2xl border border-gray-100 animate-up">

        <div class="flex justify-between items-center mb-4">
            <div class="text-left">
                <h4 class="font-extrabold text-gray-800 text-base">QRIS Pembayaran</h4>
                <p class="text-[10px] text-gray-400">Pesanan #{{ $transaction->transaction_code }}</p>
            </div>
            <button type="button" onclick="closeQrisModal()"
                class="text-gray-400 hover:text-gray-600 font-bold text-sm bg-gray-50 hover:bg-gray-100 w-7 h-7 rounded-full flex items-center justify-center transition-colors">
                ✕
            </button>
        </div>

        <div class="bg-blue-50/50 rounded-xl py-2 px-3 mb-4 border border-blue-50">
            <p class="text-[10px] text-gray-500 font-medium">Total Tagihan</p>
            <p id="modal-qris-amount" class="text-base font-black text-blue-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white border-2 border-gray-100 rounded-2xl p-4 inline-block mx-auto mb-4 shadow-sm">
            <img id="modal-qris-image" src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=KickCare_Code_{{ $transaction->transaction_code }}"
                 alt="QRIS Code Dummy"
                 class="w-48 h-48 mx-auto rounded-lg">
        </div>

        <p class="text-[10px] text-gray-400 leading-normal px-2">
            Silakan melakukan pemindaian melalui e-wallet pilihan Anda. Setelah pembayaran selesai, kasir kami akan segera memperbarui status pesanan Anda secara berkala.
        </p>

    </div>
</div>
