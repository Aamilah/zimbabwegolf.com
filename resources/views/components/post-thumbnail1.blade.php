 @props(['blog', 'href' => '#'])
  
   <div class="bg-[color:var(--green)] text-white rounded-2xl overflow-hidden flex flex-col justify-between p-4 shadow-lg">
        <div class="rounded-xl overflow-hidden">
          <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{$blog->image_caption}}" class="w-full h-full object-cover">
        </div>
        <div class="mt-4">
          <h2 class="text-lg font-semibold leading-tight">
            {{$blog->headline}}
          </h2>
        </div>
        <div class="flex items-center justify-between mt-4">
          <div class="flex gap-2 text-xs">
            @php
                $created = \Carbon\Carbon::parse($blog->created_at);
            @endphp
            <span class="bg-[color:var(--red)] text-white px-3 py-2 rounded-full">{{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}</span>
            <span class="bg-[color:var(--gold)] text-black px-3 py-2 rounded-full">{{$blog->author}}</span>
            <span class="bg-[color:var(--black)] text-white px-3 py-2 rounded-full">{{$blog->category}}</span>
          </div>
          <a href="{{ $href }}">
            <div class="text-white text-2xl border-[1px] border-white 
                     transition-transform duration-[300ms] ease-[ease] 
                     px-3 py-2 rounded-[50%] border-solid 
                     hover:bg-[color:var(--red)] hover:scale-110">
              <i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
            </div>
          </a>
        </div>
    </div>