<x-guest-layout class="card-register">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="logo-area text-center mb-6">
            {{-- Logo --}}
        </div>

        <h2 class="text-left text-xl font-bold text-gray-800 mb-6">Register</h2>

        <div>
            <x-text-input id="username" class="block mt-1 w-full" type="username" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="USERNAME" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="EMAIL" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="PASSWORD" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

         <div class="mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="current-password" placeholder="KONFIRMASI PASSWORD" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        
        <div class="flex flex-col items-center mt-8 space-y-4">

            <x-login-button class="w-full justify-center btn-daftar py-3">
                {{ __('DAFTAR') }}
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

{{-- <body>

  <div class="card">
    <!-- Logo -->
    <div class="logo-area">
      <svg viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17 1L3 7.5v9.5C3 25.5 9.2 31.5 17 34 24.8 31.5 31 25.5 31 17V7.5L17 1z" fill="#2a5cb8"/>
        <path d="M11.5 17l4 4L22.5 13" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <div class="brand-text">
        <span class="brand-name">KickCare</span>
        <span class="brand-sub">Premium Shoe &amp; Repair Service</span>
      </div>
    </div>

    <!-- Judul -->
    <h2>Daftar Akun</h2>

    <!-- Form Grid -->
    <div class="form-grid">
      <!-- Nama Lengkap -->
      <div class="form-group">
        <label>Nama lengkap</label>
        <div class="input-wrap">
          <input type="text" placeholder="NAMA" />
        </div>
      </div>

      <!-- Kata Sandi -->
      <div class="form-group">
        <label>Kata sandi</label>
        <div class="input-wrap">
          <input type="password" placeholder="PASSWORD" id="pass1"/>
          <span class="eye-icon" onclick="togglePass('pass1')">&#128065;</span>
        </div>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label>Email</label>
        <div class="input-wrap">
          <input type="email" placeholder="CONTOH = mantap@gmail.com" />
        </div>
      </div>

      <!-- Konfirmasi Kata Sandi -->
      <div class="form-group">
        <label>Konfirmasi kata sandi</label>
        <div class="input-wrap">
          <input type="password" placeholder="PASSWORD" id="pass2"/>
        </div>
      </div>
    </div>

    <!-- Tombol Daftar -->
    <div class="btn-area">
      <button class="btn-daftar">DAFTAR</button>
    </div>

    <!-- Footer -->
    <p class="footer-text">
      Sudah punya akun? <a href="#">Masuk sekarang</a>
    </p>
  </div>

  <script>
    function togglePass(id) {
      const input = document.getElementById(id);
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  </script>

</body> --}}
