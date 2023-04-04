@extends('layouts.main')

@section('content')
    <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
      <div class="swiper-slide"><img src="{{ asset('image/image1.jpg') }}" alt=""></div></div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
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