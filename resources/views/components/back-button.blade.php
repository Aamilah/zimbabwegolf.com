@php
    if (url()->previous() !== url()->current()) {
        $backUrl = url()->previous();
    } else {
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
    }
@endphp

<a href="{{ $backUrl }}">
    <button class="inverted-corner-btn flex items-center gap-2 px-3">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Back</span>
    </button>
</a>
