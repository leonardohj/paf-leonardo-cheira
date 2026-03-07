<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @yield('scripts')
    <title>paf</title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body class="min-h-screen flex flex-col">

<div class="flex flex-col" x-data="{ showUserInfo: false }">
    <!-- Header -->
    <div id="mainHeader" class="h-16 flex items-center px-3 bg-gray-50">
        <div class="text-black flex items-center">
            <!-- Sidebar toggle -->
            <div
                class="p-3 rounded-full hover:bg-gray-100 cursor-pointer"
                 @click="sidebarOpen = !sidebarOpen"
            >
                <x-radix-hamburger-menu class="w-8 h-8"/>
            </div>
            <img src="{{ asset('img/logo_paf.png') }}" alt="" class="h-8 lg:h-12">
        </div>

        <div class="flex-1"></div>

        <div>
            <div class="flex flex-row items-center gap-2">
                <!-- Plus button -->
<div
    id="plusHeader"
    class="p-3 rounded-full hover:bg-gray-100"
    @click="$dispatch('open-modal-associate-feeder')"
>
    <x-radix-plus class="w-6 h-6"/>
</div>

                <!-- User avatar -->
                <div
                    id="userImage"
                    class="cursor-pointer text-white rounded-full h-10 w-10 bg-gray-600 flex justify-center items-center select-none"
                    @click="showUserInfo = !showUserInfo"
                >
                    {{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}
                </div>

                <!-- User info popup -->
                <div
                    id="userInfo"
                    class="absolute z-100"
                    x-show="showUserInfo"
                    x-transition
                    @click.away="showUserInfo = false"
                >
                    <div class="fixed m-3 gap-3 right-0 top-16 p-4 w-full max-w-sm lg:max-w-lg bg-white shadow-sm rounded-xl">
                        <div class="relative flex font-semibold justify-center items-center">
                            <div class="text-center w-full">
                                {{ Auth::user()->email }}
                            </div>
                            <div
                                @click="showUserInfo = false"
                                class="absolute right-0 top-1/2 -translate-y-1/2 cursor-pointer"
                            >
                                <x-radix-cross-2 class="h-6 w-6" />
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div class="text-white text-xl rounded-full h-20 w-20 my-2 bg-gray-600 flex justify-center items-center select-none">
                                {{ Str::upper(Str::substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="text-lg text-center">
                            Olá, {{ Auth::user()->name }}
                        </div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="mt-3 w-full rounded-xl bg-gray-200 text-center py-2 cursor-pointer hover:bg-gray-300 transition-all duration-300"
                            >
                                Sair da conta
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<x-modal/>

<div class="min-h-0 flex-1 flex">

    <!-- SIDEBAR -->
    <div
        id="sidebar"
        :class="{ 'hover': sidebarOpen }"
        class="hidden md:flex flex-col justify-start items-center pt-3 pb-2 bg-gray-50 px-4 gap-y-6 w-16 hover:w-56 transition-all not-hover:duration-1000 duration-600 not-hover:w-16 ease-in-out group"
    >


        <a href="{{ url('/') }}"
           class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer
           {{ Request::is('/') ? 'bg-gray-300' : '' }}">
            <x-mdi-home-outline class="h-8 w-8 flex-shrink-0"/>
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                Homepage
            </span>
        </a>

        <a href="{{ url('/schedule') }}"
           class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer
           {{ Request::is('schedule') ? 'bg-gray-300' : '' }}">
            <x-mdi-calendar-clock-outline class="h-8 w-8 flex-shrink-0"/>
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                Horários
            </span>
        </a>

        <a href="{{ url('/feeder') }}"
           class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer
           {{ Request::is('feeder') ? 'bg-gray-300' : '' }}">
            <x-mdi-paw-outline class="h-8 w-8 flex-shrink-0"/>
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                Alimentadores
            </span>
        </a>

        <div class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer">
            <x-mdi-cog class="h-8 w-8 flex-shrink-0"/>
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                Configurações
            </span>
        </div>

    </div>

    <!-- CONTENT -->
    <div class="flex flex-col flex-1 h-full">
        <div class="hidden md:block bg-gray-50 w-full">
            <div class="bg-white h-5 rounded-tl-full"></div>
        </div>
        <div class="md:mb-0 mb-5"></div>
        <div class="flex-1 overflow-auto">
            @yield('body')
        </div>
    </div>

</div>

<style>
/* Force hover state for manual toggle */
#sidebar.hover {
    width: 14rem; /* same as w-56 */
    transition: width 0.3s ease-in-out;
}

/* Show labels when sidebar is forced open */
#sidebar.hover .sidebar-item {
    width: 100%;
}
#sidebar.hover .sidebar-item span {
    opacity: 1;
}
</style>

</body>
</html>