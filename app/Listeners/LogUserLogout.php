<?php

namespace App\Listeners;

use App\Helpers\HelperFunctions;
use Illuminate\Auth\Events\Logout as IlluminateAuthEventsLogout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserLogout
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(IlluminateAuthEventsLogout $event): void
    {
        HelperFunctions::logUserHistory("Logged out of the system");
    }
}
