<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component {

    public $multiple;
    public $fieldLabel;
    public $fieldRequired;
    public $fieldName;
    public $fieldId;
    public $popover;

    /**
     * Create a new component instance.
     */
    public function __construct($fieldName, $fieldId, $fieldRequired = false, $fieldLabel = null, bool $multiple = false, bool $search = false, bool $alignRight = false, $popover = null) {
        $this->fieldName = $fieldName;
        $this->fieldLabel = $fieldLabel;
        $this->fieldId = $fieldId;
        $this->fieldRequired = $fieldRequired;
        $this->multiple = $multiple;
        $this->popover = $popover;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.forms.select');
    }
}
