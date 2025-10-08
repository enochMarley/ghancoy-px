<?php

namespace App\Observers;

use App\Models\Rank;

class RankObserver
{
    /**
     * Handle the Rank "created" event.
     */
    public function created(Rank $rank): void
    {
        //
    }

    /**
     * Handle the Rank "updated" event.
     */
    public function updated(Rank $rank): void
    {
        //
    }

    /**
     * Handle the Rank "deleted" event.
     */
    public function deleted(Rank $rank): void
    {
        //
    }

    /**
     * Handle the Rank "restored" event.
     */
    public function restored(Rank $rank): void
    {
        //
    }

    /**
     * Handle the Rank "force deleted" event.
     */
    public function forceDeleted(Rank $rank): void
    {
        //
    }
}
