<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center mb-16 animate-up">
            <h1 class="font-montserrat font-extrabold text-4xl text-gray-900 uppercase italic tracking-tight">
                Member Exclusive <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#A855F7] to-[#3B82F6]">Benefits</span>
            </h1>
            <p class="font-roboto text-gray-600 mt-4 text-lg max-w-2xl mx-auto">
                Nikmati berbagai keuntungan eksklusif yang dirancang khusus untuk merawat sepatu kesayangan Anda berdasarkan tingkatan member.
            </p>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white rounded-[24px] overflow-hidden shadow-xl border {{ $countTransaction < 10 ? 'border-purple-500 ring-2 ring-purple-100 scale-105' : 'border-gray-100' }} flex flex-col transition-all duration-300 hover:-translate-y-2 relative">
                <div class="bg-gradient-to-br from-[#A855F7] to-[#EC4899] p-8 text-white">
                    <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">Standard Tier</span>
                    <h3 class="font-montserrat font-extrabold text-2xl mt-4 uppercase italic">Bronze Member</h3>
                </div>
                <div class="p-8 flex-grow">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="bg-purple-100 rounded-full p-1 mr-3 mt-1 text-purple-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="font-roboto text-gray-700"><strong>Diskon 5%</strong> untuk Unyellowing Treatment.</p>
                        </li>
                    </ul>
                </div>
                <div class="p-8 pt-0">
                    @if ($countTransaction < 10)
                        <div class="w-full text-center py-3 rounded-xl bg-purple-50 border border-purple-200 font-bold text-purple-600 text-sm uppercase">Kamu Berada Di Sini</div>
                    @else
                        <div class="w-full text-center py-3 rounded-xl bg-gray-100 font-bold text-gray-400 text-sm uppercase italic">Tier Terlewati</div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-[24px] overflow-hidden shadow-xl border {{ ($countTransaction >= 10 && $countTransaction < 20) ? 'border-green-500 ring-2 ring-green-100 scale-105' : 'border-gray-100' }} flex flex-col transition-all duration-300 hover:-translate-y-2 relative">
                @if($countTransaction >= 10 && $countTransaction < 20)
                    <div class="absolute top-4 right-4 bg-white/20 text-white text-[10px] font-bold px-2 py-1 rounded">AKTIF</div>
                @endif
                <div class="bg-gradient-to-br from-[#22C55E] to-[#14B8A6] p-8 text-white">
                    <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">Elite Tier</span>
                    <h3 class="font-montserrat font-extrabold text-2xl mt-4 uppercase italic">Silver Member</h3>
                </div>
                <div class="p-8 flex-grow">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="bg-green-100 rounded-full p-1 mr-3 mt-1 text-green-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="font-roboto text-gray-700"><strong>Diskon 10%</strong> Repaint Treatment.</p>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-green-100 rounded-full p-1 mr-3 mt-1 text-green-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="font-roboto text-gray-700">Prioritas antrian reguler.</p>
                        </li>
                    </ul>
                </div>
                <div class="p-8 pt-0">
                    @if ($countTransaction >= 10 && $countTransaction < 20)
                        <div class="w-full text-center py-3 rounded-xl bg-green-50 border border-green-200 font-bold text-green-600 text-sm uppercase">Kamu Berada Di Sini</div>
                    @elseif ($countTransaction < 10)
                        <a href="{{ route('transactions.create') }}" class="block w-full text-center py-3 rounded-xl bg-[#22C55E] text-white font-bold text-sm uppercase shadow-lg shadow-green-200 hover:bg-[#1ba34d] transition">
                            Butuh {{ 10 - $countTransaction }} Transaksi Lagi
                        </a>
                    @else
                        <div class="w-full text-center py-3 rounded-xl bg-gray-100 font-bold text-gray-400 text-sm uppercase italic">Tier Terlewati</div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-[24px] overflow-hidden shadow-xl border {{ $countTransaction >= 20 ? 'border-blue-500 ring-2 ring-blue-100 scale-105' : 'border-gray-100' }} flex flex-col transition-all duration-300 hover:-translate-y-2">
                <div class="bg-gradient-to-br from-[#3B82F6] to-[#06B6D4] p-8 text-white relative">
                    <span class="bg-white/20 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-white/20">Premium Tier</span>
                    <h3 class="font-montserrat font-extrabold text-2xl mt-4 uppercase italic text-[#F4B400]">Gold Member</h3>
                </div>
                <div class="p-8 flex-grow">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="bg-blue-100 rounded-full p-1 mr-3 mt-1 text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="font-roboto text-gray-700"><strong>Diskon 20%</strong> Deep Clean sepanjang tahun.</p>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-blue-100 rounded-full p-1 mr-3 mt-1 text-blue-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="font-roboto text-gray-700"><strong>Free 1x</strong> Basic Wash saat ulang tahun.</p>
                        </li>
                    </ul>
                </div>
                <div class="p-8 pt-0">
                    @if ($countTransaction >= 20)
                        <div class="w-full text-center py-3 rounded-xl bg-blue-50 border border-blue-200 font-bold text-blue-600 text-sm uppercase">Kamu Berada Di Sini</div>
                    @else
                        <a href="{{ route('transactions.create') }}" class="block w-full text-center py-3 rounded-xl bg-[#3B82F6] text-white font-bold text-sm uppercase shadow-lg shadow-blue-200 hover:bg-[#2563eb] transition">
                            Butuh {{ 20 - $countTransaction }} Transaksi Lagi
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
