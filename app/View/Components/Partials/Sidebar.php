<?php

namespace App\View\Components\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Sidebar extends Component {
    public string $current;
    /**
     * Create a new component instance.
     */
    public function __construct() {
        $this->current = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('partials.sidebar');
    }
}
