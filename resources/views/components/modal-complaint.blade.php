<div id="complaintModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>
    
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-lg transform overflow-hidden rounded-[40px] bg-white p-10 shadow-2xl transition-all border border-gray-100">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-montserrat font-extrabold text-2xl text-gray-800 uppercase italic">
                        Detail <span class="text-indigo-600">Aduan</span>
                    </h3>
                    <p id="modal-date" class="text-[10px] text-gray-400 font-bold uppercase mt-1 tracking-[2px]"></p>
                </div>
                <button onclick="closeComplaintModal()" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:text-red-500 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-5">
                <div class="bg-indigo-50/50 p-5 rounded-[24px] border border-indigo-100 flex items-center gap-4">
                    <div>
                        <p class="text-[9px] text-indigo-400 font-black uppercase tracking-widest mb-0.5">Nama Pelanggan</p>
                        <p id="modal-name" class="font-bold text-gray-800 text-sm tracking-tight"></p>
                    </div>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-[32px] border border-gray-100 relative">
                    <div class="absolute -top-3 left-6">
                        <span id="modal-subject" class="px-4 py-1.5 bg-white border border-gray-100 rounded-full text-[10px] font-black text-indigo-600 shadow-sm uppercase tracking-wider"></span>
                    </div>
                    <p class="text-[9px] text-gray-300 font-black uppercase tracking-widest mb-3 mt-2">Isi Pesan Aduan:</p>
                    <p id="modal-message" class="text-gray-600 leading-relaxed font-roboto text-sm"></p>
                </div>
            </div>

            <div class="mt-10">
                <button onclick="closeComplaintModal()" class="w-full py-4 bg-indigo-600 text-white rounded-[20px] font-black text-[11px] uppercase tracking-[3px] hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100 active:scale-[0.98]">
                    Tutup Laporan
                </button>
            </div>
        </div>
    </div>
</div>