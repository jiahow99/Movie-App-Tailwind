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
    
    @yield('style')
</head>

<body class="relative font-sans bg-gray-900 text-white">
    @if (session('loader'))
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
    @endisset


    


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
            <div class="flex flex-col lg:flex-row items-center mt-3 lg:mt-0 gap-4">
                <!-- Search -->
                <livewire:search-dropdown />
                <!-- Login -->
                <div class="login-btn px-7 py-1 bg-gray-700 text-gray-300">
                    Login
                </div>
                <!-- Account -->
                <div class="xl:ml-4 mt-3 lg:mt-0">
                    <a href="#" class="">
                        <i class="fa-solid fa-user rounded-full border-white border-2 p-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Start Login Modal -->
    <div class="fixed inset-0 bg-gray-800 opacity-90 z-50 flex justify-center align-middle">
        <div class="relative w-7/12 max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                                </div>
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Login Modal -->
     

    @yield('content')

    @yield('scripts')
    
    @livewireScripts

    @if (session('loader'))
        <script>
            window.addEventListener("load", () => {
                // Wait for a minimum amount of time before hiding the loader
                setTimeout(() => {  
                    var loader = document.querySelector('#loader');
                    loader.classList.add("hide");
                }, 500);
                
                loader.addEventListener("transitionend", () => {
                    loader.style.zIndex  = "0";
                    loader.style.display = "none";
                }, { once: true });
            });
        </script>
    @endif


</body>
</html>