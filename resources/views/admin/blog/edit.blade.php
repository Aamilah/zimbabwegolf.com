<x-admin :title="'Edit An Article'">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <div>
        <div class="z-50 absolute right-16 flex flex-row gap-2">
            <x-home-button/>
            <x-back-button/>
        </div>
        <div class="inverted-radius relative">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="frame-dot green-bg"></div>
                    <div class="frame-dot gold-bg"></div>
                    <div class="frame-dot red-bg"></div>
                </div>
                <div class="frame-wrapper">
                    <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="form-label">Headline</label>
                            <input type="text" name="headline" class="form-input" value="{{ old('headline', $blog->headline) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-input" value="{{ old('category', $blog->category) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Author</label>
                            <input type="text" name="author" class="form-input" value="{{ old('author', $blog->author) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Author ID</label>
                            <input type="text" name="author_id" class="form-input" value="{{ old('author_id', $blog->author_id) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="image_path" class="form-label">Image</label>

                            @php
                                $image = $blog->thumbnail 
                                    ? asset('storage/' . $blog->thumbnail)
                                    : asset('images/default-player.jpg'); // <- path to your default image
                            @endphp

                            <div class="mb-2">
                                <img src="{{ $image }}" 
                                    alt="{{ $blog->headline }}" 
                                    class="w-20 h-20 rounded-full object-cover border" />
                            </div>

                            <input
                                type="file"
                                name="image_path"
                                id="image_path"
                                accept="image/*"
                                class="form-input
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-[200px] file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-500 file:text-white
                                    hover:file:bg-green-700
                                    focus:outline-none focus:ring focus:border-green"
                            >
                        </div>
                        <div class="form-group z-50">
                            <label class="form-label">Content</label>
                            <textarea id="summernote" name="content" class="form-input">{!! old('content', $blog->content) !!}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Image Caption</label>
                            <input type="text" name="image_caption" class="form-input" value="{{ old('image_caption', $blog->image_caption) }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Image Credit</label>
                            <input type="text" name="image_credit" class="form-input" value="{{ old('image_credit', $blog->image_credit) }}" required>
                        </div>

                        <div class="my-4"><button class="green-red-btn">Update Player <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <script>
        $(document).ready(function () {
                $('#summernote').summernote({
                    placeholder: 'Write your blog post...',
                    tabsize: 2,
                    height: 300,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            });

    </script>
</x-admin>
