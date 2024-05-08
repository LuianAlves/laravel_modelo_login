<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $id;
    public $icon;
    public $name;
    public $label;
    public $type;
    public $col;
    public $set;
    public $placeholder;

    public function __construct($col = null, $icon = null, $set = null, $placeholder = null, $id, $name, $label, $type)
    {
        $this->col = $col;
        $this->icon = $icon;
        $this->set = $set;
        $this->placeholder = $placeholder;
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
