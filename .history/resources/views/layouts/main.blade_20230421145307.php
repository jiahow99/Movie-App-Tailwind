<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie App</title>
    @vite('resources/css/app.css')

    <!-- FontAwesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles

    <!-- Alpine Js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    {{-- <!-- AOS Css -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- AOS script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> --}}
    
    @yield('style')
</head>

<body class="relative font-sans bg-gray-900 text-white">
    <!-- Start Preloader -->
    <div id="loader" class="fixed w-screen h-screen top-0 left-0 z-50">
        <div class="demo">
            <div class="rings">
                <div class="rings">
                    <div class="logo">  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->


    <!-- Start Navbar -->
    <nav id="navbar" class="border-b border-gray-800 z-50">
        <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col lg:flex-row items-center">
                <li>
                    <a href="{{ route('movies.index') }}" class="flex items-center">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKUlEQVR4nO2WTU4CMRSAuzLsvICs2bPQRIY9E+K5HJceA0LCHfhdcwXHYYVGWRrNZxob8lLKoO0UiOFLumhf06/z+qapUqcCUAcGwNq0IdA4hPSFbV51LKZ4wG76Yt4F8AAsgQLI9FiIeC1Et0Ai+u9inhbZZFWJE6At+m9iXuHYXBEiHpakuucQy80FiRumkGxWwNWeVN97i0Vl9/WZmtaTUlFcmfny8OI6CkAXeMafHEh9xDnhPO1Yuw0sgLErWAnWmpfAI/DlikcRA3c6A2UbiyUujW84i33Zl0Fl4206i4/9O/3lAskjXpmJuTJHrmAaKNdp7ahQgNkvZNNgkQ1wA3yadi3Gm8CHObeWqhp+zsT5ehRPn0UM8dSku+aI1YA5MKlcrP4r3zUAtm9D5+gNAAAAAElFTkSuQmCC" alt="movie_app_logo">
                        <span class="no-underline font-bold ml-2">Movie App</span>
                    </a> 
                </li>
                <li class="lg:ml-16 mt-3 lg:mt-0">
                    <a href="{{ route('movies.index') }}" class="hover:text-gray-300">Movies</a>
                </li>
                <li class="lg:ml-6 mt-3 lg:mt-0">
                    <a href="#" class="hover:text-gray-300">TV Shows</a>
                </li>
                <li class="lg:ml-6 mt-3 lg:mt-0">
                    <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
                </li>
            </ul>
            <div class="flex flex-col lg:flex-row items-center mt-3 lg:mt-0">
                <livewire:search-dropdown />
                <div class="ml-4 mt-3 lg:mt-0">
                    <a href="#" class="">
                        <i class="fa-solid fa-user rounded-full border-white border-2 p-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

     

    @yield('content')

    @yield('scripts')
    
    @livewireScripts
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
        
        window.addEventListener("load", () => {
            // Wait for a minimum amount of time before hiding the loader
            setTimeout(() => {  
                var loader = document.querySelector('#loader');
                loader.classList.add("hide");
            }, 200);

            loader.addEventListener("transitionend", () => {
                loader.style.zIndex  = "0";
                loader.style.display = "none";
            }, { once: true });
        });
    </script>


</body>
</html>