<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        {{-- HEADER --}}
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                    Data <span class="text-indigo-600">Pelanggan</span>
                </h1>
                <p class="font-roboto text-gray-500 text-sm mt-1">Manajemen basis data pengguna dan status loyalitas.</p>
            </div>

            {{-- SEARCH BAR --}}
            <form action="" method="GET" class="relative w-full md:w-72">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama atau email..."
                    class="w-full pl-12 pr-4 py-3 bg-white border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 shadow-sm text-sm transition-all">
                <div class="absolute left-4 top-3.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
            </form>
        </header>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[2px]">Pengguna</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[2px]">Status Member</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[2px]">Saldo</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-[2px] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold border border-indigo-100">
                                            {{ substr($user->name ?? $user->name, 0, 1) }}
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800 text-sm leading-tight">{{ $user->name ?? $user->name }}</span>
                                            <span class="text-[11px] text-gray-400 mt-0.5">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $badgeColors = [
                                            'gold' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'silver' => 'bg-slate-50 text-slate-500 border-slate-100',
                                            'bronze' => 'bg-orange-50 text-orange-600 border-orange-100',
                                        ];
                                        $color = $badgeColors[$user->status_member] ?? $badgeColors['bronze'];
                                    @endphp
                                    <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $color }}">
                                        {{ $user->status_member }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-bold text-gray-700">
                                        Rp {{ number_format($user->balance, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button onclick="window.location.href='{{ route('admin.users.edit', $user->id) }}'" class="p-2.5 bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all border border-gray-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </button>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2.5 bg-gray-50 text-gray-400 hover:bg-rose-50 hover:text-rose-500 rounded-xl transition-all border border-gray-100">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center text-gray-400 italic font-roboto">
                                    Tidak ada pengguna yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
