<?php

namespace App\View\Components\PrintComponents\PersonnelCredit;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PersonnelCreditInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $result,
        public $grandTotal,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.print-components.personnel-credit.personnel-credit-info');
    }
}
