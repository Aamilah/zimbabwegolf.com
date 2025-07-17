<div class="inverted-radius my-5 relative">
    <div class="inverted-radius-content">
        <div class="flex flex-wrap items-center gap-2 mb-4">
            <div class="search-tab">
                <input type="text" placeholder="Search" class="search-input table-search" />
                <span class="search-icon"><i class="fas fa-search"></i></span>
            </div>
        {{-- <button class="filter-tab">Download <i class="fa-solid fa-download ml-2"></i></button> --}}
        </div>
        {{$slot}}
    </div>
</div>