@extends('layouts.main')

@section('content')
    <div class="flex items-center justify-center min-h-screen p-5 bg-blue-100 min-w-screen">
        <div class="relative max-w-xl p-8 text-center text-white bg-gray-900 font-sans shadow-xl lg:max-w-3xl rounded-3xl lg:p-12">
            <h1 class="mx-auto text-white">Thanks for signing up for {{ config('app.name') }} !</h1>
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                </svg>
            </div>

            <p>We're happy you're here. Let's get your email address verified:</p>
            <div class="my-4">
                <a href="{{ $actionUrl }}">
                    <button class="px-5 py-3 text-white bg-gray-600 rounded font-bold">Click to Verify Email</button>
                </a>
                <p class="mt-8 text-sm">If you’re having trouble clicking the "Verify Email Address" button, copy
                    and
                    paste
                    the URL below
                    into your web browser:
                    <a href="{{ $actionUrl }}" class="text-blue-600 underline break-words">{{ $actionUrl }}</a>
                </p>
            </div>
        </div>
    </div>
@endsection

