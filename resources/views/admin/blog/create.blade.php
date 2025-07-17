<x-admin :title="'Create A Blog Post'">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <div>
        <div class="inverted-radius my-5 relative">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="frame-dot green-bg"></div>
                    <div class="frame-dot gold-bg"></div>
                    <div class="frame-dot red-bg"></div>
                </div>
                <div class="frame-wrapper">
                <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100 rounded mb-4">
                            @foreach ($errors->all() as $error)
                                <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mb-4">
                        <label class="form-label">Headline</label>
                        <input type="text" name="headline" class="form-input" value="{{ old('headline') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-input" value="{{ old('category') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-input" value="{{ old('author') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Author ID</label>
                        <input type="text" name="author_id" class="form-input" value="{{ old('author_id') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Image</label>
                        <input
                            type="file"
                            name="thumbnail"
                            accept="image/*"
                            id="thumbnail"
                            class="form-input
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-[200px] file:border-0
                                file:text-sm file:font-semibold
                                file:bg-green-500 file:text-white
                                hover:file:bg-green-700
                                focus:outline-none focus:ring focus:border-green"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Image Caption</label>
                        <input type="text" name="image_caption" class="form-input" value="{{ old('image_caption') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Image Credit</label>
                        <input type="text" name="image_credit" class="form-input" value="{{ old('image_credit') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Content</label>
                        <textarea id="summernote" name="content" class="form-input">{!! old('content') !!}</textarea>
                    </div>

                    <div class="my-4">
                        <button class="green-red-btn">
                            Post Article <span><i class="fa-solid fa-plus"></i></span>
                        </button>
                    </div>
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
