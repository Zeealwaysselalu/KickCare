<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KickCare') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#F5F7FA] text-gray-900">

    <div class="min-h-screen flex">

        @include('layouts.navigation')

        <div class="flex-1 flex flex-col lg:ml-64 w-full">

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 w-full">
                {{ $slot }}
            </main>

        </div>

    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '<span class="font-montserrat uppercase italic tracking-tight">Berhasil!</span>',
                html: '<p class="text-sm font-roboto text-gray-500">{{ session('success') }}</p>',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#ffffff',
                iconColor: '#2563eb', // Biru KickCare
                customClass: {
                    popup: 'rounded-[24px]',
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '<span class="font-montserrat uppercase italic tracking-tight text-red-600">Gagal!</span>',
                text: '{{ session('error') }}',
                confirmButtonText: 'Coba Lagi',
                confirmButtonColor: '#2563eb',
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-[24px]',
                    confirmButton: 'rounded-xl font-montserrat font-bold uppercase tracking-widest text-[10px] py-3 px-6'
                }
            });
        </script>
    @endif
</body>

</html>
