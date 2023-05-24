@extends('layouts.main')

@section('content')
@if (session('resent'))
    <div class="bg-teal-100 border-l-4 border-teal-500 text-teal-700 p-4 w-1/2 mx-auto" role="alert">
        <p class="font-bold">Successfully resend !</p>
        <p>Verification has been resend to your email. Please check junkbox if not appearing.</p>
    </div>
@endif

<div class="flex justify-center mt-20 min-h-screen p-5">
    <div class="relative p-8 h-fit text-center text-white bg-gray-700 font-sans shadow-xl lg:max-w-3xl rounded-3xl lg:p-12 ">
        <h1 style="color: white !important; text-align: center !important;">Thanks for signing up for {{ config('app.name') }} !</h1>
        <div class="flex justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-400" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
            </svg>
        </div>

        <p>We're happy you're here. Please check your email for verification:</p>
        <div class="my-4">
            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <button type="submit" class="px-10 py-3 text-white bg-gray-800 hover:bg-gray-600 duration-200 rounded font-bold mb-3">Click to Resend Email</button>
            </form>
            <div>If you <span class="font-semibold underline">did not receive any email</span>, click button above to <span class="font-semibold underline">resend</span> verification email.</div>
        </div>
    </div>
</div>
@endsection


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
