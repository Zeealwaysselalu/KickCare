<x-app-layout>
    <div class="p-6 sm:p-10 bg-gray-50 min-h-screen font-roboto">
        <div class="mb-10 animate-up">
            <h1 class="font-montserrat font-extrabold text-3xl text-gray-800 uppercase italic leading-tight">
                Customer <span class="text-blue-600">Service</span>
            </h1>
            <div class="w-20 h-1.5 bg-blue-600 mt-2 rounded-full"></div>
            <p class="text-gray-500 mt-4 max-w-2xl">Ada kendala atau pertanyaan? Kami siap membantu langkah Anda kembali
                nyaman.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">

                <div class="bg-white p-8 rounded-[24px] shadow-sm border border-gray-100">
                    <h3 class="font-montserrat font-bold text-xl text-gray-800 mb-6 flex items-center">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </span>
                        Kirim Pesan Bantuan
                    </h3>
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Subjek
                                    Masalah</label>
                                <select
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition">
                                    <option>Status Pesanan</option>
                                    <option>Keluhan Hasil Cuci</option>
                                    <option>Masalah Pembayaran</option>
                                    <option>Kerjasama/Partnership</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">ID
                                    Transaksi (Opsional)</label>
                                <input type="text" placeholder="#KC-0000"
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Pesan
                                Anda</label>
                            <textarea rows="4" placeholder="Jelaskan kendala Anda secara detail..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-100 transition-all transform hover:-translate-y-1">
                            Kirim Aduan Sekarang
                        </button>
                    </form>
                </div>

                <div class="space-y-4">
                    <h3 class="font-montserrat font-bold text-lg text-gray-800 px-2">Pertanyaan Populer (FAQ)</h3>

                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                        <details class="group">
                            <summary class="flex items-center justify-between cursor-pointer list-none">
                                <span class="text-sm font-semibold text-gray-700">Berapa lama proses cuci Deep
                                    Clean?</span>
                                <span class="transition group-open:rotate-180 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="text-xs text-gray-500 mt-4 leading-relaxed">Proses pengerjaan standar kami adalah
                                2-3 hari kerja tergantung pada tingkat kekotoran dan jenis material sepatu Anda.</p>
                        </details>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                        <details class="group">
                            <summary class="flex items-center justify-between cursor-pointer list-none">
                                <span class="text-sm font-semibold text-gray-700">Apakah KickCare menyediakan layanan
                                    antar jemput?</span>
                                <span class="transition group-open:rotate-180 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </span>
                            </summary>
                            <p class="text-xs text-gray-500 mt-4 leading-relaxed">Untuk saat ini kami melayani
                                antar-jemput khusus area Tangerang Kota dengan biaya tambahan flat Rp15.000.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <a href="https://wa.me/yournumber" target="_blank"
                    class="block bg-gradient-to-br from-green-500 to-green-600 p-8 rounded-[24px] shadow-lg shadow-green-100 text-white group hover:scale-[1.02] transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-white/20 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                            </svg>
                        </div>
                        <span
                            class="text-[10px] bg-white/20 px-3 py-1 rounded-full font-bold uppercase tracking-widest">Online</span>
                    </div>
                    <h4 class="font-bold text-xl mb-1">WhatsApp Chat</h4>
                    <p class="text-sm text-green-50 mb-6">Respon cepat via Chat WhatsApp setiap hari (09.00 - 21.00)</p>
                    <div class="flex items-center font-bold text-sm">
                        Hubungi Sekarang <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </div>
                </a>

                <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100">
                    <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Waktu Operasional
                    </h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-sm text-gray-600 font-medium">Senin - Jumat</span>
                            <span class="text-sm text-gray-800 font-bold italic">10.00 - 18.00</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-sm text-gray-600 font-medium">Sabtu</span>
                            <span class="text-sm text-gray-800 font-bold italic">11.00 - 16.00</span>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <span class="text-sm text-gray-600 font-medium text-red-400">Minggu</span>
                            <span class="text-sm text-gray-400 font-bold italic">Libur</span>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-600 p-6 rounded-[24px] text-white flex items-center gap-4">
                    <div class="bg-white/20 p-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold opacity-70 uppercase tracking-widest">Email Support</p>
                        <p class="text-sm font-medium">help@kickcare.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
