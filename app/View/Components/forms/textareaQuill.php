<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaQuill extends Component {

    public $fieldLabel;
    public $fieldValue;
    public $fieldName;
    public $fieldId;
    public $popover;

    /**
     * Create a new component instance.
     */
    public function __construct($fieldLabel, $fieldName, $fieldId, $fieldValue = null, $popover = null) {
        $this->fieldLabel = $fieldLabel;
        $this->fieldValue = $fieldValue;
        $this->fieldName = $fieldName;
        $this->fieldId = $fieldId;
        $this->popover = $popover;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string {
        return view('components.forms.textarea-quill');
    }
}
