<div id="cancelModal"
    class="fixed inset-0 z-50 hidden bg-gray-900/50 flex items-center justify-center backdrop-blur-sm transition-opacity">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden transform transition-all">
        <div class="p-6">

            <div class="flex items-center gap-3 mb-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Batalkan Pesanan</h3>
            </div>

            <p class="text-sm text-gray-600 mb-6">
                Apakah Anda yakin ingin membatalkan pesanan ini? Tindakan ini tidak dapat dikembalikan.
            </p>

            <form id="cancelForm" action="" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <label for="cancel_reason" class="block text-sm font-medium text-gray-700 mb-2">Alasan Pembatalan
                        (Opsional)</label>
                    <textarea name="cancel_reason" id="cancel_reason" rows="3"
                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 text-sm p-3"
                        placeholder="Beritahu kami alasan Anda membatalkan pesanan ini..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" id="closeModalBtn"
                        class="px-4 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-xl transition-colors">
                        Kembali
                    </button>
                    <button type="submit"
                        class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-xl transition-colors shadow-sm shadow-red-200">
                        Ya, Batalkan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
