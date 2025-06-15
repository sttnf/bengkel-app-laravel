<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;

class Dashboard extends Component
{
    public function __construct(
        public string $title = 'Dashboard',
        public ?string $subtitle = null
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.layouts.dashboard');
    }
}
