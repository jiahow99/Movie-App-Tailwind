@extends('layouts.main')

@section('content')
    <div class="flex justify-center">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('image/image2.jpg') }}" alt=""></div>
                <div class="swiper-slide"><img src="{{ asset('image/image3.jpg') }}" alt=""></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
@endsection