<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CineMagic</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts AND CSS Fields -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-cover bg-center bg-gray-200">

        <!-- Navigation Menu -->
        <nav class="bg-white border-b border-coral-100 ">
            <!-- Navigation Menu Full Container -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Logo + Menu Items + Hamburger -->
                <div class="flex flex-col sm:flex-row justify-between items-center px-6 sm:px-0">
                    <!-- Logo -->
                    <div class="shrink-0 -ms-4">
                        <a href="{{ route('home') }}">
                            <div
                                class="h-20 w-40 bg-cover bg-[url('../img/logotipo.png')] ">
                            </div>
                        </a>
                    </div>

                    <!-- Menu Items -->
                    <div id="menu-container" class="flex flex-col sm:flex-row items-center space-x-4">
                        <!-- Menu Item: movies -->
                        <x-menus.menu-item content="Movies" href="{{ route('movies.index') }}"
                            selected="{{ Route::currentRouteName() == 'movies.index' }}" />

                        <!-- Menu Item: Screenings -->
                        <x-menus.menu-item content="Screenings" href="{{ route('screenings.index') }}"
                            selected="{{ Route::currentRouteName() == 'screenings.index' }}" />


                        <!-- Menu Item: Theaters -->
                        <x-menus.menu-item content="Theaters" href="{{ route('theaters.index') }}"
                        selected="{{ Route::currentRouteName() == 'theaters.index' }}" />

                        @auth
                            @if (Auth::user()->type == 'A')

                                 <!-- Menu Item: Genre -->

                                 <x-menus.menu-item content="Genres" href="{{ route('genres.index') }}"
                                 selected="{{ Route::currentRouteName() == 'genres.index' }}" />

                                <!-- Menu Item: Others -->

                                <x-menus.submenu selectable="0" uniqueName="submenu_others" content="More"
                                    class="relative submenu">

                                    <!-- Menu Item: Statistics -->
                                    <x-menus.submenu-item content="Statistics" href="{{ route('reports.index') }}" selectable="0" />

                                    <!-- Menu Item: Purchases -->
                                    <x-menus.submenu-item content="Purchases" href="{{ route('purchases.index') }}" selectable="0" />

                                    <!-- Menu Item: Users -->
                                    <x-menus.submenu-item content="Customers" selectable="0"
                                        href="{{ route('users.list') }}" />
                                    <!-- Menu Item: Users -->
                                    <x-menus.submenu-item content="Employees and Admins"
                                        href="{{ route('users.index') }}" />

                                    <hr>

                                </x-menus.submenu>
                            @endif
                        @endauth


                        <div class="flex-grow"></div>

                        <!-- Menu Item: Cart -->
                        @if (session('cart'))
                            <x-menus.cart :href="route('cart.show')" selectable="1"
                                selected="{{ Route::currentRouteName() == 'cart.show' }}" :total="count(session('cart'))" />
                        @endif


                        @auth
                            <x-menus.submenu selectable="0" uniqueName="submenu_user" class="relative submenu">
                                <x-slot:content>
                                    <div class="pe-1">
                                        @if (Auth::user()->photoFullUrl)
                                            <img src="{{ Auth::user()->photoFullUrl }}"
                                                class="w-11 h-11 min-w-11 min-h-11 rounded-full">
                                        @else
                                            <span
                                                class="w-11 h-11 min-w-11 min-h-11 flex items-center justify-center bg-gray-200 rounded-full">
                                                {{ substr(Auth::user()->name, 0, 1) }}
                                            </span>
                                        @endif
                                    </div>
                                    {{-- ATENÇÃO - ALTERAR FORMULA DE CALCULO DAS LARGURAS MÁXIMAS QUANDO O MENU FOR ALTERADO --}}
                                    <div
                                        class="ps-1 sm:max-w-[calc(100vw-39rem)] md:max-w-[calc(100vw-41rem)] lg:max-w-[calc(100vw-46rem)] xl:max-w-[34rem] truncate">
                                        {{ Auth::user()->name }}
                                    </div>
                                </x-slot>

                                <x-menus.submenu-item content="My Purchases" selectable="0" href="{{ route('purchases.myPurchases') }}" />
                                <hr>

                                <x-menus.submenu-item content="Profile" selectable="0"
                                    href="{{ route('profile.edit') }}" />

                                <hr>



                                <hr>
                                <form id="form_to_logout_from_menu" method="POST" action="{{ route('logout') }}"
                                    class="hidden">
                                    @csrf
                                </form>
                                <a class="px-3 py-4 border-b-2 border-transparent
                                        text-sm font-medium leading-5 inline-flex h-auto
                                        text-gray-500
                                        hover:text-gray-700
                                        hover:bg-gray-100
                                        focus:outline-none
                                        focus:text-gray-700
                                        focus:bg-gray-100 "
                                    href="#"
                                    onclick="event.preventDefault();
                                    document.getElementById('form_to_logout_from_menu').submit();">
                                    Log Out
                                </a>
                            </x-menus.submenu>
                        @else
                            <!-- Menu Item: Login -->
                            <x-menus.menu-item content="Login" selectable="1" href="{{ route('login') }}"
                                selected="{{ Route::currentRouteName() == 'login' }}" />
                            <x-menus.menu-item content="Register" selectable="1" href="{{ route('register') }}"
                                selected="{{ Route::currentRouteName() == 'register' }}" />

                        @endauth
                    </div>
                    <!-- Hamburger -->
                    <div class="absolute right-0 top-0 flex sm:hidden pt-3 pe-3 text-black ">
                        <button id="hamburger_btn">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path id="hamburger_btn_open" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path class="invisible" id="hamburger_btn_close" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>



        <main>
            @if (session('alert-msg'))
                <x-alert type="{{ session('alert-type') ?? 'info' }}">
                    {!! session('alert-msg') !!}
                </x-alert>
            @endif
            @if (!$errors->isEmpty())
                <x-alert type="warning" message="Operation failed because there are validation errors!" />
            @endif

            @yield('main')
        </main>
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-black">Copyright &copy; CineMagic 2024</p>
            </div>
        </footer>
    </div>
</body>

</html>
