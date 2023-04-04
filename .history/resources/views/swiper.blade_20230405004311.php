@extends('layouts.main')

@section('content')
   
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
    <div class="swiper-scrollbar" style="color: #fff"></div>
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
        nextEl: ".swiper-button-next1",
        prevEl: ".swiper-button-prev1",
      },
      thumbs: {
        swiper: swiper,
      },
      scrollbar: {
        el: ".swiper-scrollbar",
        hide: true,
      },
    });
</script>
@endsection