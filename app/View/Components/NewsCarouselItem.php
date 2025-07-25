<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Blog;

class NewsCarouselItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $post;

    public function __construct(Blog $blog)
    {
        $this->post = $blog;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-carousel-item');
    }
}
