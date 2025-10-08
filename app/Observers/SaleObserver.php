<?php

namespace App\Observers;

use App\Enum\SaleType;
use App\Helpers\HelperFunctions;
use App\Models\Sale;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */
    public function created(Sale $sale): void
    {
        if ($sale->stock) {
            $sale->stock->decrement('quantity', $sale->quantity);
        }

        // Log stock update
        HelperFunctions::logUserHistory(
            "Sold quantity {$sale->quantity} of {$sale->stock->name} - {$sale->sale_type->value}"
        );
    }

    /**
     * Handle the Sale "updating" event.
     */
    public function updating(Sale $sale): void
    {
        // remove the personnel id if it is being changed from credit to cash
        if ($sale->isDirty('sale_type')) {
            if ($sale->sale_type == SaleType::CASH) {
                $sale->personnel_id = null;
            }
        }
    }

    /**
     * Handle the Sale "updated" event.
     */
    public function updated(Sale $sale): void
    {
        // Log stock update
        HelperFunctions::logUserHistory(
            "Updated sale details of {$sale->stock->name}"
        );
    }

    /**
     * Handle the Sale "deleted" event.
     */
    public function deleted(Sale $sale): void
    {
        // Log stock deletion
        HelperFunctions::logUserHistory(
            "Deleted sale details of {$sale->stock->name}"
        );
    }

    /**
     * Handle the Sale "restored" event.
     */
    public function restored(Sale $sale): void
    {
        //
    }

    /**
     * Handle the Sale "force deleted" event.
     */
    public function forceDeleted(Sale $sale): void
    {
        //
    }
}
