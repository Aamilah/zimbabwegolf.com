@props(['title' => 'Dashboard'])

@php
    $user = Auth::user();
@endphp

@if ($user && $user->department === 'staff')
    <x-admin-nav>
        {{ $slot }}
    </x-admin-nav>
@elseif ($user && $user->department === 'player')
    <x-player-admin-nav>
        {{ $slot }}
    </x-player-admin-nav>
@elseif ($user && $user->department === 'tournament_official')
    <x-tournament-official-admin-nav>
        {{ $slot }}
    </x-tournament-official-admin-nav>
@else
    <x-app-layout>
        {{ $slot }}
    </x-app-layout>
@endif

{{-- In your top bar: --}}
<div class="text-lg font-semibold text-gray-700">
    {{ $title }}
</div>
