<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{

    public string $type;
    public string $name;
    public string $label;
    public $value;

    /**
     * Create a new component instance.
     */
    public function __construct(string $type = 'text', string $name, string $label = '', $value = '')
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
