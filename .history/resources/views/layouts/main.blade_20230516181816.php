<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
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
            $refs.email.value = '' ;
            $refs.password.value = '' ;
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
    <nav id="navbar" class="relative border-b border-gray-800 z-50" x-data="{ account_dropdown: false }">
        <!-- Hamburger Menu -->
        <div class="flex lg:hidden justify-between align-middle px-4 py-2">
            <div></div>
            <div class="my-auto">
                <a href="{{ route('movies.index') }}" class="flex items-center">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKUlEQVR4nO2WTU4CMRSAuzLsvICs2bPQRIY9E+K5HJceA0LCHfhdcwXHYYVGWRrNZxob8lLKoO0UiOFLumhf06/z+qapUqcCUAcGwNq0IdA4hPSFbV51LKZ4wG76Yt4F8AAsgQLI9FiIeC1Et0Ai+u9inhbZZFWJE6At+m9iXuHYXBEiHpakuucQy80FiRumkGxWwNWeVN97i0Vl9/WZmtaTUlFcmfny8OI6CkAXeMafHEh9xDnhPO1Yuw0sgLErWAnWmpfAI/DlikcRA3c6A2UbiyUujW84i33Zl0Fl4206i4/9O/3lAskjXpmJuTJHrmAaKNdp7ahQgNkvZNNgkQ1wA3yadi3Gm8CHObeWqhp+zsT5ehRPn0UM8dSku+aI1YA5MKlcrP4r3zUAtm9D5+gNAAAAAElFTkSuQmCC" alt="movie_app_logo">
                    <span class="no-underline font-bold ml-2 text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-red-600">
                        {{ config('app.name') }}
                    </span>
                </a> 
            </div>
            <div id="hamburger-toggler">
                <input type="checkbox" id="checkbox" onclick="toggleMenu()">
                <label for="checkbox" class="toggle">
                    <div class="bars" id="bar1"></div>
                    <div class="bars" id="bar2"></div>
                    <div class="bars" id="bar3"></div>
                </label>
            </div>
        </div>
        <div id="hamburger-menu" class="hidden">
            <div class="text-center">
                <a href="{{ route('movies.index') }}" class="hover:text-gray-300">Movies</a>
            </div>
            <div class="text-center mt-2">
                <a href="#" class="hover:text-gray-300">TV Shows</a>
            </div>
            <div class="text-center mt-2">
                <a href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
            </div>
            <div class="text-center mt-2">
                <livewire:search-dropdown />
            </div>
            @if (!Auth::check())
                <!-- Login -->
                <div class="login-btn px-7 py-1 bg-gray-700 text-gray-300 w-fit mx-auto my-3" x-on:click="loginModal = true">
                    Login
                </div>
            @endif
        </div>

        <!-- Deskop Menu -->
        <div class="container mx-auto hidden lg:flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <ul class="flex flex-col lg:flex-row items-center">
                <li>
                    <a href="{{ route('movies.index') }}" class="flex items-center">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKUlEQVR4nO2WTU4CMRSAuzLsvICs2bPQRIY9E+K5HJceA0LCHfhdcwXHYYVGWRrNZxob8lLKoO0UiOFLumhf06/z+qapUqcCUAcGwNq0IdA4hPSFbV51LKZ4wG76Yt4F8AAsgQLI9FiIeC1Et0Ai+u9inhbZZFWJE6At+m9iXuHYXBEiHpakuucQy80FiRumkGxWwNWeVN97i0Vl9/WZmtaTUlFcmfny8OI6CkAXeMafHEh9xDnhPO1Yuw0sgLErWAnWmpfAI/DlikcRA3c6A2UbiyUujW84i33Zl0Fl4206i4/9O/3lAskjXpmJuTJHrmAaKNdp7ahQgNkvZNNgkQ1wA3yadi3Gm8CHObeWqhp+zsT5ehRPn0UM8dSku+aI1YA5MKlcrP4r3zUAtm9D5+gNAAAAAElFTkSuQmCC" alt="movie_app_logo">
                        <span class="no-underline font-bold ml-2 text-xl text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-red-600">
                            {{ config('app.name') }}
                        </span>
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
                {{-- <div id="one" class="px-5 text-center border-b-2 border-slate-200 button">Search Movie</div> --}}
                <div class="relative flex search-box items-center">
                    <div class="w-64 rounded-full pl-8 py-1 bg-gray-800 text-gray-400">Press / to search</div>
                    <div class="absolute my-auto">123</div>
                </div>

                <!-- Login Btn -->
                @if (!Auth::check())
                    <!-- Login -->
                    <div class="login-btn px-7 py-1 bg-gray-700 text-gray-300" x-on:click="loginModal = true">
                        Login
                    </div>
                @endif

                <!-- Account -->
                @if (Auth::check())
                    <div class="relative mt-3 lg:mt-0 w-32 text-right select-none mr-10">
                        <div class="flex justify-end align-center gap-2">
                            <i class="fa-solid fa-user rounded-full border-white border-2 p-1 cursor-pointer" x-on:click="account_dropdown = !account_dropdown"></i>
                            <i class="fa-solid fa-caret-down fa-xl my-auto cursor-pointer" x-on:click="account_dropdown = !account_dropdown" ></i>
                        </div>
                        <ul class="absolute z-50 bg-gray-600 rounded-md shadow-xl text-left mt-2 w-full" style="display: none" x-show="account_dropdown" x-transition @click.outside="account_dropdown = false">
                            <a href="#">
                                <li class="block text-sm font-semibold pl-2 pr-2 text-white hover:bg-gray-700 py-2 rounded-md">Account setting</li>
                            </a>
                            <div onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <li class="block text-sm font-semibold pl-2 pr-2 text-white hover:bg-gray-700 py-2 rounded-md cursor-pointer">Logout</li>
                            </div>
                        </ul>
                    </div>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endif
                
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
        <div class="login-box" x-on:click.outside="loginModal = false; resetInput();" @keydown.escape.window="loginModal = false">
            <!-- Close -->
            <span class=" close fixed top-5 right-5 text-gray-300 cursor-pointer hover:rotate-90 hover:scale-150 transition duration-200" x-on:click="loginModal = false; resetInput();">
                <i class="fa-solid fa-xmark fa-2xl"></i>
            </span>
            <h1 class="text-center text-2xl pb-10 tracking-widest font-bold mt-7">Login</h1>
            <!-- Start Login Form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Email -->
                <div class="user-box mb-5 @error('email') invalid @enderror">
                    <input type="text" name="email" value="{{ old('email') }}" required x-ref="email">
                    @error('email') 
                        <span class="text-sm text-red-500 font-bold">{{ $message }}</span> 
                    @enderror
                    <label>Email</label>
                </div>

                <!-- Password -->
                <div class="user-box mb-3">
                    <input type="password" name="password" required x-ref="password">
                    @error('password') 
                        <span class="text-sm text-red-500 font-bold">{{ $message }}</span> 
                    @enderror
                    <label>Password</label>
                </div>

                <!-- Remember me -->
                <div class="flex items-center justify-between mt-4 mb-5">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="remember" class="text-white hover:cursor-pointer select-none text-center text-sm font-semibold">Remember me</label>
                        </div>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                </div>  
                
                <!-- Login -->
                <div class="text-center mt-10">
                    <button type="submit" class="w-full py-1 px-10 mx-auto login-btn-2 rounded-md">
                        Login
                    </button >
                </div>

                <!-- Sign up -->
                <div class="text-gray-400/80 text-sm mt-5 font-semibold text-center">
                    <span>Don't have an account ? <a class="text-blue-500 text-lg hover:underline" href="{{ route('register') }}">Sign up</a></span>
                </div>

                <div class="inline-flex items-center justify-center w-full">
                    <hr class="w-full h-px bg-gray-600 border-0 dark:bg-gray-700">
                    <span class="absolute px-3 font-medium text-gray-600 -translate-x-1/2 bg-[#252222f2] left-1/2 ">or</span>
                </div>

                <!-- Social media login -->
                <a href="{{ route('facebook.login') }}">
                    <div class="facebook w-full py-1 bg-blue-600 hover:bg-blue-800 duration-300 text-center rounded-md mt-3">
                        <i class="fa-brands fa-facebook-f text-white mr-2"></i>
                        <span class="text-sm">Log in with Facebook</span>
                    </div>
                </a>
                <a href="{{ route('google.login') }}">
                    <div class="google w-full flex justify-center align-middle py-1 bg-white hover:bg-slate-300 duration-300 text-center rounded-md mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" viewBox="0 0 48 48" width="22px"><path fill="#fbc02d" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12	s5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24s8.955,20,20,20	s20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/><path fill="#e53935" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039	l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/><path fill="#4caf50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36	c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/><path fill="#1565c0" d="M43.611,20.083L43.595,20L42,20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571	c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/></svg>
                        <span class="text-sm text-black">Log in with Google</span>
                    </div>
                </a>
                <a href="{{ route('github.login') }}">
                    <div class="github w-full flex justify-center align-middle py-1 bg-[#f5f5f5] hover:bg-slate-300 duration-300 text-center rounded-md mt-3">
                        <i class="fa-brands fa-github text-xl text-black mr-2"></i>
                        <span class="text-sm text-[#333]">Log in with Github</span>
                    </div>
                </a>
            </form>
            <!-- End Login Form -->
        </div>
    </div>


    <!-- Search Modal -->
    <div id="search-modal-container">
        <div class="modal-background">
            <div class="modal">
            123
            </div>
        </div>
    </div>


    <!-- Scroll Top -->
    <div class="scroll-to-top fixed bottom-24 right-28 z-50 hidden" x-show="window.pageYOffset > 100">
        <div class="relative">
            <span class="absolute p-5 bg-gray-600 rounded-full shadow-2xl z-20 cursor-pointer hover:bg-gray-700" x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })">
                <i class="fa-solid fa-angle-up text-white m-0 p-0 fa-2xl"></i>
            </span>
            <span class="absolute p-5 bg-gray-600 rounded-full animate-ping z-10">
                <i class="fa-solid fa-angle-up text-white m-0 p-0 fa-2xl"></i>
            </span>
        </div>
    </div>


    @yield('content')


    <!-- Footer -->
    <div class="footer w-full bg-slate-800 mt-20 py-8 px-4 lg:flex justify-between">
        <!-- Website Info -->
        <div class="website-info lg:w-1/4">
            <a href="{{ route('movies.index') }}" class="flex align-middle mb-3 justify-center lg:justify-start">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKUlEQVR4nO2WTU4CMRSAuzLsvICs2bPQRIY9E+K5HJceA0LCHfhdcwXHYYVGWRrNZxob8lLKoO0UiOFLumhf06/z+qapUqcCUAcGwNq0IdA4hPSFbV51LKZ4wG76Yt4F8AAsgQLI9FiIeC1Et0Ai+u9inhbZZFWJE6At+m9iXuHYXBEiHpakuucQy80FiRumkGxWwNWeVN97i0Vl9/WZmtaTUlFcmfny8OI6CkAXeMafHEh9xDnhPO1Yuw0sgLErWAnWmpfAI/DlikcRA3c6A2UbiyUujW84i33Zl0Fl4206i4/9O/3lAskjXpmJuTJHrmAaKNdp7ahQgNkvZNNgkQ1wA3yadi3Gm8CHObeWqhp+zsT5ehRPn0UM8dSku+aI1YA5MKlcrP4r3zUAtm9D5+gNAAAAAElFTkSuQmCC" alt="movie_app_logo">
                <span class="no-underline font-bold ml-2 my-auto text-lg text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-red-600">
                    {{ config('app.name') }}
                </span>
            </a>
            <div class="leading-relaxed text-slate-400 text-sm text-center lg:text-left">Whether you're a cinephile, a casual moviegoer, or someone in search of their next movie night selection, our website has something for everyone. Sit back, relax, and let our movie database and trailer feature enhance your movie-watching experience.</div>
        </div>
        <!-- Developer Info -->
        <div class="developer-info lg:w-1/3">
            <h2 class="font-bold text-lg mt-6 lg:mt-0 text-center lg:text-left text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-red-600">
                Developer Information :
            </h2>
            <div class="developer-name mt-2 flex gap-2 justify-center lg:justify-start text-slate-400 text-sm">
                <span>Name :</span>
                <span class="font-bold">Liong Kah How</span>
            </div>
            <div class="developer-degree flex gap-2 justify-center lg:justify-start text-slate-400 text-sm">
                <span>Highest Achievement :</span>
                <span class="font-bold">Bachelor's Information Technology</span>
            </div>
            <div class="developer-involvement flex gap-2 justify-center lg:justify-start text-slate-400 text-sm">
                <span>Involvement :</span>
                <span class="font-bold">Frontend & Backend</span>
            </div>
            <div class="developer-social flex gap-3 mt-3 justify-center lg:justify-start">
                <div class="linkedin">
                    <a href="https://www.linkedin.com/in/kahhowliong" target="_blank">
                        <div class="rounded-md bg-transparent border-2 border-slate-300  px-2 py-1 hover:-translate-y-1 duration-200">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </div>
                    </a>
                </div>
                <div class="facebook">
                    <a href="https://www.facebook.com/profile.php?id=100003875460257" target="_blank">
                        <div class="rounded-md bg-transparent border-2 border-slate-300  px-2 py-1 hover:-translate-y-1 duration-200">
                            <i class="fa-brands fa-facebook"></i>
                        </div>
                    </a>
                </div>
                <div class="email">
                    <a href="mailto:jia_how99@hotmail.com" target="_blank">
                        <div class="rounded-md bg-transparent border-2 border-slate-300  px-2 py-1 hover:-translate-y-1 duration-200">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                    </a>
                </div>
            </div>  
        </div>
        <!-- Contact Info -->
        <div class="contact-info lg:w-1/5">
            <h2 class="font-bold text-lg mt-6 lg:mt-0 text-center lg:text-left text-transparent bg-clip-text bg-gradient-to-r from-yellow-600 to-red-600">Contact Me :</h2>
            <div class="developer-degree mt-2 flex gap-2 justify-center lg:justify-start text-slate-400 text-sm">
                <span>Email :</span>
                <a href="mailto:jia_how99@hotmail.com">
                    <span class="font-bold text-blue-600 underline underline-offset-2">jia_how99@hotmail.com</span>
                </a>
            </div>
            <div class="developer-degree flex gap-2 justify-center lg:justify-start text-slate-400 text-sm">
                <span>Contact No :</span>
                <span class="font-bold">018-7754338</span>
            </div>
        </div>
    </div>
    

    @yield('scripts')
    
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @livewireScripts

    <!-- If make API call -->
    @if (session('loader'))
        <script>
            // Preloader animation
            window.addEventListener("load", () => {
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


    <script>
        // Scroll to Top button
        const scrollToTopBtn = document.querySelector(".scroll-to-top");
        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 100) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        // Hamburger menu
        function toggleMenu() {
            $('#hamburger-menu').slideToggle();
        }


        $('.button').click(function(){
            var buttonId = $(this).attr('id');
            $('#search-modal-container').removeAttr('class').addClass(buttonId);
            $('body').addClass('modal-active');
        })

        $('#search-modal-container').click(function(){
            $(this).addClass('out');
            $('body').removeClass('modal-active');
        });
    </script>

</body>
</html>