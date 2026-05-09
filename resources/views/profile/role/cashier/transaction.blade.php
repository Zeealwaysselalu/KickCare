<x-app-layout>
    <div class="p-6 sm:p-10 min-h-screen bg-gray-50/50">
        <div class="mb-8 animate-up flex flex-col md:flex-row md:justify-between md:items-end gap-4">
            <div>
                <h1 class="font-montserrat font-extrabold text-3xl text-gray-800 uppercase italic tracking-tight">
                    Kasir <span class="text-blue-600">Dashboard</span>
                </h1>
                <p class="text-gray-500 mt-1 text-sm font-roboto">Input pesanan baru untuk pelanggan di tempat.</p>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <form action="{{ route('transactions.cashier.store') }}" method="POST" class="space-y-6" id="transaction-form">
                    @csrf

                    <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="font-montserrat font-bold text-lg text-gray-800">Pelanggan</h2>
                            </div>

                            <div class="flex bg-gray-100 p-1 rounded-xl border border-gray-200">
                                <label class="flex items-center gap-2 px-4 py-1.5 rounded-lg cursor-pointer transition-all has-[:checked]:bg-white has-[:checked]:shadow-sm">
                                    <input type="radio" name="has_account" value="yes" class="sr-only" checked onchange="toggleAccountMode(true)">
                                    <span class="text-[10px] font-bold uppercase tracking-tight text-gray-600">Ada Akun</span>
                                </label>
                                <label class="flex items-center gap-2 px-4 py-1.5 rounded-lg cursor-pointer transition-all has-[:checked]:bg-white has-[:checked]:shadow-sm">
                                    <input type="radio" name="has_account" value="no" class="sr-only" onchange="toggleAccountMode(false)">
                                    <span class="text-[10px] font-bold uppercase tracking-tight text-gray-600">Guest</span>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div id="email_search_wrapper" class="md:col-span-2 space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Email KickCare Member</label>
                                <div class="flex gap-2">
                                    <input type="email" id="customer_email" name="email" placeholder="Cari email user..."
                                        class="flex-1 px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all text-sm font-medium outline-none">
                                    <button type="button" id="btn-check-user"
                                        class="bg-gray-800 text-white px-6 rounded-xl text-xs font-bold uppercase hover:bg-black transition-all shadow-md active:scale-95">
                                        Cek User
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                                <input type="text" id="display_name" name="customer_name" required readonly placeholder="Cek email dulu"
                                    class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-100 text-sm font-medium transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Tier Member</label>
                                <input type="text" id="display_member_status" readonly value="Bukan Member"
                                    class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-100 text-sm font-bold uppercase text-gray-400 tracking-wider cursor-not-allowed transition-all">
                                <input type="hidden" id="current_discount_rate" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h2 class="font-montserrat font-bold text-lg text-gray-800">Detail Item</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Model Sepatu</label>
                                <input type="text" name="shoes_name" placeholder="Contoh: Nike Dunk Low" required
                                    class="w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all text-sm outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Warna</label>
                                <input type="text" name="shoes_color" placeholder="Contoh: Panda" required
                                    class="w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition-all text-sm outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[24px] p-8 shadow-sm border border-gray-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h2 class="font-montserrat font-bold text-lg text-gray-800">Layanan</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            @foreach([['wash', 'Deep Clean', 65000], ['unyellowing', 'Unyellowing', 80000], ['repaint', 'Repaint', 150000]] as $service)
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="service" value="{{ $service[0] }}" data-price="{{ $service[2] }}" class="peer sr-only" required>
                                <div class="p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 peer-checked:border-blue-600 peer-checked:bg-blue-50/50 transition-all text-center">
                                    <span class="block font-bold text-gray-800 text-sm">{{ $service[1] }}</span>
                                    <span class="block text-[10px] text-blue-600 font-bold mt-1 tracking-tighter">Rp {{ number_format($service[2], 0, ',', '.') }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <input type="hidden" name="outlet_id" value="{{ Auth::user()->outlet_id }}" class="peer sr-only" required>
                    <input type="hidden" name="total_price" id="input-total-price" value="0">
                </form>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <div class="sticky top-10 space-y-6 font-roboto">
                    <div class="bg-gray-900 rounded-[32px] p-8 text-white shadow-2xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/20 rounded-full -mr-16 -mt-16 blur-3xl"></div>

                        <h3 class="font-montserrat font-bold text-xl mb-6 relative z-10 italic uppercase tracking-tight">
                            Billing <span class="text-blue-400">Summary</span>
                        </h3>

                        <div class="space-y-4 relative z-10">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 tracking-wide">Harga Layanan</span>
                                <span class="font-mono font-bold" id="display-price">Rp 0</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400 tracking-wide">Diskon Member</span>
                                <span class="font-mono text-green-400 font-bold" id="display-discount">- Rp 0</span>
                            </div>

                            <div class="pt-6 mt-6 border-t border-white/10 flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-bold text-blue-400 uppercase tracking-widest mb-1">Total Pembayaran</p>
                                    <p class="text-4xl font-montserrat font-extrabold tracking-tighter" id="total-price">Rp 0</p>
                                </div>
                            </div>

                            <button type="submit" form="transaction-form"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-montserrat font-bold py-4 rounded-2xl transition-all shadow-lg shadow-blue-600/40 mt-6 flex items-center justify-center gap-2 group active:scale-[0.98]">
                                Selesaikan Transaksi
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
