<div class="tournament-card">
    <div class="tournament-card-header">
        <h3>{{ $tournament->tournament_title }}</h3>
        <div class="tournament-tag">
            <p>{{ $tournament->presenter }}</p>
        </div>
    </div>

    <div class="tournament-card-body">
        <div class="tournament-card-detail">
            <div class="tournament-card-icon gold-bg">
                <img src="{{ asset('icons/location.png') }}" alt="location icon">
            </div>
            <div class="tournament-card-text">
                <p>{{ $tournament->courseDetail->name }}</p>
            </div>
        </div>

        <div class="tournament-card-detail">
            <div class="tournament-card-icon green-bg">
                <img src="{{ asset('icons/map-icon.png') }}" alt="map icon">
            </div>
            <div class="tournament-card-text">
                <p>{{ $tournament->location_code ?? '—' }}</p>
            </div>
        </div>

        <div class="tournament-card-detail">
            <div class="tournament-card-icon red-bg">
                <img src="{{ asset('icons/calender-icon.png') }}" alt="calendar icon">
            </div>
            <div class="tournament-card-text">
                <p>{{ \Carbon\Carbon::parse($tournament->start_date)->format('d M Y') }} - {{ \Carbon\Carbon::parse($tournament->end_date)->format('d M Y') }}</p>
            </div>
        </div>

        <div class="tournament-card-detail">
            <div class="tournament-card-icon black-bg">
                <img src="{{ asset('icons/warning-icon.png') }}" alt="warning icon">
            </div>
            <div class="tournament-card-text">
                <p>Entries Close On: {{ \Carbon\Carbon::parse($tournament->entries_close)->format('d M Y') }}</p>
            </div>
        </div>

        {{-- You can adjust the table to pull from dynamic JSON or DB if needed --}}
        <table class="custom-table">
            <tbody>
                <tr>
                    <td rowspan="2">Ladies</td>
                    <td>Championship</td>
                    <td>54 Holes : {{ $tournament->ladies_champ_handicap }}</td>
                    <td>${{ $tournament->ladies_champ_fee }}</td>
                </tr>
                <tr>
                    <td>Net</td>
                    <td>36 Holes : {{ $tournament->ladies_net_handicap }}</td>
                    <td>${{ $tournament->ladies_net_fee }}</td>
                </tr>
                <tr>
                    <td rowspan="2">Men</td>
                    <td>Championship</td>
                    <td>54 Holes : {{ $tournament->men_champ_handicap }}</td>
                    <td>${{ $tournament->men_champ_fee }}</td>
                </tr>
                <tr>
                    <td>Net</td>
                    <td>36 Holes : {{ $tournament->men_net_handicap }}</td>
                    <td>${{ $tournament->men_net_fee }}</td>
                </tr>
            </tbody>
        </table>

        <div class="tournament-tag--gold">
            <p>Contact Us: {{ $tournament->contact_email ?? 'admin@zga.org.zw' }}</p>
        </div>
    </div>
</div>
