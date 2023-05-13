@extends('layouts.main')

@section('style')
    <style>
        .register-box {
        background: #252222f2;
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0,0,0,.6);
        border-radius: 10px;
        }

        .register-box .user-box {
        position: relative;
        }

        .register-box .user-box input {
        width: 100% !important;
        padding: 10px 0 !important;
        font-size: 16px !important;
        color: #fff !important;
        /* margin-bottom: 30px; */
        border: none !important;
        border-bottom: 1px solid #fff !important;
        outline: none !important;
        background: transparent !important;
        }

        .register-box .invalid input{
        border-bottom: 2px solid #d31414 !important;
        }

        /* Disable Autofill overriding Css */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
        -webkit-transition: "color 9999s ease-out, background-color 9999s ease-out";
        -webkit-transition-delay: 9999s;
        }

        .register-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
        }

        .register-box .user-box input:focus ~ label,
        .register-box .user-box input:valid ~ label {
        top: -20px;
        left: 0;
        color: #bdb8b8;
        font-size: 12px;
        }
    </style>
@endsection

@section('content')

<div class="register-form flex justify-center align-middle">
    <div>
        <!-- login modal -->
        <div class="register-box w-[800px] mt-4 py-5">
            <h1 class="text-center text-2xl pb-10 tracking-widest font-bold mt-7 underline">Register</h1>
            <div class="flex justify-between gap-5">
                <!-- Start Login Form -->
                <form class="basis-1/2" action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email -->
                    <div class="user-box mb-3 @error('email') invalid @enderror">
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
    
                    <!-- Confirm Password -->
                    <div class="user-box mb-3">
                        <input type="password_confirm" name="password_confirmation" required x-ref="password_confirm">
                        <label>Confirm Password</label>
                    </div>
    
    
                    <!-- Remember me -->
                    <div class="flex items-center justify-between mt-10 mb-5">
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
    
                    {{-- <!-- Sign up -->
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
                    </a> --}}
                </form>
                <!-- End Login Form -->

                <!-- Start Social Login -->
                <div class="basis-1/2 border-l border-neutral-600">
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
                </div>
                <!-- End Social Login -->
            </div>
        </div>
    </div>
    
</div>

@endsection