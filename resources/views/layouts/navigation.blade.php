<aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col py-6 fixed h-full z-20">

    <div class="mb-6 px-6">
        <a href="{{ route('dashboard') }}">
            <h2 class="font-montserrat font-800 text-2xl text-blue-600 italic">KICKCARE.</h2>
        </a>
    </div>

    <nav class="flex-1 px-4 flex flex-col justify-start gap-2">

        <a href="{{ route('dashboard') }}"
           class="flex items-center w-full px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'text-blue-600 font-medium bg-blue-50' : 'text-gray-500 hover:text-blue-600 hover:bg-gray-50' }}">
            <span>Dashboard</span>
        </a>

        <a href="{{ route('pesanan') }}"
           class="flex items-center w-full px-4 py-3 rounded-xl transition-all {{ request()->routeIs('pesanan') ? 'text-blue-600 font-medium bg-blue-50' : 'text-gray-500 hover:text-blue-600 hover:bg-gray-50' }}">
            <span>Pesanan Saya</span>
        </a>

        <a href="{{ route('service')}}"
           class="flex items-center w-full px-4 py-3 rounded-xl transition-all {{ request()->routeIs('service*') ? 'text-blue-600 font-medium bg-blue-50' : 'text-gray-500 hover:text-blue-600 hover:bg-gray-50' }}">
            <span>Customer Service</span>
        </a>

        <a href="{{ route('about') }}"
           class="flex items-center w-full px-4 py-3 rounded-xl transition-all {{ request()->routeIs('about') ? 'text-blue-600 font-medium bg-blue-50' : 'text-gray-500 hover:text-blue-600 hover:bg-gray-50' }}">
            <span>About KickCare</span>
        </a>

    </nav>

    <div class="border-t border-gray-100 pt-4 mt-auto px-6">
        <div class="flex items-center gap-3 px-2 mb-4">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff"
                     alt="Avatar"
                     class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name ?: 'User' }}</p>
                <p class="text-[11px] text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="block py-2 text-sm text-gray-600 hover:text-blue-600 transition">
            Profil Saya
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="block py-2 mt-1 text-sm text-red-600 hover:text-red-700 transition cursor-pointer">
                Log Out
            </a>
        </form>
    </div>

</aside>
