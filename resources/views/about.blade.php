<x-layout>
<section class="hero">
    <div class="hero-slice frame mr-10">
        <div class="bg-white rounded-xl shadow-md object-contain"><img src="{{ asset('images/logo/zga_logo.jpg') }}" alt="Logo" class="w-full h-full p-20"></div>
    </div>
    <div class="hero-slice">
        <div class="hero-content">
            <div class="hero-text">
                <h1>About us</h1>
                <p>The Zimbabwe Golf Association (ZGA) is the official governing body for amateur golf in Zimbabwe. We are dedicated to promoting, developing, and regulating the game across the country, empowering golfers at all levels and representing Zimbabwe on the regional and international stage.</p>
            </div>
            <a href="{{route('contact')}}">
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

<section class="about-us">
  <div class="grid grid-cols-1 md:grid-cols-2 mx-10">
    <div class="md:col-span-2 rounded-xl">
      <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-snug text-black">
        THE ZIMBABWE GOLF ASSOCIATION (ZGA) WAS FOUNDED IN
        <span class="inline-block bg-red-500 text-white font-semibold px-3 py-1 rounded-full ml-2">1947</span>
         AS A UNIFYING BODY FOR GOLF CLUBS <span class="border-solid border-[1px] border-black p-2 rounded-[50%] text-xl
         transition-transform duration-[300ms] ease-[ease]
         hover:bg-[color:var(--green)] hover:text-white hover:scale-110"><i class="fa-solid fa-building-user"></i></span> ACROSS THE COUNTRY. IN A TIME WHEN THE SPORT WAS RAPIDLY GROWING IN POPULARITY AND NEEDED GOVERNANCE.<span class="border-solid border-[1px] border-black p-2 rounded-[50%] text-xl
         transition-transform duration-[300ms] ease-[ease]
         hover:bg-[color:var(--green)] hover:text-white hover:scale-110"><i class="fa-solid fa-landmark-dome"></i></span>
      </h2>
    </div>
    <div class="flex justify-center md:justify-center items-center">
      <img src="{{ asset('icons/golfball.jpg') }}" alt="Golf Club and Ball" class="w-90" />
    </div>
    <div>
      <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-snug text-black">
        THE ZGA WAS FORMED TO BRING
        <span class="inline-block bg-yellow-400 text-white font-semibold px-3 py-1 rounded-full mx-1">STRUCTURE</span>,
        <span class="inline-block bg-green-500 text-white font-semibold px-3 py-1 rounded-full mx-1">FAIRNESS</span>,
        AND <span class="inline-block bg-black text-white font-semibold px-3 py-1 rounded-full mx-1">DEVELOPMENT</span>
        TO AMATEUR GOLF IN ZIMBABWE.<span class="border-solid border-[1px] border-black p-2 px-2.5 rounded-[50%] text-xl
         transition-transform duration-[300ms] ease-[ease]
         hover:bg-[color:var(--green)] hover:text-white hover:scale-110"><i class='fa-solid fa-golf-ball-tee'></i></span>
      </h2>
      <p class="text-sm text-gray-500 mt-4 leading-relaxed">
        From its early days, ZGA worked closely with local clubs to organize official tournaments, standardize rules of play,
        and promote the spirit of the game. Over the decades, it has evolved into a nationally recognized authority, helping shape
        the landscape of golf through junior development programs, national championships, and international representation.
      </p>
    </div>
  </div>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mx-4 sm:mx-6 lg:mx-10">    
    <div class="rounded-xl green-bg flex flex-col items-center justify-center text-center p-10 h-auto space-y-4">
        <span class="bg-[color:var(--black)] px-3.5 py-3.5 rounded-[60%] transition-transform duration-300 ease-in-out text-3xl text-white hover:bg-[color:var(--green)] hover:text-white hover:scale-110">
            <i class="fa-solid fa-bullseye"></i>
        </span>
        <h4 class="font-bold text-lg">Mission</h4>
        <p class="text-sm">
            To promote, develop, and regulate the game of golf in Zimbabwe by creating inclusive opportunities, nurturing talent from grassroots to elite level, and representing Zimbabwean golf with pride on the regional and international stage.
        </p>
    </div>
    <div class="rounded-xl gold-bg flex flex-col items-center justify-center text-center p-10 h-auto space-y-4">
        <span class="bg-[color:var(--black)] px-3.5 py-3.5 rounded-[60%] transition-transform duration-300 ease-in-out text-3xl text-white hover:bg-[color:var(--green)] hover:text-white hover:scale-110">
            <i class="fa-solid fa-star"></i>
        </span>
        <h4 class="font-bold text-lg">Values</h4>
        <p class="text-sm">
            Integrity, <br> Excellence,<br>  Inclusivity,<br>  Development, <br> Teamwork and Innovation
        </p>
    </div>
    <div class="rounded-xl red-bg flex flex-col items-center justify-center text-center p-10 h-auto space-y-4">
        <span class="bg-[color:var(--black)] px-3.5 py-3.5 rounded-[60%] transition-transform duration-300 ease-in-out text-3xl text-white hover:bg-[color:var(--green)] hover:text-white hover:scale-110">
            <i class="fa-solid fa-glasses"></i>
        </span>
        <h4 class="font-bold text-lg">Vision</h4>
        <p class="text-sm">
            To be a leading force in African golf by building a dynamic, accessible, and competitive golfing community that inspires excellence, fosters integrity, and empowers the next generation of golfers across Zimbabwe.
        </p>
    </div>
  </div>
</section>

<section class="faq-section">
  <div class="container">
    <div class="faq-section-grid">
      <div class="faq-section title">
          <div class="section-title">
            <h2>What do we do?</h2>
            <p>The Zimbabwe Golf Association (ZGA) governs and grows the game of amateur golf nationwide. We organize national tournaments, support junior and amateur development programs, train coaches, and promote equal access to the sport. Through strong partnerships and international representation, we work to uplift Zimbabwean golf and create lasting opportunities for all players.</p>
          </div>
      </div>
      <div class="faq-section-content">
        <x-accordion-item 
        title="Tournament Management"
        content="ZGA organizes and sanctions a wide range of tournaments across the country — from junior events to national championships. These tournaments are designed to provide competitive platforms for players of all skill levels, helping them improve and gain recognition. We also collaborate with clubs and regions to ensure that events are inclusive, well-structured, and aligned with international golfing standards."
        :active="true" />
        <x-accordion-item 
        title="Coach & Official Training"
        content="We provide certification programs for coaches and officials to ensure that Zimbabwean golf is guided by knowledgeable, ethical, and skilled leaders. Our training covers rules, coaching techniques, and tournament management, raising the standard of golf instruction and officiating nationwide." />

        <x-accordion-item 
        title="Junior & Amateur Development"
        content="ZGA is committed to nurturing young talent and supporting amateur golfers. We run junior golf programs, talent identification camps, and provide resources for skill development, ensuring a strong pipeline of future champions and broad participation in the sport." />

        <x-accordion-item 
        title="Rules & Governance"
        content="As the governing body, ZGA sets and enforces the rules of amateur golf in Zimbabwe. We ensure that all competitions adhere to international standards, promote fair play, and provide guidance to clubs and players on rules and regulations." />

        <x-accordion-item 
        title="Club & Member Support"
        content="We work closely with golf clubs across Zimbabwe, offering support in administration, event organization, and member engagement. ZGA helps clubs grow their membership, improve facilities, and deliver quality golfing experiences." />

        <x-accordion-item 
        title="International Representation"
        content="ZGA represents Zimbabwe in regional and international golf bodies, advocating for our players and clubs. We facilitate participation in international tournaments, build partnerships, and showcase Zimbabwean golf on the global stage." />

      </div>
    </div>
  </div>
</section>

<section class="pre-footer">
    <div class="frame green-bg">
        <div class="text">
            <h2>What are we up to</h2>
            <p>Every event is more than just a game — it's a chance to grow, to lead, and to make your mark on Zimbabwe’s golfing legacy. Join our tournaments, represent your club, and challenge yourself among the nation’s finest. The journey starts with one swing, one round, one opportunity.</p>
        </div>
        <div class="box red-bg">
            <h4>Tournament Schedule</h4>
            <p>Want to make an enquiry about an event? or sign up for a tournamnamet dont hesitate to contact us for more details</p>
            <a href="{{ url('/tournaments') }}">
            <button class="gold-green-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></a>
        </div>
    </div>
</section>
</x-layout>