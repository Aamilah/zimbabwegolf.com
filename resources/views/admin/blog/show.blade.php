<x-admin :title="'Player Details'">
<x-alert type="success" />

<div>
    <div class="z-50 absolute right-16 flex flex-row gap-2">
        <a href="{{ route('admin.blog.edit', $blog->id) }}">
            <button class="inverted-corner-btn w-10 h-10 items-center justify-center">
                <i class="fa-solid fa-clipboard"></i>
            </button>
        </a>
        <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
        @csrf
        @method('DELETE')
            <button type="submit" class="trash-btn inverted-corner-btn w-10 h-10  rounded-full flex items-center justify-center">
                <i class="text-sm fa-solid fa-trash"></i>
            </button>
        </form>
        <x-home-button/>
        <x-back-button/>
    </div> 
    <div class="inverted-radius my-5 relative">
        <div class="inverted-radius-content">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <div class="frame-dot green-bg"></div>
                <div class="frame-dot gold-bg"></div>
                <div class="frame-dot red-bg"></div>
            </div>
            <div class="frame-wrapper">
                <x-blog-post :blog="$blog" />
            </div>
        </div>
    </div>
</div>


</x-admin>
