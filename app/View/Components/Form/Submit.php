<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Submit extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $redirectRoute = '#',
        public $cancel = true,
        public $inputClass = ''
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.form.submit');
    }
}
