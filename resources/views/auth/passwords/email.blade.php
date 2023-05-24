@extends('layouts.main')

@section('content')
@if (session('status'))
    <div class="bg-teal-100 border-l-4 border-teal-500 text-teal-700 p-4 w-1/2 mx-auto" role="alert">
        <p class="font-bold">Link sent !</p>
        <p>A password reset link has been sent to you email.</p>
    </div>
@endif

<div class="w-1/3 min-h-screen mx-auto">
    <div class="text-3xl text-slate-200 font-semibold mt-10 underline underline-offset-2 tracking-wider">Reset password</div>
    <form method="POST" action="{{ route('password.email') }}" class=" mt-5">
        @csrf

        <div class="flex gap-2 items-center">
            <label for="email" class="w-3/12 text-xl font-semibold">Email :</label>
            <input id="email" type="email" class="pl-4 py-2 rounded-lg w-full bg-slate-500 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email here" required autocomplete="email" autofocus>
        </div>
        <div class="submit-btn mt-5 text-right">
            <button type="submit" class="bg-slate-600 px-10 py-2 rounded-lg">Send email</button>
        </div>
    </form>
</div>

@endsection

{{-- <form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </div>
</form> --}}