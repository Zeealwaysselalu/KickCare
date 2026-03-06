<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KickCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #F5F7FA;
            --primary-blue: #3B82F6;
            --text-dark: #1F2937;
            --text-secondary: #6B7280;
        }
        body { font-family: 'Roboto', sans-serif; background-color: var(--bg-main); color: var(--text-dark); }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        .card-shadow { box-shadow: 0 6px 20px rgba(0,0,0,0.06); }
    </style>
</head>
<body class="flex min-h-screen">

    <aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col p-6 fixed h-full">
        <div class="mb-10">
            <h2 class="font-montserrat font-800 text-2xl text-blue-600 italic">KICKCARE.</h2>
        </div>
        <nav class="space-y-4 flex-1">
            <a href="#" class="flex items-center space-x-3 text-blue-600 font-medium p-3 bg-blue-50 rounded-xl">
                <span>Dashboard</span>
            </a>
            <a href="#" class="flex items-center space-x-3 text-gray-500 hover:text-blue-600 p-3 transition">
                <span>Pesanan Saya</span>
            </a>
            <a href="#" class="flex items-center space-x-3 text-gray-500 hover:text-blue-600 p-3 transition">
                <span>Layanan</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 lg:ml-64 p-8">

        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="font-montserrat font-700 text-[32px] text-[#1F2937]">Halo, Profil Saya</h1>
                <p class="text-[#6B7280] text-sm mt-1">Pantau status cuci sepatu Anda di sini.</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-10 h-10 rounded-full bg-gray-200 border-2 border-white card-shadow"></div>
            </div>
        </header>

        <div class="grid grid-cols-12 gap-6">

            <div class="col-span-12 lg:col-span-8 bg-gradient-to-br from-[#3B82F6] to-[#06B6D4] rounded-[14px] p-8 relative overflow-hidden card-shadow">
                <div class="relative z-10">
                    <span class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Premium Status</span>
                    <h2 class="font-montserrat font-800 text-[24px] text-[#F4B400] mt-4 uppercase">Member Gold</h2>
                    <p class="text-white/90 text-sm mt-2 max-w-xs">Nikmati diskon 20% untuk setiap Deep Clean Treatment sepanjang tahun.</p>
                    <button class="mt-6 bg-white text-[#3B82F6] font-medium px-6 py-2 rounded-lg text-[14px] hover:bg-gray-100 transition">Lihat Benefit</button>
                </div>
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full"></div>
            </div>

            <div class="col-span-12 lg:col-span-4 bg-white rounded-[14px] p-6 card-shadow flex flex-col justify-center">
                <p class="font-montserrat font-600 text-[#6B7280] text-sm uppercase">Total Poin</p>
                <h3 class="font-montserrat font-700 text-[32px] text-[#1F2937] mt-1">2.450 <span class="text-sm font-normal text-gray-400">Pts</span></h3>
                <div class="mt-4 h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                    <div class="w-3/4 h-full bg-[#F4B400]"></div>
                </div>
                <p class="text-[12px] text-[#6B7280] mt-2 italic">550 poin lagi menuju Diamond</p>
            </div>

            <div class="col-span-12">
                <h2 class="font-montserrat font-600 text-[20px] mb-4">Aktivitas Terakhir</h2>
                <div class="bg-white rounded-[14px] card-shadow overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="p-4 font-montserrat font-600 text-sm text-[#6B7280]">Layanan</th>
                                <th class="p-4 font-montserrat font-600 text-sm text-[#6B7280]">Tanggal</th>
                                <th class="p-4 font-montserrat font-600 text-sm text-[#6B7280]">Status</th>
                                <th class="p-4 font-montserrat font-600 text-sm text-[#6B7280]">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-[14px] font-medium text-[#1F2937]">Deep Clean - Nike Air Jordan</td>
                                <td class="p-4 text-[13px] text-[#6B7280]">02 Mar 2026</td>
                                <td class="p-4">
                                    <span class="bg-blue-100 text-blue-600 text-[12px] px-3 py-1 rounded-full font-medium">Sedang Dicuci</span>
                                </td>
                                <td class="p-4 text-[14px] font-bold text-[#1F2937]">Rp 85.000</td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4 text-[14px] font-medium text-[#1F2937]">Unyellowing - Adidas Superstar</td>
                                <td class="p-4 text-[13px] text-[#6B7280]">28 Feb 2026</td>
                                <td class="p-4">
                                    <span class="bg-green-100 text-green-600 text-[12px] px-3 py-1 rounded-full font-medium">Selesai</span>
                                </td>
                                <td class="p-4 text-[14px] font-bold text-[#1F2937]">Rp 120.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
