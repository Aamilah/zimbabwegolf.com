@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        @if ($paginator->hasPages())
    <nav class="flex justify-center my-1">
        <ul class="flex flex-wrap items-center gap-2 text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="w-10 h-10 text-sm text-white bg-black rounded-full flex items-center justify-center cursor-not-allowed"><i class="fa-solid fa-arrow-left"></i></span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 bg-[color:var(--red)] text-white rounded-full flex items-center justify-center hover:bg-red-700 transition">
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
                                <span class="w-10 h-10 bg-[color:var(--gold)] text-white rounded-full flex items-center justify-center">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="w-10 h-10 bg-[color:var(--green)] text-white rounded-full flex items-center justify-center hover:bg-green-700 transition">
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
                    <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 bg-[color:var(--red)] text-white rounded-full flex items-center justify-center text-sm hover:bg-red-700 transition">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="w-10 h-10 text-sm text-white bg-black rounded-full flex items-center justify-center cursor-not-allowed"><i class="fa-solid fa-arrow-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

@endif
