<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Url extends Component {

    public $fieldLabel;
    public $fieldRequired;
    public $fieldPlaceholder;
    public $fieldValue;
    public $fieldName;
    public $fieldId;
    public $fieldHelp;
    public $fieldReadOnly;
    public $popover;

    /**
     * Create a new component instance.
     */
    public function __construct($fieldLabel, $fieldName, $fieldId, $fieldRequired = false, $fieldPlaceholder = null, $fieldValue = null, $fieldHelp = null, $fieldReadOnly = false, $popover = null) {
        $this->fieldLabel = $fieldLabel;
        $this->fieldRequired = $fieldRequired;
        $this->fieldPlaceholder = $fieldPlaceholder;
        $this->fieldValue = $fieldValue;
        $this->fieldName = $fieldName;
        $this->fieldId = $fieldId;
        $this->fieldHelp = $fieldHelp;
        $this->fieldReadOnly = $fieldReadOnly;
        $this->popover = $popover;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.forms.url');
    }
}
