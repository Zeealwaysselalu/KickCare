<x-app-layout>
    <div class="p-6 lg:p-8 max-w-4xl mx-auto">
        {{-- HEADER --}}
        <header class="mb-10">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-indigo-600 font-black text-[10px] uppercase tracking-[2px] mb-4 hover:gap-3 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>
            <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                Edit Profil <span class="text-indigo-600">Pelanggan</span>
            </h1>
        </header>

        {{-- FORM CARD --}}
        <div class="bg-white rounded-[40px] border border-gray-100 shadow-2xl shadow-indigo-100/50 overflow-hidden">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-10 lg:p-12">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- KIRI: DATA DASAR --}}
                    <div class="space-y-6">
                        <h2 class="text-[10px] font-black text-indigo-600 uppercase tracking-[3px] mb-6 flex items-center gap-2">
                            <span class="w-6 h-px bg-indigo-600"></span> Identitas Akun
                        </h2>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>
                    </div>

                    {{-- KANAN: STATUS & SALDO --}}
                    <div class="space-y-6">
                        <h2 class="text-[10px] font-black text-indigo-600 uppercase tracking-[3px] mb-6 flex items-center gap-2">
                            <span class="w-6 h-px bg-indigo-600"></span> Membership & Wallet
                        </h2>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Status Member</label>
                            <select name="status_member" required
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all appearance-none">
                                <option value="bronze" {{ $user->status_member == 'bronze' ? 'selected' : '' }}>BRONZE</option>
                                <option value="silver" {{ $user->status_member == 'silver' ? 'selected' : '' }}>SILVER</option>
                                <option value="gold" {{ $user->status_member == 'gold' ? 'selected' : '' }}>GOLD</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Saldo (Balance)</label>
                            <div class="relative">
                                <span class="absolute left-6 top-4 font-bold text-gray-400 text-sm">Rp</span>
                                <input type="number" name="balance" value="{{ old('balance', $user->balance) }}" required
                                    class="w-full pl-14 pr-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                            </div>
                            <p class="text-[9px] text-gray-400 italic mt-1">*Hati-hati saat merubah saldo pelanggan secara manual.</p>
                        </div>

                        <div class="space-y-2 pt-4">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Password Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diganti"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-sm transition-all">
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-5 rounded-[24px] font-black text-xs uppercase tracking-[3px] transition-all shadow-xl shadow-indigo-200 active:scale-[0.98]">
                        Simpan Perubahan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
