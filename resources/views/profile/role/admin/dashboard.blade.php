<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickCare Admin Dashboard</title>

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
                            danger: '#EF4444',
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
</head>
<body class="bg-kickcare-base font-roboto text-kickcare-secondary antialiased overflow-x-hidden">

    <div class="min-h-screen grid grid-cols-[260px,1fr]">

        <aside class="bg-kickcare-card border-r border-kickcare-stroke p-6 flex flex-col z-10 sticky top-0 h-screen">
            <div class="mb-10 flex items-center gap-2">
                <span class="font-montserrat font-bold text-2xl text-kickcare-blue">Kick<span class="text-kickcare-cyan">Care</span></span>
                <span class="bg-gray-100 text-kickcare-secondary font-roboto font-bold text-[10px] px-2 py-1 rounded-md uppercase tracking-wider">Admin</span>
            </div>

            <nav class="space-y-2">
                <p class="font-roboto font-medium text-xs text-gray-400 uppercase tracking-wider mb-3 mt-4">Menu Utama</p>

                <a href="#" class="flex items-center gap-3.5 px-4 py-3 rounded-lg bg-blue-50 text-kickcare-blue font-medium text-[15px]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Overview
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-kickcare-dark hover:bg-gray-50 font-normal text-[15px] transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Manajemen Pesanan
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-kickcare-dark hover:bg-gray-50 font-normal text-[15px] transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Data Pelanggan
                </a>
                <a href="#" class="flex items-center gap-3.5 px-4 py-3 rounded-lg text-kickcare-dark hover:bg-gray-50 font-normal text-[15px] transition">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Laporan Keuangan
                </a>
            </nav>
        </aside>

        <main class="flex flex-col h-screen overflow-y-auto">
            <header class="bg-kickcare-card border-b border-kickcare-stroke px-8 py-4 flex items-center justify-between shadow-sm sticky top-0 z-20">
                <div class="relative w-96">
                    <input type="text" placeholder="Cari ID pesanan, nama pelanggan, atau staf..." class="w-full bg-kickcare-base rounded-full pl-10 pr-4 py-2 text-sm border border-kickcare-stroke focus:ring-1 focus:ring-kickcare-blue outline-none font-roboto">
                    <svg class="absolute left-3 top-2.5 w-4 h-4 text-kickcare-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div class="flex items-center gap-5">
                    <button class="relative text-gray-400 hover:text-kickcare-dark transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute -top-1 -right-1 flex h-4 w-4">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 border-2 border-white"></span>
                        </span>
                    </button>
                    <div class="flex items-center gap-3 border-l border-kickcare-stroke pl-5">
                        <div class="text-right hidden md:block">
                            <p class="font-roboto font-medium text-sm text-kickcare-dark">Administrator</p>
                            <p class="font-roboto font-normal text-xs text-kickcare-secondary">Super Admin</p>
                        </div>
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Admin" class="w-10 h-10 rounded-full border-2 border-kickcare-stroke">
                    </div>
                </div>
            </header>

            <div class="p-8 space-y-8">

                <div class="flex justify-between items-end">
                    <div>
                        <h1 class="font-montserrat font-bold text-[30px] text-kickcare-dark tracking-tight">Dashboard Admin</h1>
                        <p class="font-roboto font-normal text-sm text-kickcare-secondary mt-1">Pantau performa bisnis dan pesanan KickCare hari ini.</p>
                    </div>
                    <button class="bg-kickcare-blue text-white font-roboto font-medium text-sm px-5 py-2.5 rounded-lg shadow-md hover:bg-blue-600 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Pesanan Manual
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-sm text-kickcare-secondary mb-2 uppercase tracking-wide">Pendapatan (Bln Ini)</h2>
                        <div class="flex items-end justify-between">
                            <span class="font-roboto font-bold text-3xl text-kickcare-dark leading-none">Rp 45.2Jt</span>
                            <span class="font-roboto font-medium text-xs text-green-600 bg-green-50 px-2 py-1 rounded-md">+8.5%</span>
                        </div>
                    </div>
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-sm text-kickcare-secondary mb-2 uppercase tracking-wide">Pesanan Aktif</h2>
                        <div class="flex items-end justify-between">
                            <span class="font-roboto font-bold text-3xl text-kickcare-dark leading-none">84</span>
                            <span class="font-roboto font-medium text-xs text-red-600 bg-red-50 px-2 py-1 rounded-md">12 Tertunda</span>
                        </div>
                    </div>
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-sm text-kickcare-secondary mb-2 uppercase tracking-wide">Total Pelanggan</h2>
                        <div class="flex items-end justify-between">
                            <span class="font-roboto font-bold text-3xl text-kickcare-dark leading-none">1,240</span>
                            <span class="font-roboto font-medium text-xs text-kickcare-gold bg-yellow-50 px-2 py-1 rounded-md border border-yellow-100">320 Gold</span>
                        </div>
                    </div>
                    <div class="bg-kickcare-card p-6 rounded-kick shadow-kick-soft border border-kickcare-stroke/50">
                        <h2 class="font-montserrat font-semibold text-sm text-kickcare-secondary mb-2 uppercase tracking-wide">Tim Operasional</h2>
                        <div class="flex items-end justify-between">
                            <span class="font-roboto font-bold text-3xl text-kickcare-dark leading-none">15</span>
                            <span class="font-roboto font-normal text-xs text-kickcare-secondary">Teknisi Aktif</span>
                        </div>
                    </div>
                </div>

                <div class="bg-kickcare-card rounded-kick shadow-kick-soft border border-kickcare-stroke/50 overflow-hidden">
                    <div class="px-6 py-5 border-b border-kickcare-stroke flex justify-between items-center bg-white">
                        <h2 class="font-montserrat font-semibold text-lg text-kickcare-dark">Menunggu Tindakan / Sedang Diproses</h2>
                        <button class="font-roboto font-medium text-sm text-kickcare-blue hover:underline">Lihat Semua Data</button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-gray-50 border-b border-kickcare-stroke">
                                <tr>
                                    <th class="px-6 py-3 font-roboto font-medium text-xs text-kickcare-secondary uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 font-roboto font-medium text-xs text-kickcare-secondary uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 font-roboto font-medium text-xs text-kickcare-secondary uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-3 font-roboto font-medium text-xs text-kickcare-secondary uppercase tracking-wider">Teknisi (Assignee)</th>
                                    <th class="px-6 py-3 font-roboto font-medium text-xs text-kickcare-secondary uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 font-roboto font-medium text-xs text-kickcare-secondary uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-kickcare-stroke">
                                <tr class="hover:bg-gray-50/50 transition duration-150">
                                    <td class="px-6 py-4 font-roboto font-medium text-sm text-kickcare-dark">#KC-8802</td>
                                    <td class="px-6 py-4">
                                        <p class="font-roboto font-medium text-sm text-kickcare-dark">Siti Aminah</p>
                                        <p class="font-roboto font-normal text-xs text-kickcare-secondary">Member Regular</p>
                                    </td>
                                    <td class="px-6 py-4 font-roboto font-normal text-sm text-kickcare-dark">Deep Cleaning</td>
                                    <td class="px-6 py-4">
                                        <span class="font-roboto font-normal text-sm text-gray-400 italic">Belum Diatur</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-medium text-xs bg-orange-50 text-orange-600 border border-orange-100">Menunggu Pickup</span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <button class="font-roboto font-medium text-xs bg-kickcare-blue text-white px-3 py-1.5 rounded hover:bg-blue-600 transition">Assign</button>
                                        <button class="font-roboto font-medium text-xs text-gray-500 hover:text-kickcare-dark px-2 py-1.5 border border-gray-200 rounded">Detail</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50/50 transition duration-150">
                                    <td class="px-6 py-4 font-roboto font-medium text-sm text-kickcare-dark">#KC-8801</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <p class="font-roboto font-medium text-sm text-kickcare-dark">Kevin Sanjaya</p>
                                                <p class="font-roboto font-normal text-xs text-kickcare-gold flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    Member Gold
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-roboto font-normal text-sm text-kickcare-dark">Repaint Full</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <img src="https://randomuser.me/api/portraits/men/22.jpg" class="w-6 h-6 rounded-full">
                                            <span class="font-roboto font-normal text-sm text-kickcare-dark">Dimas</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full font-roboto font-medium text-xs bg-blue-50 text-kickcare-blue border border-blue-100">Diproses</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="font-roboto font-medium text-xs text-gray-500 hover:text-kickcare-dark px-2 py-1.5 border border-gray-200 rounded">Update Status</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
