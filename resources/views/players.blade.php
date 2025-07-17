<x-layout>
<section class="hero">
    <div class="hero-slice w-64 h-64 relative frame mr-10 z-index-0">
        <!-- Yellow semi-circle (large) -->
        <div class="absolute top-2/5 right-50 w-[850px] h-[850px] bg-[color:var(--gold)] rounded-full -translate-y-1/2 z-index-1"></div>
        <!-- Red circle (small) -->
        <div class="absolute top-0 left-0 w-64 h-64 bg-[color:var(--red)] rounded-full translate-y-0 -translate-x-1/3 z-index-2"></div>
        <img src="{{asset('images/players/golf-player-silhouette-vector.png')}}" alt="" class="logo-img absolute top-1/2 left-1/2 w-32 h-32 transform -translate-x-1/2 -translate-y-1/2 z-index-3">
    </div>
    <div class="hero-slice">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Team Zimbabwe</h1>
                <p>Discover the passion, skill, and dedication of Team Zimbabwe’s top golfers. Our players strive for excellence, representing the nation with pride and inspiring the next generation of champions. Through rigorous training, teamwork, and a relentless pursuit of greatness, they embody the spirit of Zimbabwean golf. Join us as we celebrate their achievements and encourage future stars to rise and shine on the national stage.</p>
            </div>
            <a href="#playerProfile">
                <div class="hero-button">
                    <button class="red-gold-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button>
                </div>
            </a>
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
</section>

<section class="player-profiles" id="playerProfile">
    <div class="container">
      <div class="section-title text-center">
        <h2>Our Top players of the year</h2>
        <p>The players making the Zimbabwe amateur league this year  </p>
      </div>
      <div class="player-profiles-content">
        <div class="flex flex-wrap justify-center">
            @foreach($players as $player)
                <x-player-card :player="$player" />
            @endforeach
        </div>
        {{ $players->links('vendor.pagination.main') }}
      </div>
    </div>
</section>

<section class="pre-footer">
    <div class="frame gold-bg">
        <div class="text">
            <h2>Get to know the champions</h2>
            <p>Every event is more than just a game — it's a chance to grow, to lead, and to make your mark on Zimbabwe’s golfing legacy. Join our tournaments, represent your club, and challenge yourself among the nation’s finest. The journey starts with one swing, one round, one opportunity.</p>
        </div>
        <div class="box green-bg">
            <h4>
                Tournaments
            </h4>
            <p>Want to become a champion? or play a game of golf? take a look at the tournaments that are being held</p>
            <a href="{{route('tournaments')}}">
            <button class="red-gold-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></a>
        </div>
    </div>
</section>

</x-layout>