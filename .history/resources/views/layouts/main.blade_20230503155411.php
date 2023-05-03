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

<body class="relative font-sans bg-gray-900 text-white" 
    x-data="{ 
        loginModal: false,
        resetInput: function(){
            loginField.value = '' ;
        },
     }">

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
                <div class="login-btn px-7 py-1 bg-gray-700 text-gray-300" x-on:click="loginModal = true">
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


    <!-- Background overlay -->
    <div class="fixed inset-0 z-40" x-show="loginModal" style="display: none">
        <div class="absolute inset-0 bg-gray-800 opacity-80 blur"></div>
    </div>

    
    <!-- login modal -->
    <div class="login-modal fixed z-50 inset-0 flex items-center justify-center" x-show="loginModal" style="display: none" >
        <div class="login-box" x-on:click.outside="loginModal = false; resetInput();">
            <!-- Close -->
            <span class=" close fixed top-5 right-5 text-gray-300 cursor-pointer hover:rotate-90 hover:scale-150 transition duration-200" x-on:click="loginModal = false; resetInput();">
                <i class="fa-solid fa-xmark fa-2xl"></i>
            </span>
            <h1 class="text-center text-2xl pb-10 tracking-widest font-bold mt-7">Login</h1>
            <form>
                <!-- Username -->
                <div class="user-box mb-5">
                    <input type="text" name="username" required x-model="loginField">
                <label>Username</label>
                </div>
                <!-- Password -->
                <div class="user-box mb-3">
                    <input type="password" name="password" required x-model="loginField">
                    <label>Password</label>
                </div>
                <!-- Remember me -->
                <div class="flex items-center justify-between mt-4 mb-5">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500" required="">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="remember" class="text-white hover:cursor-pointer select-none text-center text-sm font-semibold">Remember me</label>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                </div>  
                <!-- Login -->
                <div class="text-center mt-10">
                    <div class="w-full py-1 px-10 mx-auto login-btn-2 rounded-md">
                        Login
                    </div>
                </div>
                <!-- Sign up -->
                <div class="text-gray-400/80 text-sm mt-5 font-semibold text-center">
                    <span>Don't have an account ? Sign up</span>
                </div>
                <div class="inline-flex items-center justify-center w-full">
                    <hr class="w-full h-px bg-gray-600 border-0 dark:bg-gray-700">
                    <span class="absolute px-3 font-medium text-gray-600 -translate-x-1/2 bg-[#252222f2] left-1/2 ">or</span>
                </div>
                <!-- Social media login -->
                <a href="#">
                    <div class="facebook w-full py-1 bg-blue-600 text-center rounded-md mt-3">
                        <i class="fa-brands fa-facebook-f text-white mx-1"></i>
                        <span class="text-sm">Log in with Facebook</span>
                    </div>
                </a>
                <a href="#">
                    <div class="google w-full flex justify-center align-middle py-1 bg-white text-center rounded-md mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 48 48" width="22px"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
                        <span class="text-sm text-black">Log in with Google</span>
                    </div>
                </a>
            </form>
        </div>
    </div>
     

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