<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Field extends Component
{
    public $label;

    public $field;

    public $type;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $field, $type, $value = '')
    {
        $this->label = $label;
        $this->field = $field;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return \view('components.field');

    }
}
