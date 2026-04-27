<x-app-layout>
    <div class="p-6 sm:p-10 bg-gray-50 min-h-screen">
        <div class="mb-8 animate-up">
            <h1 class="font-montserrat font-extrabold text-3xl text-gray-800 uppercase italic tracking-tight">
                Pesan <span class="text-blue-600">Layanan</span>
            </h1>
            <p class="text-gray-500 mt-1 text-sm font-roboto">Lengkapi detail pengerjaan sepatu kesayangan Anda.</p>
        </div>

        <div class="grid grid-cols-12 gap-8">

            <div class="col-span-12 lg:col-span-8 space-y-6">
                <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6" id="transaction-form">
                    @csrf
                    <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="font-montserrat font-bold text-lg text-gray-800">Detail Pelanggan & Sepatu</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2 space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama
                                    Lengkap Pelanggan</label>
                                <input type="text" name="customer_name" placeholder="Masukkan nama pemilik sepatu"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none text-sm font-medium">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Model
                                    Sepatu</label>
                                <input type="text" name="shoes_name" placeholder="Contoh: Converse Chuck 70s"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Warna
                                    Sepatu</label>
                                <input type="text" name="shoes_color" placeholder="Contoh: Hitam Putih"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all outline-none text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="font-montserrat font-bold text-lg text-gray-800">Pilih Outlet</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($allOutlet as $outlet)
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="outlet_id" value="{{ $outlet->id }}"
                                        class="peer sr-only" required>
                                    <div
                                        class="p-4 rounded-2xl border-2 border-gray-100 bg-white peer-checked:border-blue-600 peer-checked:bg-blue-50/50 transition-all">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span
                                                    class="block font-bold text-gray-800 text-sm">{{ $outlet->name }}</span>
                                                <p class="text-[11px] text-gray-500 mt-1">{{ $outlet->address }}</p>
                                            </div>
                                            <div
                                                class="w-5 h-5 rounded-full border-2 border-gray-300 bg-white flex items-center justify-center transition-all
                                group-has-[:checked]:border-blue-600">
                                                <div
                                                    class="w-2.5 h-2.5 rounded-full bg-blue-600 transition-all
                                    opacity-0 scale-0
                                    group-has-[:checked]:opacity-100 group-has-[:checked]:scale-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h2 class="font-montserrat font-bold text-lg text-gray-800">Layanan KickCare</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="service" value="wash" data-price="65000" class="peer sr-only"
                                {{ ($selectedService ?? '') == 'wash' ? 'checked' : '' }}/>
                                <div
                                    class="p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50/50 transition-all text-center">
                                    <span class="block font-bold text-gray-800 text-sm">Deep Clean</span>
                                    <span class="price block text-[10px] text-gray-400 uppercase font-bold mt-1">Rp
                                        65.000</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="service" value="unyellowing" data-price="80000" class="peer sr-only"
                                {{ ($selectedService ?? '') == 'unyellowing' ? 'checked' : '' }}/>
                                <div
                                    class="p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50/50 transition-all text-center">
                                    <span class="block font-bold text-gray-800 text-sm">Unyellowing</span>
                                    <span class="block text-[10px] text-gray-400 uppercase font-bold mt-1">Rp
                                        80.000</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="service" value="repaint" data-price="150000" class="peer sr-only"
                                {{ ($selectedService ?? '') == 'repaint' ? 'checked' : '' }}/>
                                <div
                                    class="p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50/50 transition-all text-center">
                                    <span class="block font-bold text-gray-800 text-sm">Repaint</span>
                                    <span class="block text-[10px] text-gray-400 uppercase font-bold mt-1">Rp
                                        150.000</span>
                                </div>
                            </label>
                            <input type="hidden" name="total_price" id="input-total-price" value="0">
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <div class="sticky top-10 space-y-6">
                    <div class="bg-gray-900 rounded-[32px] p-8 text-white shadow-xl relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-blue-600/20 rounded-full -mr-16 -mt-16 blur-3xl">
                        </div>

                        <h3
                            class="font-montserrat font-bold text-xl mb-6 relative z-10 italic uppercase tracking-tight">
                            Ringkasan <span class="text-blue-400">Order</span></h3>

                        <div class="space-y-4 relative z-10">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Subtotal Layanan</span>
                                <span class="font-mono" id="display-price">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Outlet</span>
                                <span class="font-medium text-blue-400" id="selected-outlet">Belum dipilih</span>
                            </div>
                            <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Total
                                        Estimasi</p>
                                    <p class="text-3xl font-montserrat font-extrabold" id="total-price">Rp 0</p>
                                </div>
                            </div>
                            <button type="submit" form="transaction-form"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-montserrat font-bold py-4 rounded-2xl transition-all shadow-lg shadow-blue-600/20 mt-4 flex items-center justify-center gap-2 group">
                                Konfirmasi Pesanan
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 bg-amber-50 rounded-2xl border border-amber-100 flex gap-3">
                        <svg class="w-5 h-5 text-amber-500 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 112 0 1 1 0 01-2 0zm-1 9a1 1 0 102 0v-4a1 1 0 10-2 0v4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-[11px] text-amber-800 leading-relaxed font-medium font-roboto">
                            Pembayaran dilakukan di outlet saat penyerahan sepatu atau melalui transfer setelah admin
                            mengonfirmasi pesanan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
