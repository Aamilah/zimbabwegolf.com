<x-layout>
    <section class="mx-10">
        <x-blog-post :blog="$blog" />
    </section>
    <section class="pre-footer">
        <div class="frame gold-bg">
            <div class="text">
                <h2>Get to know the champions</h2>
                <p>Every event is more than just a game — it's a chance to grow, to lead, and to make your mark on Zimbabwe’s golfing legacy. Join our tournaments, represent your club, and challenge yourself among the nation’s finest. The journey starts with one swing, one round, one opportunity.</p>
            </div>
            <div class="box green-bg">
                <h4>
                    CONTACT US
                </h4>
                <p>Want to make an enquiry about an event? or sign up for a tournaments do not hesitate to contact us for more details</p>
                <button class="red-gold-btn"><a href="">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></a></button>
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
                <x-post-thumbnail1 :blog="$recentArticles[0]" href="{{ route('blog.show', $recentArticles[0]->slug) }}" />
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