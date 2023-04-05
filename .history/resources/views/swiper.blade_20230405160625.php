@extends('layouts.main')

@section('style')
  <style>
    html,
    body {
      height: 100%;
    }

    .swiper {
      width: 100%;
      height: 100%;
      margin-left: auto;
      margin-right: auto;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      height: calc((100% - 30px) / 2) !important;

      /* Center slide text vertically */
      display: flex;
      justify-content: center;
      align-items: center;
    }

  </style>
@endsection


@section('content')
    <!-- Swiper -->
    <div class="w-[1200px] h-[700px] mx-auto">

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
          <div class="swiper-slide">Slide 2</div>
        </div>
        <div class="swiper-pagination"></div>
      </div>

    </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 5,
      grid: {
        rows: 2,
      },
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
@endsection