<x-guest-layout class="card-register">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="logo-area text-center -mt-20">
            <a href="/">
                <img src="https://iili.io/Bb0dKMu.png" alt="KickCare Logo" border="0"
                    class="mx-auto w-36 h-auto object-contain">
            </a>
        </div>

        <h2 class="text-left text-xl font-bold text-gray-800 mb-6 -mt-8 uppercase tracking-tight">Register</h2>

        <div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" placeholder="NAMA LENGKAP" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="email" placeholder="EMAIL" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" placeholder="PASSWORD" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="KONFIRMASI PASSWORD" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center mt-8 space-y-4">
            <x-primary-button
                class="w-full justify-center btn-daftar py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-all">
                {{ __('DAFTAR') }}
            </x-primary-button>

            <p class="footer-text text-sm text-gray-600">
                Sudah punya akun? <a href="{{ route('login') }}"
                    class="text-[#1A8FE3] font-semibold hover:underline">Login Sekarang</a>
            </p>

            @if (Route::has('password.request'))
                <a class="lupa-password text-sm text-gray-500 hover:text-gray-900 underline"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
