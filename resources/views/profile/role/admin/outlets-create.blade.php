<x-app-layout>
    <div class="p-6 lg:p-8 max-w-4xl mx-auto">
        <header class="mb-10">
            <a href="{{ route('admin.outlets.index') }}" class="inline-flex items-center gap-2 text-indigo-600 font-black text-[10px] uppercase tracking-[2px] mb-4 hover:gap-3 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>
            <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                Registrasi <span class="text-indigo-600">Outlet & Kasir</span>
            </h1>
        </header>

        <div class="bg-white rounded-[40px] border border-gray-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
            <form action="{{ route('admin.outlets.store') }}" method="POST" class="p-10 lg:p-12">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- KIRI: DATA AKUN KASIR --}}
                    <div class="space-y-6">
                        <h2 class="text-[10px] font-black text-indigo-600 uppercase tracking-[3px] mb-6 flex items-center gap-2">
                            <span class="w-6 h-px bg-indigo-600"></span> Akun Kasir (Login)
                        </h2>
                        
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" required placeholder="Contoh: kasir_bekasi"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Email Kasir</label>
                            <input type="email" name="email" required placeholder="kasir@kickcare.com"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Password Default</label>
                            <input type="password" name="password" required placeholder="********"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>
                    </div>

                    {{-- KANAN: DATA OUTLET --}}
                    <div class="space-y-6">
                        <h2 class="text-[10px] font-black text-indigo-600 uppercase tracking-[3px] mb-6 flex items-center gap-2">
                            <span class="w-6 h-px bg-indigo-600"></span> Informasi Outlet
                        </h2>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Outlet</label>
                            <input type="text" name="outlet_name" required placeholder="KickCare Ahmad Yani"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat Lengkap</label>
                            <textarea name="address" rows="4" required placeholder="Alamat lengkap cabang..."
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-3xl focus:ring-2 focus:ring-indigo-500 font-medium text-sm transition-all italic leading-relaxed"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-5 rounded-[24px] font-black text-xs uppercase tracking-[3px] transition-all shadow-xl shadow-indigo-200 active:scale-[0.98]">
                        Buat Akun & Daftarkan Outlet
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>