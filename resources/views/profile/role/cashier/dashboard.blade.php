<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickCare Dashboard Mockup</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kickcare: {
                            base: '#F5F7FA',
                            card: '#FFFFFF',
                            blue: '#3B82F6',
                            cyan: '#06B6D4',
                            gold: '#F4B400',
                            dark: '#1F2937',
                            secondary: '#6B7280',
                            stroke: '#E5E7EB',
                        }
                    },
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                        roboto: ['Roboto', 'sans-serif'],
                    },
                    borderRadius: {
                        'kick': '14px',
                    },
                    boxShadow: {
                        'kick-soft': '0 6px 20px rgba(0,0,0,0.06)',
                    }
                }
            }
        }
    </script>
    <style>
        /* Memastikan font rendering halus */
        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body class="bg-kickcare-base font-roboto text-kickcare-secondary antialiased overflow-x-hidden">

    <div class="min-h-screen grid grid-cols-[260px,1fr]">

        <aside class="bg-kickcare-card border-r border-kickcare-stroke p-6 flex flex-col z-10">
            <div class="mb-10">
                <span class="font-montserrat font-bold text-2xl text-kickcare-blue">Kick<span class="text-kickcare-cyan">Care</span></span>
            </div>
            <nav class="space-y-3">
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 rounded-lg bg-blue-50 text-kickcare-blue font-medium text-[15px]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Abc... (icon dummy)"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-kickcare-dark hover:bg-gray-50 font-normal text-[15px]">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Abc... (icon dummy)"></path></svg>
                    Pesanan Selesai
                </a>
                </nav>
        </aside>

        <main>
            <header class="bg-kickcare-card border-b border-kickcare-stroke px-8 py-4 flex items-center justify-between shadow-sm sticky top-0 z-9">
                <div class="relative w-72">
                    <input type="text" placeholder="Cari pesanan..." class="w-full bg-kickcare-base rounded-full pl-10 pr-4 py-2 text-sm border border-kickcare-stroke focus:ring-1 focus:ring-kickcare-blue outline-none">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-kickcare-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5 bg-yellow-50 text-kickcare-gold px-3 py-1 rounded-full border border-yellow-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <span class="font-roboto font-medium text-xs">Member Gold</span>
                    </div>
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="w-10 h-10 rounded-full border-2 border-kickcare-stroke">
                </div>
            </header>

            <div class="p-8 space-y-8">

                <h1 class="font-montserrat font-bold text-[30px] text-kickcare-dark tracing-tight">Halo, Kasir</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-lg text-kickcare-dark mb-4">Total Pesanan</h2>
                        <div class="flex items-end justify-between">
                            <span class="font-roboto font-bold text-4xl text-kickcare-dark leading-none">150</span>
                            <span class="font-roboto font-normal text-xs text-green-600 bg-green-50 px-2.5 py-1 rounded-full">+12% bln ini</span>
                        </div>
                    </div>
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-lg text-kickcare-dark mb-4">Pesanan Diproses</h2>
                        <span class="font-roboto font-bold text-4xl text-kickcare-dark leading-none">12</span>
                    </div>
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-lg text-kickcare-dark mb-4">Total Pendapatan</h2>
                        <span class="font-roboto font-bold text-4xl text-kickcare-dark leading-none">Rp 7.5jt</span>
                    </div>
                </div>

                <div class="bg-kickcare-card rounded-kick shadow-kick-soft border border-kickcare-stroke/50 overflow-hidden">
                    <div class="px-6 py-5 border-b border-kickcare-stroke">
                        <h2 class="font-montserrat font-semibold text-lg text-kickcare-dark">Pesanan Terakhir</h2>
                    </div>

                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-kickcare-stroke">
                            <tr>
                                <th class="px-6 py-3 font-roboto font-normal text-xs text-kickcare-secondary uppercase tracking-wider">ID Pesanan</th>
                                <th class="px-6 py-3 font-roboto font-normal text-xs text-kickcare-secondary uppercase tracking-wider">Nama Pelanggan</th>
                                <th class="px-6 py-3 font-roboto font-normal text-xs text-kickcare-secondary uppercase tracking-wider">Layanan</th>
                                <th class="px-6 py-3 font-roboto font-normal text-xs text-kickcare-secondary uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 font-roboto font-normal text-xs text-kickcare-secondary uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-kickcare-stroke">
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="px-6 py-4 font-roboto font-normal text-sm text-kickcare-dark">#KC90122</td>
                                <td class="px-6 py-4 font-roboto font-medium text-sm text-kickcare-dark flex items-center gap-3">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-8 h-8 rounded-full">
                                    Andini Sarah
                                </td>
                                <td class="px-6 py-4 font-roboto font-normal text-sm text-kickcare-dark">Deep Cleaning (Sneakers)</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-medium text-xs bg-green-50 text-green-700">Selesai</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="font-roboto font-medium text-sm text-kickcare-blue hover:text-blue-700">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition duration-150">
                                <td class="px-6 py-4 font-roboto font-normal text-sm text-kickcare-dark">#KC90123</td>
                                <td class="px-6 py-4 font-roboto font-medium text-sm text-kickcare-dark flex items-center gap-3">
                                    <img src="https://randomuser.me/api/portraits/men/65.jpg" class="w-8 h-8 rounded-full">
                                    Budi Dermawan
                                </td>
                                <td class="px-6 py-4 font-roboto font-normal text-sm text-kickcare-dark">Whitening (Unyellowing)</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-medium text-xs bg-blue-50 text-kickcare-blue">Diproses</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="font-roboto font-medium text-sm text-kickcare-blue hover:text-blue-700">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="px-6 py-4 border-t border-kickcare-stroke bg-gray-50 flex justify-between items-center">
                        <span class="font-roboto font-normal text-xs text-kickcare-secondary">Menampilkan 1-2 dari 50 pesanan</span>
                        <div class="flex gap-2">
                            <button class="px-3 py-1 border border-kickcare-stroke rounded bg-white text-xs font-medium text-kickcare-dark hover:bg-gray-50">Prev</button>
                            <button class="px-3 py-1 border border-kickcare-stroke rounded bg-white text-xs font-medium text-kickcare-dark hover:bg-gray-50">Next</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
