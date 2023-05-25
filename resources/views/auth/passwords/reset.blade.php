@extends('layouts.main')

@section('content')
<div class="w-2/3 xl:w-1/3 min-h-screen mx-auto">
    <div class="text-3xl text-slate-200 font-semibold mt-10 underline underline-offset-2 tracking-wider">Reset password</div>
    <form method="POST" action="{{ route('password.update') }}" class=" mt-5">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="flex gap-2 items-center">
            <label for="email" class="w-4/12 font-semibold pt-2">Email :</label>
            <div class="w-full">
                <input id="email" type="email" class="pl-4 py-2 rounded-lg w-full bg-slate-500 focus:outline-none tracking-wider" name="email" value="{{ $email ?? old('email') }}" required>
                @error('email')
                    <span class="mt-2 text-red-600">*** {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex gap-2 items-center mt-5">
            <label for="email" class="w-4/12 font-semibold pt-2">New Password :</label>
            <div class="w-full">
                <input id="password" type="password" class="pl-4 py-2 rounded-lg w-full bg-slate-500 focus:outline-none tracking-wider @error('password') border-2 border-red-500 @enderror" name="password" placeholder="New password here" required autofocus>
                @error('password')
                    <span class="mt-2 text-red-600">*** {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex gap-2 items-center mt-4">
            <label for="password-confirm" class="w-4/12 font-semibold pt-2">Confirm Password :</label>
            <div class="w-full">
                <input id="password-confirm" type="password" class="pl-4 py-2 rounded-lg w-full bg-slate-500 focus:outline-none tracking-wider" name="password_confirmation" placeholder="Confirm password" required>
            </div>
        </div>

        <div class="submit-btn mt-5 text-right ">
            <button type="submit" class="bg-slate-600 px-10 py-2 rounded-lg login-btn-2">Reset password</button>
        </div>
    </form>
</div>

@endsection
{{-- 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
