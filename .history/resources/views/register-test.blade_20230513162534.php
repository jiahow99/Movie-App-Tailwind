@extends('layouts.main')

@section('content')

<div class="register-form flex justify-center align-middle">
    <!-- Title -->
    <h1 class="mt-10 text-4xl font-bold tracking-wider">Register</h1>

    
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
                    <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                </div>  
                
                <!-- Login -->
                <div class="text-center mt-10">
                    <button type="submit" class="w-full py-1 px-10 mx-auto login-btn-2 rounded-md">
                        Login
                    </button >
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
</div>

@endsection