<x-layout>
<section class="hero">
  <div class="hero-slice">
    <div class="hero-content">
        <div class="hero-text">
            <h1>Shaping the future of golf in Zimbabwe by fostering talent.</h1>
            <p>Committed to nurturing talent, maintaining golfing standards, and representing Zimbabwe on the global golfing stage. We strive to create a thriving golfing community that celebrates excellence, fosters sportsmanship, and builds lasting legacies for the future of golf in Zimbabwe.</p>
        </div>
        <div class="hero-button">
            <a href="#aboutUs"><button class="red-gold-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></a>
        </div>
        <div class="hero-tags">
          <div class="hero-tag-row">
              <div class="hero-tag-icon">
                  <img src="{{asset('icons/golf_ball_tee.png')}}" alt="golf ball tee icon">
              </div>
              <div class="hero-tag green-bg">
                  <p>National Tournaments</p>
              </div>
              <div class="hero-tag gold-bg">
                  <p>Talent Development</p>
              </div>
          </div>
          <div class="hero-tag-row">
              <div class="hero-tag red-bg">
                  <p>Junior Golf Programs</p>
              </div>
              <div class="hero-tag black-bg">
                  <p>Rules of the Game</p>
              </div>
          </div>
        </div>
      </div>
  </div>
  <div class="hero-slice">
    <figure>
      <div class="hero-section">
        <svg class="yellow-shape" viewBox="0 0 400 400" xmlns="http://www.w3.org/2000/svg">
          <path d="M400,0 A220,220 0 1,0 400,400 Z" fill="#FFC711" />
        </svg>
        
        <svg class="red-circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
          <path d="M100,0 A50,50 0 1,0 100,100 Z" fill="#F44336" />
        </svg>
        <div class="my-slider" id="hero-slider">
          <div class="player-slide" data-name="Elton Zulu" data-quote="Stay focused, stay humble, keep grinding.">
            <div class="hero-image">
              <img src="{{asset('images/players/Elton Zulu.png')}}" alt="Elton Zulu">
            </div>
          </div>
          <div class="player-slide" data-name="Darlington Chikanyambidze" data-quote="Hard work beats talent.">
            <div class="hero-image">
              <img src="{{asset('images/players/Darlington Chikanyambidze.png')}}" alt="Darlington">
            </div>
          </div>
          <div class="player-slide" data-name="Tanaka Chatora" data-quote="“There is no secret behind my success, you just have to play and practice as much as you can”">
            <div class="hero-image">
              <img src="{{asset('images/players/Tanaka Chatora.png')}}" alt="Tanaka Chatora">
            </div>
          </div>
        </div>
      </div>
      <figcaption id="caption-display">
        <span class="figcaption-icon"><i class="fa-solid fa-golf-ball-tee"></i></span>
        <div class="caption-text">
          <p class="name"></p>
          <p class="quote"></p>
        </div>
      </figcaption>
    </figure>
  </div>
</section>

<section class="about-us" id="aboutUs">
  <div class="container">
    <div class="about-us-content">
      <div class="about-us-text">
        <h3>Zimbabwe Golf Association is the national governing body for amateur golf in Zimbabwe, dedicated to growing the sport and developing talent at all levels.</h3>
      </div>
      <div class="about-us-items">
        <div class="row">
          <div class="col-6 col-md">
            <div class="about-us-item">
              <div class="about-us-icon green-bg">
                <img src="{{ asset('icons/golf-stick.png') }}" alt="golf ball tee icon">
              </div>
              <h3>Organizing National Tournaments</h3>
              <p>Organizes a wide range of national tournaments for men, women, and junior players</p>
            </div>
          </div>
          <div class="col-6 col-md">
            <div class="about-us-item">
              <div class="about-us-icon gold-bg">
                <img src="{{ asset('icons/golf-player.png') }}" alt="golf ball tee icon">
              </div>
              <h3>Talent Development and Junior Golf Programs</h3>
              <p>The development of young golfers through structured junior programs.</p>
            </div>
          </div>
          <div class="col-6 col-md">
            <div class="about-us-item">
              <div class="about-us-icon red-bg">
                <img src="{{asset('icons/golf-stick.png')}}" alt="golf ball tee icon">
              </div>
              <h3> Handicap System and Course Rating</h3>
              <p>Maintains the official handicap system in Zimbabwe, in order for golfers to play on a level playing field.</p>
            </div>
          </div>
          <div class="col-6 col-md">
            <div class="about-us-item">
              <div class="about-us-icon black-bg">
              <img src="{{ asset('icons/golf_hit.png') }}" alt="golf ball tee icon">
              </div>
              <h3>Rules and Integrity of the Game</h3>
              <p>Is responsible for educating players, referees, and clubs about the official rules of golf.</p>
            </div>
          </div>
          <div class="col-6 col-md">
            <div class="about-us-item">
              <div class="about-us-icon white-bg">
                <img src="{{asset('icons/golf-champion-black.png')}}" alt="International Representation Icon">
              </div>
              <h3>International Representation</h3>
              <p>Is responsible for the selection of national teams that represent the country at tournaments</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="tournaments">
    <div class="container">
      <div class="section-title">
        <h2>What's on our calender?</h2>
        <p>The up and coming tournaments that are being hosted by the ZGA</p>
      </div>
      <div class="tournaments-content">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($tournaments as $tournament)
            <div class="flex">
              <x-tournament-card :tournament="$tournament" class="flex-grow" />
            </div>
          @endforeach
        </div>
        <div class="tournament-footer">
          <div class="tournament-footer-item gold-bg">
            <p>Become a</p>
          </div>
          <div class="tournament-footer-item green-bg">
            <p>Champion</p>
          </div>
          <a href="{{route('tournaments')}}">
            <div class="tournament-footer-item red-bg hover:bg-[color:var(--gold)]">
              <i class="fa-solid fa-arrow-right fa-rotate-by" style="--fa-rotate-angle: -45deg;"></i>
            </div>
          </a>
          <div class="tournament-footer-item black-bg">
            <img src="{{asset('icons/golfball.jpg')}}" alt="">
          </div>
        </div>
      </div>
    </div>
</section>

<section class="player-profiles">
  <div class="container">
    <div class="player-profile-grid">
      <div class="player-profile title">
          <div class="section-title">
            <h2>Who is dominating the board</h2>
            <p>Check out the amateur golf players dominating Zimbabwe.</p>
          </div>
          <div class="section-btn">
            <div class="section-btn-icon">
              <img src="{{asset('icons/golf_ball_tee.png')}}" alt="golf ball tee icon">
            </div>
            <button class="red-gold-btn"><a href="{{route('players')}}">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></a></button>
          </div>
      </div>
      <div class="player-profile-slider">
        <div class="flex flex-row justify-center">
        @foreach($playersHome as $player)
            <x-player-card :player="$player" />
        @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<section class="news-updates">
  <div class="container">
    <div class="section-title">
      <h2>What’s The Latest Updates</h2>
      <p>Stay up to date with what is happening in the world of golf in Zimbabwe</p>
    </div>

    <div class="news-updates-grid">
      @if($recentArticles->count())
        {{-- Main Article (First One) --}}
        <div class="news-update-main">
          <x-post-thumbnail1 :blog="$recentArticles[0]" href="{{ route('blog.show', $recentArticles[0]->slug) }}"/>
          <div class="mt-5">
            <a href="{{ route('blog') }}">
              <button class="red-gold-btn">
                Learn More
                <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span>
              </button>
            </a>
          </div>
        </div>

        {{-- Right Side Articles (Remaining 4) --}}
        @foreach($recentArticles->slice(1) as $article)
          <x-post-thumbnail-two :blog="$article" href="{{ route('blog.show', $article->slug) }}"/>
        @endforeach
      @else
        <p>No recent articles available.</p>
      @endif
    </div>
  </div>
</section>


</x-layout>