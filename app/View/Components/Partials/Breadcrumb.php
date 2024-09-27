<?php

namespace App\View\Components\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component {
    public string $heading;
    public array $breadcrumbs;
    /**
     * Create a new component instance.
     */
    public function __construct(string $heading = "Default", array $breadcrumbs = []) {
        $this->heading = $heading;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('partials.breadcrumb');
    }
}
