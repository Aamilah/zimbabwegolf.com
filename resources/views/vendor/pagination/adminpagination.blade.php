@if ($paginator->hasPages())
    <nav aria-label="Page navigation example" class="flex items-center justify-between">
                    <div>
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>
        @if ($paginator->hasPages())
    <nav class="flex justify-end my-1">
        <ul class="flex flex-wrap items-center gap-2 text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="w-10 h-10 text-sm text-gray-400 bg-gray-100 rounded-full flex items-center justify-center cursor-not-allowed"><i class="fa-solid fa-arrow-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center hover:bg-green-700 transition">
                        <i class="fa-solid fa-arrow-left text-sm"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="px-4 py-2 text-sm text-gray-400">{{ $element }}</span>
                    </li>
                @endif

                {{-- Page Number Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center hover:bg-green-700 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm hover:bg-green-700 transition">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="w-10 h-10 text-sm text-gray-400 bg-gray-100 rounded-full flex items-center justify-center cursor-not-allowed"><i class="fa-solid fa-arrow-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@endif
