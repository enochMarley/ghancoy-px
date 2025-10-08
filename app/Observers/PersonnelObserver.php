<?php

namespace App\Observers;

use App\Helpers\HelperFunctions;
use App\Models\Personnel;

class PersonnelObserver
{


    /**
     * Handle the Personnel "creating" event.
     */
    public function creating(Personnel $personnel): void
    {
        // set the personnel type based on the rank
        $personnel->type = $personnel->rank->type;
    }

    /**
     * Handle the Personnel "created" event.
     */
    public function created(Personnel $personnel): void
    {
        // Log personnel creation
        HelperFunctions::logUserHistory(
            "Created personnel details with service number {$personnel->service_number}"
        );
    }

    /**
     * Handle the Personnel "updated" event.
     */
    public function updated(Personnel $personnel): void
    {
        // Log personnel update
        HelperFunctions::logUserHistory(
            "Updated personnel details with service number {$personnel->service_number}"
        );
    }

    /**
     * Handle the Personnel "deleted" event.
     */
    public function deleted(Personnel $personnel): void
    {
        // Log personnel creation
        HelperFunctions::logUserHistory(
            "Deleted personnel details with Service Number {$personnel->service_number}"
        );
    }

    /**
     * Handle the Personnel "restored" event.
     */
    public function restored(Personnel $personnel): void
    {
        //
    }

    /**
     * Handle the Personnel "force deleted" event.
     */
    public function forceDeleted(Personnel $personnel): void
    {
        //
    }
}
