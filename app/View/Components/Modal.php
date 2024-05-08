<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $modalId;
    public $formId;
    public $inputHidden;

    public function __construct($modalId, $formId, $inputHidden = null)
    {
        $this->modalId = $modalId;
        $this->formId = $formId;
        $this->inputHidden = $inputHidden;
    }

    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
