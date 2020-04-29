<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Date extends Component
{
    public $field;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $value = '')
    {
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
<input type="text" value="{{ $value }}" id="{{ $field }}" name="{{ $field }}"  class="form-control datepicker @error($field) is-invalid @enderror"/>
blade;
    }
}
