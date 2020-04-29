<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * @var array
     */
    private array $items;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table', [
            'items' => $this->items
        ]);
    }
}
