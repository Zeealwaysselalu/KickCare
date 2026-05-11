<x-app-layout>
    <div class="p-6 lg:p-8 max-w-7xl mx-auto">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h1 class="font-montserrat font-extrabold text-[28px] text-gray-800 uppercase italic tracking-tight">
                    Daftar <span class="text-indigo-600">Outlet</span>
                </h1>
                <p class="font-roboto text-gray-500 text-sm mt-1">Manajemen seluruh cabang KickCare yang terdaftar.</p>
            </div>
            <button onclick="window.location.href='{{ route('admin.outlets.create') }}'"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3.5 rounded-[20px] font-black text-[10px] uppercase tracking-[2px] transition-all shadow-xl shadow-indigo-100 flex items-center gap-3 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Registrasi Outlet
            </button>
        </header>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($outlets as $outlet)
                <div
                    class="bg-white rounded-[40px] border border-gray-100 shadow-sm overflow-hidden group hover:shadow-2xl hover:shadow-indigo-100/50 transition-all duration-500 relative">
                    <div class="relative h-52 bg-indigo-50 overflow-hidden">
                        @if ($outlet->image)
                            <img src="{{ asset('storage/' . $outlet->image) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-indigo-200">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-5 right-5 flex items-center gap-2">
                            <a href="{{ route('admin.outlets.edit', $outlet->id) }}"
                                class="w-9 h-9 flex items-center justify-center bg-indigo-600 text-white hover:bg-indigo-700 rounded-full transition-all shadow-lg active:scale-90"
                                title="Edit Outlet">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.outlets.destroy', $outlet->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus outlet ini? Akun kasir terkait juga akan terhapus.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-9 h-9 flex items-center justify-center bg-white/90 backdrop-blur text-rose-500 hover:bg-rose-500 hover:text-white rounded-full transition-all shadow-lg active:scale-90"
                                    title="Hapus Outlet">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="mb-2">
                            <h3
                                class="font-montserrat font-extrabold text-xl text-gray-800 uppercase italic leading-tight group-hover:text-indigo-600 transition-colors">
                                {{ $outlet->name }}
                            </h3>
                            <div class="flex items-start gap-2 text-gray-400 mt-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <p class="text-xs font-roboto leading-relaxed line-clamp-2 italic">
                                    {{ $outlet->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 text-center">
                    <div
                        class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <p class="text-gray-400 font-roboto italic">Belum ada outlet terdaftar di sistem.</p>
                </div>
            @endforelse
        </div>
        @if ($outlets->hasPages())
            <div class="mt-12 bg-white p-4 rounded-[24px] border border-gray-50 shadow-sm">
                {{ $outlets->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
