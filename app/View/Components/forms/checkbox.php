<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class checkbox extends Component {

    public $fieldLabel;
    public $fieldName;
    public $fieldId;
    public $checked;
    public $fieldValue;
    public $popover;

    /**
     * Create a new component instance.
     */
    public function __construct($fieldLabel, $fieldName, $fieldId, $checked = false, $fieldValue = null, $popover = null) {
        $this->fieldLabel = $fieldLabel;
        $this->checked = $checked;
        $this->fieldValue = $fieldValue;
        $this->fieldName = $fieldName;
        $this->fieldId = $fieldId;
        $this->popover = $popover;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.forms.checkbox');
    }
}
