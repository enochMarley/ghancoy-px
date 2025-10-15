<?php

namespace App\Observers;

use App\Helpers\HelperFunctions;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Log personnel creation
        HelperFunctions::logUserHistory(
            "Added user details with email {$user->email}"
        );
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        HelperFunctions::logUserHistory(
            "Updated user details with email {$user->email}"
        );
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        HelperFunctions::logUserHistory(
            "Deleted user details with email {$user->email}"
        );
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}