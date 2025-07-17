<div 
    x-data="{ show: false }"
    x-on:show-loading.window="show = true"
    x-on:hide-loading.window="show = false"
    x-show="show"
    x-transition.opacity
    class="fixed inset-0 bg-green-200 bg-opacity-50 flex flex-col items-center justify-center z-50"
    style="display: none;"
>
    <div class="relative w-16 h-16">
        <div class="absolute w-3 h-3 bg-[color:var(--red)] rounded-full animate-loader-dot" style="top: 0; left: 50%; transform: translate(-50%, 0);"></div>
        <div class="absolute w-3 h-3 bg-[color:var(--gold)] rounded-full animate-loader-dot" style="top: 50%; right: 0; transform: translate(0, -50%); animation-delay: 0.15s;"></div>
        <div class="absolute w-3 h-3 bg-[color:var(--green)] rounded-full animate-loader-dot" style="bottom: 0; left: 50%; transform: translate(-50%, 0); animation-delay: 0.3s;"></div>
        <div class="absolute w-3 h-3 bg-[color:var(--black)] rounded-full animate-loader-dot" style="top: 50%; left: 0; transform: translate(0, -50%); animation-delay: 0.45s;"></div>
    </div>
    <div class="text-white text-lg mt-4">Processing...</div>
</div>
