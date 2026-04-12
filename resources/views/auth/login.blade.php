<x-guest-layout class="card-login">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="logo-area text-center mb-6">
            {{-- Logo --}}
        </div>

        <h2 class="text-left text-xl font-bold text-gray-800 mb-6">Login</h2>

        <div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="EMAIL" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="PASSWORD" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center mt-8 space-y-4">

            <x-login-button class="w-full justify-center btn-masuk py-3">
                {{ __('MASUK') }}
            </x-login-button>

            <p class="footer-text text-sm text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-[#1A8FE3] font-semibold hover:underline">Daftar Sekarang</a>
            </p>

            @if (Route::has('password.request'))
                <a class="lupa-password text-sm text-gray-500 hover:text-gray-900 underline" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            @endif

        </div>
    </form>
</x-guest-layout>
