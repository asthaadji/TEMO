<nav id="header" class="fixed w-full z-30 top-0 text-white ">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
                <div class="pl-4 flex items-center ">
                    <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl flex items-center " href="#">
                        <img class="fill-current h-8 w-9 " src="{{ asset('images/logo.png') }}" />
                        TEMO
                    </a>
                </div>
                <div class="block lg:hidden pr-4">
                    <button id="nav-toggle" class="flex items-center p-1 text-pink-800 hover:text-gray-900">
                        <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
                    </button>
                </div>
                <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
                    <ul class="list-reset lg:flex justify-end flex-1 items-center">
                        
                        <li class="mr-3">
                            <a class="nav-link inline-block py-2 px-4 text-black no-underline hover:scale-105 duration-300 ease-in-out" href="/">Home</a>
                        </li>
                        <li class="mr-3">
                            <a class="nav-link inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4 hover:scale-105 duration-300 ease-in-out" href="/tentang">Tentang</a>
                        </li>
                        <li class="mr-3">
                            <a class="nav-link inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4 hover:scale-105 duration-300 ease-in-out" href="/galeri">Galeri</a>
                        </li>
                        <li class="mr-3">
                            <a class="nav-link inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4 hover:scale-105 duration-300 ease-in-out" href="/produk">Produk</a>
                        </li>
                        
                    </ul>
                    <button id="navAction" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 hover:scale-105 duration-300 ease-in-out">
                        <div class="user-menu-container">
                            @guest
                                {{-- TAMPILAN UNTUK PENGUNJUNG (BELUM LOGIN) --}}
                                <a href="{{ route('login') }}" class="inline-block">
                                    Login
                                </a>
                            @endguest

                            @auth
                                {{-- TAMPILAN UNTUK PENGGUNA (SUDAH LOGIN) --}}
                                <div class="relative">
                                    {{-- Tombol ini akan menjadi pemicu dropdown --}}
                                    <details class="group">
                                        <summary class="flex items-center list-none cursor-pointer ">
                                            <span>{{ Auth::user()->name }}</span>
                                            <svg class="w-5 h-5 ml-2 text-gray-500 group-open:rotate-180 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                            </svg>
                                        </summary>

                                        {{-- Konten Dropdown --}}
                                        <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <a href="{{ auth()->user()->is_admin ? route('filament.admin.pages.dashboard') : route('filament.user.pages.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Dashboard
                                            </a>
                                            
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Keluar
                                                </a>
                                            </form>
                                        </div>
                                    </details>
                                </div>
                            @endauth
                        </div>
                    </button>
                    
                </div>
            </div>
            
</nav>