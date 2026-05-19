<div id="statusModal" class="fixed inset-0 z-[99] hidden">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeStatusModal()"></div>

    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[95%] max-w-md">
        <div class="bg-white rounded-[28px] overflow-hidden shadow-2xl border border-gray-100 transition-all animate-up">
            @if($latest)
                @php
                    $steps = [
                        'paying' => ['judul' => 'Menunggu Pembayaran', 'sub' => 'Pesanan Anda sedang menunggu pembayaran.'],
                        'pending' => ['judul' => 'Pesanan Diterima', 'sub' => 'Admin mengonfirmasi cucian Anda.'],
                        'sorting' => ['judul' => 'Pengecekan', 'sub' => 'Pemeriksaan noda & material.'],
                        'washing' => ['judul' => 'Sedang Dicuci', 'sub' => 'Pembersihan oleh tim ahli.'],
                        'drying'  => ['judul' => 'Pengeringan', 'sub' => 'Proses pengeringan suhu aman.'],
                        'ready'   => ['judul' => 'Siap Diambil', 'sub' => 'Sudah bersih & siap dibawa pulang!'],
                        'cleared' => ['judul' => 'Selesai', 'sub' => 'Sepatu telah diambil. Sampai jumpa!'],
                    ];
                    $stepKeys = array_keys($steps);
                    $currentStatus = $latest->detail_transaction->progress_status ?? 'pending';
                    $currentIdx = array_search($currentStatus, $stepKeys);
                    $isCancelled = $currentStatus === 'cancelled';
                @endphp

                <div class="bg-gradient-to-br {{ $isCancelled ? 'from-red-500 to-red-600' : 'from-blue-600 to-cyan-500' }} p-7 text-white relative">
                    <button onclick="closeStatusModal()" class="absolute right-6 top-7 text-white/60 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <span class="text-[10px] font-bold uppercase tracking-[2px] opacity-80 font-roboto">Transaction Tracker</span>
                    <h3 class="font-montserrat font-extrabold text-2xl uppercase italic leading-tight mt-1">
                        {{ $isCancelled ? 'Order Cancelled' : 'Laundry Status' }}
                    </h3>
                    <div class="mt-4 flex items-center gap-2">
                         <span class="text-[10px] font-mono bg-black/20 px-3 py-1 rounded-full border border-white/10">
                            #{{ $latest->transaction_code }}
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    @if($isCancelled)
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <h4 class="font-montserrat font-bold text-gray-800 uppercase">Pesanan Dibatalkan</h4>
                            <p class="text-xs text-gray-500 mt-2 leading-relaxed">
                                {{ $latest->detail_transaction->cancel_reason ?? 'Maaf, pesanan Anda tidak dapat kami proses saat ini.' }}
                            </p>
                        </div>
                    @else
                        <div class="relative">
                            <div class="absolute left-[11px] top-2 bottom-2 w-[2px] bg-gray-100"></div>

                            <div class="space-y-7">
                                @foreach($steps as $key => $val)
                                    @php
                                        $loopIdx = array_search($key, $stepKeys);
                                        $isCompleted = $loopIdx < $currentIdx;
                                        $isActive = $loopIdx === $currentIdx;
                                    @endphp

                                    <div class="flex gap-5 relative">
                                        <div class="z-10 w-6 h-6 rounded-full border-4 flex items-center justify-center transition-all duration-500
                                            {{ $isActive ? 'border-blue-50 bg-blue-600 ring-4 ring-blue-50' : ($isCompleted ? 'border-green-50 bg-green-500' : 'border-white bg-gray-200') }}">
                                            @if($isCompleted || ($key === 'cleared' && $isActive))
                                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex-1 -mt-1">
                                            <h5 class="text-[12px] font-bold uppercase tracking-tight {{ $isActive ? 'text-blue-600' : ($isCompleted ? 'text-gray-800' : 'text-gray-400') }}">
                                                {{ $val['judul'] }}
                                            </h5>
                                            <p class="text-[11px] font-roboto {{ $isActive ? 'text-gray-600' : 'text-gray-400' }} mt-0.5 leading-relaxed font-medium">
                                                {{ $val['sub'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <button onclick="closeStatusModal()"
                        class="mt-10 w-full py-3.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-[11px] font-bold rounded-xl transition-all uppercase tracking-widest border border-blue-100">
                        Tutup Detail
                    </button>
                </div>
            @else
                <div class="p-12 text-center">
                    <p class="text-gray-400 text-sm font-roboto">Data transaksi tidak ditemukan.</p>
                    <button onclick="closeStatusModal()" class="mt-4 text-blue-600 font-bold uppercase text-[10px]">Kembali</button>
                </div>
            @endif
        </div>
    </div>
</div>
