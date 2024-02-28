<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownButton extends Component {

    public $icon;
    public $id;

    /**
     * Create a new component instance.
     */
    public function __construct($icon = '', $id = '') {
        $this->icon = $icon;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.dropdown-button');
    }
}
