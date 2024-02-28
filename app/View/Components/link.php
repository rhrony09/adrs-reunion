<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component {

    public $link;
    public $icon;
    public $newTab;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link = '', $icon = '', $newTab = false) {
        $this->link = $link;
        $this->icon = $icon;
        $this->newTab = $newTab;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render() {
        return view('components.link');
    }
}
