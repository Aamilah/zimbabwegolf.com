@props(['blog', 'href' => '#'])

<div class="news-carousel-item">
      <div class="news-carousel-grid">
            <div class="news-carousel-slice">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1>{{$post->headline}}</h1>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 250, '...') }}</p>
                    </div>
                    <a href="{{ $href }}">
                        <div class="hero-button">
                            <button class="red-gold-btn">Learn More <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button>
                        </div>
                    </a>
                    <div class="hero-tags">
                        <div class="hero-tag-row">
                            <div class="hero-tag-icon">
                                <img src="{{asset('icons/golf_ball_tee.png')}}" alt="golf ball tee icon">
                            </div>
                            @php
                                $created = \Carbon\Carbon::parse($post->created_at);
                            @endphp
                            <div class="hero-tag green-bg">
                                <p>Zimbabwe Golf Association</p>
                            </div>
                            <div class="hero-tag gold-bg">
                                <p>{{$post->author}}</p>
                            </div>
                        </div>
                        <div class="hero-tag-row">
                            <div class="hero-tag red-bg">
                                <p>{{ \Carbon\Carbon::parse($post->created_at)->format('d M, Y') }}</p>
                            </div>
                            <div class="hero-tag black-bg">
                                <p>{{$post->category}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="news-carousel-slice frame">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{$post->image_caption}}">  
            </div>
      </div>
    </div>