<?php

namespace App\Observers;

use App\Helpers\HelperFunctions;
use App\Models\Stock;

class StockObserver
{
    /**
     * Handle the Stock "created" event.
     */
    public function created(Stock $stock): void
    {
        // log stock history
        $stock->histories()->create([
            'previous_quantity' => 0,
            'added_quantity' => $stock->quantity,
            'new_quantity' => $stock->quantity,
            'unit_cost_price' => $stock->unit_cost_price,
            'unit_selling_price' => $stock->unit_selling_price
        ]);

        // Log stock creation
        HelperFunctions::logUserHistory(
            "Added stock details with name {$stock->name}"
        );
    }

    /**
     * Handle the Stock "updating" event.
     */
    public function updating(Stock $stock): void
    {
        // update history if quantity changes
        if ($stock->isDirty('quantity')) {
            $previousQuantity = $stock->getOriginal('quantity');
            $newQuantity = $stock->quantity;
            $addedQuantity = $newQuantity - $previousQuantity;

            if ($addedQuantity > 0) {
                $stock->histories()->create([
                    'previous_quantity' => $previousQuantity,
                    'added_quantity' => $addedQuantity,
                    'new_quantity' => $newQuantity,
                    'unit_cost_price' => $stock->unit_cost_price,
                    'unit_selling_price' => $stock->unit_selling_price
                ]);
            }
        }
    }

    /**
     * Handle the Stock "updated" event.
     */
    public function updated(Stock $stock): void
    {
        // Log stock update
        HelperFunctions::logUserHistory(
            "Updated stock details with name {$stock->name}"
        );
    }

    /**
     * Handle the Stock "deleted" event.
     */
    public function deleted(Stock $stock): void
    {
        // Log stock deletion
        HelperFunctions::logUserHistory(
            "Deleted stock details with name {$stock->name}"
        );
    }

    /**
     * Handle the Stock "restored" event.
     */
    public function restored(Stock $stock): void
    {
        //
    }

    /**
     * Handle the Stock "force deleted" event.
     */
    public function forceDeleted(Stock $stock): void
    {
        //
    }
}