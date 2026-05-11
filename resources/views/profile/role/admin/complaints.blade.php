<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        {{-- HEADER --}}
        <header class="mb-8">
            <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                Laporan <span class="text-indigo-600">Pengaduan</span>
            </h1>
            <p class="font-roboto text-gray-500 text-sm mt-1">Daftar keluhan dan masukan dari pelanggan KickCare.</p>
        </header>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Perihal</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Tanggal</th>
                            <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($complaints as $complaint)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($complaint->user->name) }}&background=EEF2FF&color=4F46E5"
                                            class="w-9 h-9 rounded-xl shadow-sm">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-800 text-sm leading-tight">{{ $complaint->user->name }}</span>
                                            <span class="text-[10px] text-gray-400">{{ $complaint->user->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-black uppercase tracking-wider border border-indigo-100">
                                        {{ $complaint->subject }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="text-xs font-medium text-gray-500 font-mono">
                                        {{ $complaint->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    {{-- Tombol Diubah ke Indigo --}}
                                    <button
                                        class="view-complaint-btn bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black px-5 py-2.5 rounded-xl transition-all shadow-sm shadow-indigo-100 uppercase tracking-widest"
                                        data-name="{{ $complaint->user->name }}"
                                        data-subject="{{ $complaint->subject }}"
                                        data-date="{{ $complaint->created_at->translatedFormat('d F Y, H:i') }}"
                                        data-message="{{ $complaint->message }}">
                                        Baca Detail
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-24 text-center text-gray-400 italic font-roboto">
                                    Belum ada pengaduan yang masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($complaints->hasPages())
                <div class="px-8 py-4 bg-gray-50/50 border-t border-gray-50">
                    {{ $complaints->links() }}
                </div>
            @endif
        </div>
    </div>
    <x-modal-complaint />
</x-app-layout>