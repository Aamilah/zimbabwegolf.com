<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Tournaments; // Ensure you have the correct model namespace
class TournamentCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $tournament;

    public function __construct(Tournaments $tournament)
    {
        $this->tournament = $tournament;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tournament-card');
    }
}
