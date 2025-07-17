    <div>
        <div class="z-50 absolute right-[100px] flex flex-row gap-2">
            <x-home-button/>
            <x-back-button />
        </div> 
        <div class="inverted-radius my-5 relative">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="frame-dot red-bg"></div>
                    <div class="frame-dot green-bg"></div>
                    <div class="frame-dot gold-bg"></div>
                </div>
                <div class="frame-wrapper">
                    {{$slot}}
                </div>
            </div>
        </div>
    </div>