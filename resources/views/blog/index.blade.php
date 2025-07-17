<x-layout>

<section class="news-hero">
  <div id="news-carousel" class="my-slider">
    @foreach($recentArticles as $article)
      <x-news-carousel-item :blog="$article" href="{{ route('blog.show', $article->slug) }}" />
    @endforeach
  </div>
</section>



<section class="news-updates">
  <div class="container">
    <div class="section-title text-center">
      <h2>What’s The Latest Updates</h2>
      <p>Stay up to date with what is happening in the world of golf in Zimbabwe</p>
    </div>
    <div class="content">
      <div class="columns-2 gap-4 sm:columns-3 sm:gap-8 my-4">
        @foreach($blog as $blogs)
          <x-post-thumbnail-two :blog="$blogs" href="{{ route('blog.show', $blogs->slug) }}" />
        @endforeach

      </div>
        {{ $blog->links('vendor.pagination.main') }}
    </div>
  </div>
</section>

<section class="pre-footer">
    <div class="frame red-bg">
        <div class="text">
            <h2>Stay on top of the game</h2>
            <p>Every event is more than just a game — it's a chance to grow, to lead, and to make your mark on Zimbabwe’s golfing legacy. Join our tournaments, represent your club, and challenge yourself among the nation’s finest. The journey starts with one swing, one round, one opportunity.</p>
        </div>
        <div class="box gold-bg">
            <h4>
                CONTACT US
            </h4>
            <p>Want to make an enquiry about an event? or sign up for a tournaments do not hesitate to contact us for more details</p>
            <button class="green-red-btn"><a href="">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></a></button>
        </div>
    </div>
</section>

</x-layout>