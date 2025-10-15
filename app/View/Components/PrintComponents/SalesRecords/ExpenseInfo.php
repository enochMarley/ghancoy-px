<?php

namespace App\View\Components\PrintComponents\SalesRecords;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExpenseInfo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $expenseResults,
        public $expenseGrandTotal
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.print-components.sales-records.expense-info');
    }
}