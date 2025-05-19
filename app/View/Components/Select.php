<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{

    public string $name;
    public string $label;
    public array $options;

    /**
     * Create a new component instance.
     */
    public function __construct(string $name, array $options, string $label = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
