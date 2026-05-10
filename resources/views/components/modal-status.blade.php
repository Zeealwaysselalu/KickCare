<div id="statusModal" class="fixed inset-0 z-[99] hidden">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeStatusModal()">
    </div>
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[95%] max-w-md">
        <div class="bg-white rounded-[28px] overflow-hidden shadow-2xl border border-blue-100">
            @if($latest)
                <div class="bg-blue-600 p-6 text-white relative">
                    <button onclick="closeStatusModal()" class="absolute right-6 top-6 text-white/50 hover:text-white transition-colors text-lg">✕</button>
                    <h3 class="font-montserrat font-bold text-xl uppercase tracking-tight">Status Tracking</h3>
                    <p class="text-[10px] text-white/50 mt-1 font-mono tracking-widest uppercase italic">
                        #{{ $latest->transaction_code }}
                    </p>
                </div>

                <div class="p-8">
                    @php
                        $steps = [
                            'pending' => ['judul' => 'Pesanan Diterima', 'sub' => 'Admin telah mengonfirmasi cucian Anda.'],
                            'sorting' => ['judul' => 'Pengecekan', 'sub' => 'Pemeriksaan noda dan kondisi material sepatu.'],
                            'washing' => ['judul' => 'Sedang Dicuci', 'sub' => 'Sepatu Anda sedang dibersihkan oleh tim ahli.'],
                            'drying'  => ['judul' => 'Pengeringan', 'sub' => 'Proses pengeringan di suhu aman agar material terjaga.'],
                            'ready'   => ['judul' => 'Siap Diambil', 'sub' => 'Sepatu sudah bersih, wangi, dan siap diambil!'],
                        ];
                        $stepKeys = array_keys($steps);
                        $currentStatus = $latest->detail_transaction->progress_status ?? 'pending';
                        $currentIdx = array_search($currentStatus, $stepKeys);
                    @endphp

                    <div class="relative">
                        <div class="absolute left-[11px] top-2 bottom-2 w-[2px] bg-gray-100"></div>

                        <div class="space-y-8">
                            @foreach($steps as $key => $val)
                                @php 
                                    $loopIdx = array_search($key, $stepKeys);
                                    $isCompleted = $loopIdx < $currentIdx;
                                    $isActive = $loopIdx === $currentIdx;
                                @endphp
                                
                                <div class="flex gap-5 relative">
                                    <div class="z-10 w-6 h-6 rounded-full border-4 flex items-center justify-center transition-all duration-500 
                                        {{ $isActive ? 'border-blue-100 bg-blue-600 animate-pulse' : ($isCompleted ? 'border-green-50 bg-green-500' : 'border-white bg-gray-200') }}">
                                        @if($isCompleted)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1 -mt-1">
                                        <h5 class="text-sm font-black {{ $isActive ? 'text-blue-600' : ($isCompleted ? 'text-gray-800' : 'text-gray-400') }}">
                                            {{ $val['judul'] }}
                                        </h5>
                                        <p class="text-[11px] {{ $isActive ? 'text-gray-600' : 'text-gray-400' }} mt-0.5 leading-relaxed font-medium">
                                            {{ $val['sub'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-8 text-center">
                        <p class="text-gray-500">Data transaksi tidak ditemukan.</p>
                    </div>
                @endif

                <button onclick="closeStatusModal()" class="mt-8 w-full py-3.5 border-2 border-gray-100 text-gray-500 text-[11px] font-bold rounded-2xl hover:bg-gray-50 uppercase transition-all tracking-widest">
                    Tutup Panel
                </button>
            </div>
        </div>
    </div>
</div>