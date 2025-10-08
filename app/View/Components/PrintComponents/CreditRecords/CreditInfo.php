<?php

namespace App\View\Components\PrintComponents\CreditRecords;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreditInfo extends Component
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
        return view('components.print-components.credit-records.credit-info');
    }
}
