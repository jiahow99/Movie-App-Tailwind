@extends('layouts.main')

@section('content')
    <!-- Swiper -->
  <div class="swiper mySwiper w-[1000]">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      cssMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
      mousewheel: true,
      keyboard: true,
    });
  </script>
@endsection