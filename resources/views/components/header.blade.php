<div class="flex flex-col ">
    <!-- Header -->
    <div id="mainHeader" class="h-16 flex items-center px-3 bg-gray-50">
        <div class="text-black flex items-center">
            <div class="p-3 rounded-full hover:bg-gray-100 cursor-pointer" id="sidebar-toggle">
                <x-radix-hamburger-menu class="w-8 h-8"/>
            </div>
            <img src="{{ asset('img/logo_paf.png') }}" alt="" class="h-8 lg:h-12">
        </div>

        <div class="flex-1"></div>

        <div>
            <div class="flex flex-row items-center gap-2">
                <div id="plusHeader" class="p-3 rounded-full hover:bg-gray-100">
                    <x-radix-plus class="w-6 h-6"/>
                </div>
                <div id="userImage" class="cursor-pointer text-white rounded-full h-10 w-10 bg-gray-600 flex justify-center items-center">
                    U
                </div>

                <div id="userInfo" class="absolute hidden">
                    <div class="fixed m-3 gap-3 right-0 top-16 p-4 w-full max-w-sm lg:max-w-lg bg-white shadow-sm rounded-xl">
                       <div class="relative flex font-semibold justify-center items-center">
                            <div class="text-center w-full">
                                email da conta
                            </div>
                            <div onclick="closeUserInfo()" 
                                class="absolute right-0 top-1/2 -translate-y-1/2 cursor-pointer">
                                <x-radix-cross-2 class="h-6 w-6" />
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <div class="text-white text-xl rounded-full h-20 w-20 my-2 bg-gray-600 flex justify-center items-center">
                                U
                            </div>
                        </div>
                        <div class="text-lg text-center">
                            Olá, $nomedoutilizador
                        </div>
                        <div class="mt-3 rounded-xl bg-gray-200 text-center py-2 cursor-pointer hover:bg-gray-300 transition-all duration-300">
                            Sair da conta
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal/>

<script>
    const buttonPlusHeader = document.getElementById('plusHeader');
    const userInfo = document.getElementById('userInfo');
    const userImage = document.getElementById('userImage');

    userImage.addEventListener('click', openUserInfo);
    buttonPlusHeader.addEventListener('click', openModalAssociateFeeder);

    function openUserInfo() {
        // Mostra o menu se estiver escondido
        userInfo.classList.toggle('hidden');
    }

    function closeUserInfo() {
        // Esconde o menu
        userInfo.classList.add('hidden');
    }
</script>
