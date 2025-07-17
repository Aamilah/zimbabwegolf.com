@props([
    'title',
    'content',
    'active' => false // default collapsed
])

<div class="bg-white rounded-xl border overflow-hidden shadow-sm" x-data="{ expanded: {{ $active ? 'true' : 'false' }} }">
  <button
    @click="expanded = !expanded"
    class="w-full px-6 py-4 flex justify-between items-center font-semibold text-left hover:bg-[color:var(--gold)] ease-in-out duration-300"
>
    <span>{{ $title }}</span>
    <span class="bg-[color:var(--green)] rounded-full w-6 h-6 flex items-center justify-center text-white text-xs transition ease-in-out duration-150"
          :class="{ 'rotate-180': expanded }">
      <i class="fas fa-chevron-down"></i>
    </span>
  </button>
  <div x-show="expanded" x-collapse class="px-6 pb-4 text-sm text-gray-600 leading-relaxed transition ease-in-out duration-150'">
    {{ $content }}
  </div>
</div>
