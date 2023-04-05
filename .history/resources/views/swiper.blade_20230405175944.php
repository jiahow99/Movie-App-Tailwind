@extends('layouts.main')

@section('style')
<style>

  .mySwiper{
    /* height: 30%; */
  }

  .swiper-slide {
    background: transparent;
    width: 25%;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>
@endsection


@section('content')
    
  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="mt-8">
          <a href="#">
              <img src="{{ asset('image/joker.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Movie Title</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">30%</span>
              <span class="mx-2">|</span>
              <span>
                13 Jan 2023
              </span>
          </div>
          <div class="text-gray-400">
              Auction, Terrible
          </div>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="mt-8">
          <a href="#">
              <img src="{{ asset('image/joker.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Movie Title</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">30%</span>
              <span class="mx-2">|</span>
              <span>
                13 Jan 2023
              </span>
          </div>
          <div class="text-gray-400">
              Auction, Terrible
          </div>
        </div>
      </div><div class="swiper-slide">
        <div class="mt-8">
          <a href="#">
              <img src="{{ asset('image/joker.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Movie Title</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">30%</span>
              <span class="mx-2">|</span>
              <span>
                13 Jan 2023
              </span>
          </div>
          <div class="text-gray-400">
              Auction, Terrible
          </div>
        </div>
      </div><div class="swiper-slide">
        <div class="mt-8">
          <a href="#">
              <img src="{{ asset('image/joker.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Movie Title</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">30%</span>
              <span class="mx-2">|</span>
              <span>
                13 Jan 2023
              </span>
          </div>
          <div class="text-gray-400">
              Auction, Terrible
          </div>
        </div>
      </div><div class="swiper-slide">
        <div class="mt-8">
          <a href="#">
              <img src="{{ asset('image/joker.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Movie Title</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">30%</span>
              <span class="mx-2">|</span>
              <span>
                13 Jan 2023
              </span>
          </div>
          <div class="text-gray-400">
              Auction, Terrible
          </div>
        </div>
      </div><div class="swiper-slide">
        <div class="mt-8">
          <a href="#">
              <img src="{{ asset('image/joker.jpg') }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">Movie Title</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">30%</span>
              <span class="mx-2">|</span>
              <span>
                13 Jan 2023
              </span>
          </div>
          <div class="text-gray-400">
              Auction, Terrible
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
@endsection

