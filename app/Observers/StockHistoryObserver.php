<?php

namespace App\Observers;

use App\Models\StockHistory;

class StockHistoryObserver
{
    /**
     * Handle the StockHistory "created" event.
     */
    public function created(StockHistory $stockHistory): void
    {
        //
    }

    /**
     * Handle the StockHistory "updated" event.
     */
    public function updated(StockHistory $stockHistory): void
    {
        //
    }

    /**
     * Handle the StockHistory "deleted" event.
     */
    public function deleted(StockHistory $stockHistory): void
    {
        //
    }

    /**
     * Handle the StockHistory "restored" event.
     */
    public function restored(StockHistory $stockHistory): void
    {
        //
    }

    /**
     * Handle the StockHistory "force deleted" event.
     */
    public function forceDeleted(StockHistory $stockHistory): void
    {
        //
    }
}
