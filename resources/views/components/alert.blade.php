@props(['type' => 'success'])

@php
    $bg = $type === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700';
@endphp

@if (session($type))
    <div class="{{ $bg }} border px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">{{ ucfirst($type) }}!</strong>
        <span class="block sm:inline">{{ session($type) }}</span>
    </div>
@endif
