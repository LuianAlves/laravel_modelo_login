<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadioInput extends Component
{
    public $id;
    public $name;
    public $label;
    public $type;

    public function __construct($id, $name, $label, $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.radio-input');
    }
}
