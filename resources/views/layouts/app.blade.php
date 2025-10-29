<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @yield('scripts')
    <title>paf</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    <x-header />

    <!-- Main Layout -->
    <div class="min-h-0 flex-1 flex ">
        
        <!-- Sidebar -->
        <div id="sidebar" class="hidden md:flex flex-col justify-start items-center pt-3 pb-2 bg-gray-50 px-4 gap-y-6 w-16 hover:w-56 transition-all not-hover:duration-1000 duration-600 not-hover:w-16 ease-in-out group">
        <div class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer">
            <x-mdi-home-outline class="h-8 w-8 flex-shrink-0" />
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                Homepage
            </span>
        </div>
        <div class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer">
            <x-mdi-calendar-clock-outline class="h-8 w-8 flex-shrink-0" />
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                    Horários
                </span>
            </div>
        <div class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer">
            <x-mdi-paw-outline class="h-8 w-8 flex-shrink-0" />
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                    Alimentadores
                </span>
            </div>
        <div class="sidebar-item not-hover:duration-1000 flex items-center w-12 hover:bg-gray-200 rounded-full px-2 py-2 transition-all duration-300 ease-in-out group-hover:w-full overflow-hidden cursor-pointer">
            <x-mdi-cog class="h-8 w-8 flex-shrink-0" />
            <span class="text-gray-700 font-medium opacity-0 transform translate-x-[1rem] group-hover:opacity-100 transition-all duration-300 whitespace-nowrap">
                Configurações
            </span>
        </div>

        </div>

        <!-- Main Content -->
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

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</body>
</html>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    let forced = false;

    toggleBtn.addEventListener('click', () => {
        forced = !forced;

        if (forced) {
            sidebar.classList.add('hover'); // expand sidebar
        } else {
            sidebar.classList.remove('hover'); // collapse sidebar
        }
    });
});

</script>