<nav id="header" class="fixed w-full z-30 top-0 text-white">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
                <div class="pl-4 flex items-center">
                    <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl flex items-center" href="#">
                       <!--  <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512.005 512.005">
                            <rect fill="#2a2a31" x="16.539" y="425.626" width="479.767" height="50.502" transform="matrix(1,0,0,1,0,0)" />
                            <path class="plane-take-off" d=" M 510.7 189.151 C 505.271 168.95 484.565 156.956 464.365 162.385 L 330.156 198.367 L 155.924 35.878 L 107.19 49.008 L 211.729 230.183 L 86.232 263.767 L 36.614 224.754 L 0 234.603 L 45.957 314.27 L 65.274 347.727 L 105.802 336.869 L 240.011 300.886 L 349.726 271.469 L 483.935 235.486 C 504.134 230.057 516.129 209.352 510.7 189.151 Z " />
                        </svg> -->
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
                            <a class="nav-link inline-block py-2 px-4 text-black no-underline hover:scale-105 duration-300 ease-in-out" href="/#home">Home</a>
                        </li>
                        <li class="mr-3">
                            <a class="nav-link inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4 hover:scale-105 duration-300 ease-in-out" href="/#about">Tentang</a>
                        </li>
                        <li class="mr-3">
                            <a class="nav-link inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4 hover:scale-105 duration-300 ease-in-out" href="/#galery">Galeri</a>
                        </li>
                        <li class="mr-3">
                            <a class="nav-link inline-block text-black no-underline hover:text-gray-800 hover:text-underline py-2 px-4hover:scale-105 duration-300 ease-in-out" href="/#product">Produk</a>
                        </li>
                        
                    </ul>
                    <button id="navAction" class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 hover:scale-105 duration-300 ease-in-out"> 
                            {{-- KODE INI TAMPIL JIKA PENGGUNA SUDAH LOGIN --}}
                        <div class="mx-auto lg:mx-0">
                        @auth
                            {{-- Dropdown Menu Profil --}}
                            <details class="relative">
                                <summary class="list-none cursor-pointer inline-block hover:underline ">
                                    <div class="flex items-center">
                                        <span>{{ Auth::user()->name }}</span>
                                        <svg class="h-4 w-4 ml-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                    </div>
                                </summary>
                                <div class="absolute z-10 mt-10 w-48 rounded-md bg-white py-4 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none left-0 lg:left-auto lg:right-0 origin-top-left lg:origin-top-right">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Anda</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.preventDefault(); this.closest('form').submit();">Keluar</a>
                                    </form>
                                </div>
                            </details>
                        @else
                            {{-- Tombol Login --}}
                            <a href="{{ route('login') }}" class="inline-block hover:underline ">
                                Login
                            </a>
                        @endguest
                        </div>
                    </button>
                </div>
            </div>
            
</nav>