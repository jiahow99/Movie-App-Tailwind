
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

  <!-- Demo styles -->
  <style>
    html,
    body {
      position: relative;
      height: 100%;
    }

    body {
      background: #eee;
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <!-- Swiper -->
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="mt-8">
          <a href="{{ route('movie.show', $movie['id']) }}">
              <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] }}" class="transition ease-in-out duration-500 hover:scale-105 hover:opacity-60" alt="parasite">
          </a>
          <div class="mt-2">
              <a href="#" class="text-lg mt-2 hover:text-gray-300 duration-500">{{ $movie['title'] }}</a>
          </div>
          <div class="flex items-center text-gray-400">
              <span class="text-orange-400"><i class="fa-solid fa-star"></i></span>
              <span class="ml-1">{{ $movie['vote_average']*10 }}%</span>
              <span class="mx-2">|</span>
              <span>
                  @isset($movie['release_date'])
                      {{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}
                  @else
                      To be confirmed
                  @endisset
              </span>
          </div>
          <div class="text-gray-400">
              @foreach ($movie['genre_ids'] as $genre)
                  {{ $genres->get($genre) }}
                  @if(!$loop->last)
                      ,
                  @endif
              @endforeach
          </div>
      </div>
      </div>
      <div class="swiper-slide">Slide 2</div>
      <div class="swiper-slide">Slide 3</div>
      <div class="swiper-slide">Slide 4</div>
      <div class="swiper-slide">Slide 5</div>
      <div class="swiper-slide">Slide 6</div>
      <div class="swiper-slide">Slide 7</div>
      <div class="swiper-slide">Slide 8</div>
      <div class="swiper-slide">Slide 9</div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
</body>

</html>
