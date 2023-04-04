@extends('layouts.main')

@section('content')
    <!-- Swiper -->
  {{-- <div class="swiper mySwiper w-[1000px]">
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
  </script> --}}


<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 w-[1000px]">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
    </div>
    <div class="swiper-scrollbar"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
  <div thumbsSlider="" class="swiper mySwiper w-[1000px]">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
      <div class="swiper-slide">
        <img src="{{ asset('image/image1.jpg') }}" />
      </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 5,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
      
    });
  </script>
@endsection