@props(['blog', 'href' => '#'])

<div class="rounded-2xl border shadow-sm overflow-hidden p-2 flex flex-col justify-between mb-4">
  <div class="rounded-xl overflow-hidden">
    <img src="{{ asset('storage/' . $blog->thumbnail) }}"
         alt="{{ $blog->image_caption }}"
         class="w-full h-64 object-cover">
  </div>

  <div class="post-headline">
    {{ $blog->headline }}
  </div>

  <div class="flex items-center justify-between mt-3 text-[0.7rem]">
    <div class="flex gap-1">
      <span class="bg-[color:var(--red)] text-white px-3 py-2 rounded-full">
        {{ \Carbon\Carbon::parse($blog->created_at)->format('d M, Y') }}
      </span>
      <span class="bg-[color:var(--gold)] text-black px-2 py-2 rounded-full">
        {{ $blog->author }}
      </span>
    </div>

    <a href="{{ $href }}">
      <div class="text-xl border border-black px-2 py-1 rounded-full
                  hover:bg-[color:var(--green)] hover:text-white hover:scale-110
                  transition-transform duration-300 ease-in-out">
        <i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i>
      </div>
    </a>
  </div>
</div>
