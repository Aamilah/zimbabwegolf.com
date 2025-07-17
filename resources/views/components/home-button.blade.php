@php
    $user = Auth::user();

    if ($user->department === 'staff') {
        $backUrl = route('admin.admin-dashboard');
    } elseif ($user->department === 'player') {
        $backUrl = route('admin.player-dashboard');
    } elseif ($user->department === 'tournament_official') {
        $backUrl = route('admin.tournament-official-dashboard');
    } else {
        $backUrl = route('admin'); // fallback
    }
@endphp

<a href="{{ $backUrl }}">
    <button class="inverted-corner-btn w-10 h-10 items-center justify-center"><i class="fa-solid fa-home"></i>
    </button>
</a>
