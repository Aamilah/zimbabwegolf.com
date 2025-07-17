<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Players;

class PlayerCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $player;

    public function __construct(Players $player)
    {
        $this->player = $player;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.player-card');
    }
}
