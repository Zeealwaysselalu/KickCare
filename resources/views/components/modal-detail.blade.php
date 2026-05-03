<div id="modalDetail" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50 backdrop-blur-sm" onclick="closeModal()">
        </div>

        <div
            class="relative inline-block w-full max-w-md my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-[24px] animate-up">
            <button
                class="btn-close absolute top-5 right-5 z-20 p-1.5 rounded-full bg-gray-100/50 hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition group"
                aria-label="Tutup Nota">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            <div id="modalContent">
            </div>
        </div>
    </div>
</div>
