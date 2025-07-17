<x-layout>
    <section class="hero">
    <div class="hero-slice">
        <div class="hero-content">
            <div class="hero-text">
                <h1>What’s on our calendar?</h1>
                <p>Our calendar is packed with exciting tournaments, development programs, and national team preparations. From junior circuits and inter-club matches to elite national championships and international qualifiers, we provide year-round opportunities for golfers across Zimbabwe to compete, grow, and connect.</p>
            </div>
            <div class="hero-button">
                <a href="#tournaments"><button class="red-gold-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></a>
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
    <div class="hero-slice frame ml-10">
        @if($currentTournament)
            <x-tournament-card :tournament="$currentTournament"/>
        @endif
    </div>
</section>

<section class="tournaments" id="tournaments">
    <div class="container">
      <div class="section-title text-center">
        <h2>this year’s Events to keep track of</h2>
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
        {{ $tournaments->links('vendor.pagination.main') }}
      </div>
    </div>
</section>

<section class="pre-footer">
    <div class="frame red-bg">
        <div class="text">
            <h2>become A CHAMPION</h2>
            <p>Every event is more than just a game — it's a chance to grow, to lead, and to make your mark on Zimbabwe’s golfing legacy. Join our tournaments, represent your club, and challenge yourself among the nation’s finest. The journey starts with one swing, one round, one opportunity.</p>
        </div>
        <div class="box green-bg">
            <h4>
                CONTACT US
            </h4>
            <p>Want to make an enquiry about an event? or sign up for a tournaments do not hesitate to contact us for more details</p>
            <a href="{{route('contact')}}">
                <button class="gold-green-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button>
            </a>
        </div>
    </div>
</section>

</x-layout>