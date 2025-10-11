<div id="container-header" class="flex flex-row bg-gray-200 px-2 py-4 justify-between items-center rounded-2xl rounded-t-none z-50">
        
    <div id="" class="flex justify-center items-center gap-3">  
        <div id="header-mobile" class="hidden flex justify-center items-center gap-3">
            <div class="" id="hamburguer" style="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-13">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
            <div id="close" class="">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-13">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <div id="logo" class="text-xl flex gap-2">
            <img height="60px" width="300px" src="{{asset('img/logo_paf.png')}}" alt="logo">
        </div>
    </div>

    <div id="options" class="flex gap-4">
        <div>
            <a href="">Dashboard</a>
        </div>
        <div>
            <a href="">placeholder</a>
        </div>
    </div>

    <div id="header-extension" class="flex grow justify-center items-center bg-gray-200 py-[10px] z-10">
        <div class="w-screen py-2 flex items-center justify-center hover:bg-black hover:text-white duration-300 ease-in-out">
            <a href="">Dashboard</a>
        </div>
    </div>
</div>
<div id="append">

</div>
<style>
    #gray-on-screen
    {
        display: none;
    }
    #header-extension
    {
        display: none;
    }

    @media(max-width: 800px)
    {
        #gray-on-screen
        {
            display: block;
            z-index: 50;
        }
        #hamburguer
        {
            display: block;
        }
        #options
        {
            display: none;
        }
        #container-header
        {
            justify-content: center;
            flex-direction: column;
        }
    }
</style>

<script>
    let hamb = document.getElementById('hamburguer');
    let close = document.getElementById('close');
    let header_ext = document.getElementById('header-extension');
    let logo = document.getElementById('logo');
    let body = document.getElementsByTagName('body');
    let grayOnScreen = document.createElement("div");
    let optionsHeader = document.getElementById('options');
    let headerMobile = document.getElementById('header-mobile');
    let containerHeader = document.getElementById('container-header');
    let append = document.getElementById('append');

    window.onresize = function () 
    { 
    if(window.innerWidth > 800) {
            optionsHeader.style.display = "none";
            headerMobile.style.display = "none";
            optionsHeader.style.display = "flex";
            containerHeader.style.justifyContent = "space-between";
            close.click();
        }
        else
        {
            optionsHeader.style.display = "block";
            headerMobile.style.display = "block";
            optionsHeader.style.display = "none";
            hamb.style.display = "block";
            close.style.display = "none";
            containerHeader.style.justifyContent = "center";
        }
    }
    window.onload = function () 
    { 
        if(window.innerWidth > 800) {
            optionsHeader.style.display = "none";
            headerMobile.style.display = "none";
            optionsHeader.style.display = "flex";
        }
        else
        {
            optionsHeader.style.display = "block";
            headerMobile.style.display = "block";
            optionsHeader.style.display = "none";
            hamb.style.display = "block";
            close.style.display = "none";
            containerHeader.style.justifyContent = "center";
        }
    }

    hamb.addEventListener('click', function () {
        hamb.style.display = "none";
        close.style.display = "block"; 
        header_ext.style.display = "block";
        grayOnScreen.display = "block";
        logo.display = "block";
        grayOnScreen.setAttribute('class', 'bg-[rgba(0,0,0,0.6)] w-full h-full absolute z-1');
        append.setAttribute('class', 'bg-[rgba(0,0,0,0.6)]');
        append.append(grayOnScreen);
    });

    close.addEventListener('click', function () {
        close.style.display = "none";
        hamb.style.display = "block"; 
        header_ext.style.display = "none";
        grayOnScreen.display = "none";
        append.setAttribute('class', '');
        grayOnScreen.remove();
    });

    grayOnScreen.addEventListener('click', function () {
        close.click();
    });


</script>