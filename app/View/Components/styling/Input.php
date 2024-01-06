<?php

namespace App\View\Components\styling;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $label;
    public $name;

    /**
     * Create a new component instance.
     */
    public function __construct(string $label="Default Label",string $type="text",string $name="default_name")
    {
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.styling.input');
    }
}