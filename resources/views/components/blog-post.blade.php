<div>
    <div class="headline">
        <div class="headline-content">
            <h2>{{ $blog->headline }}</h2>
        </div>
        <div class="flex flex-wrap gap-1 justify-center items-center">
            <a href="{{route('blog')}}">
                <div class="hero-tag black-bg">
                    <div class="flex"><i class="fas fa-home mr-10"></i><p>Back</p></div>
                </div>
            </a>
            <div class="hero-tag red-bg">
                {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
            </div>
            <div class="hero-tag gold-bg">
                {{$blog->author}}
            </div>
            <div class="hero-tag green-bg">
                {{$blog->category}}
            </div>
        </div>
    </div>
    <div class="blog-image overflow-hidden rounded-[20px] w-full h-screen my-4 relative">
        <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="Story 1"
            class="w-full h-full object-cover" />

        <!-- Caption & Credit -->
        <div class="absolute bottom-0 left-2 text-gray-500 text-sm p-2 w-full text-left">
            {{$blog->image_caption}}
            <span class="block text-xs opacity-80">Photo credit: {{$blog->image_credit}}</span>
        </div>
    </div>

    <div class="post-content">
        <div class="blog-article px-4 py-8 prose prose-neutral lg:prose-lg">
            {!! $blog->content !!}
        </div>
    </div>
</div>
