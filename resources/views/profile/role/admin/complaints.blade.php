<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        <header class="mb-8">
            <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                Laporan <span class="text-blue-600">Pengaduan</span>
            </h1>
            <p class="font-roboto text-gray-500 text-sm mt-1">Daftar keluhan dan masukan dari pelanggan KickCare.</p>
        </header>

        <div class="bg-white rounded-[24px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Isi Pengaduan</th>
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Tanggal</th>
                            <th class="px-8 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($complaints as $complaint)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($complaint->user->name) }}&background=EBF5FF&color=3B82F6" class="w-8 h-8 rounded-full">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800 text-sm">{{ $complaint->user->name }}</span>
                                            <span class="text-[10px] text-gray-400">{{ $complaint->user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm text-gray-600 leading-relaxed max-w-md">
                                        "{{ str($complaint->subject) }}"
                                    </p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-xs font-medium text-gray-500">
                                        {{ $complaint->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-amber-50 text-amber-600 border border-amber-100">
                                        Baru Masuk
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center text-gray-400 italic font-roboto">
                                    Belum ada pengaduan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($complaints->hasPages())
                <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-50">
                    {{ $complaints->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
