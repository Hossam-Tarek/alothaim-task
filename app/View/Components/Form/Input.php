<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $name,
        public $type = 'text',
        public $value = null,
        public $label = true,
        public $inputClass = '',
        public $labelClass = '')
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
