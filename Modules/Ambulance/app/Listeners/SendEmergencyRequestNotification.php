<?php

namespace Modules\Ambulance\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Ambulance\Events\EmergencyRequestCreated;
use Modules\Ambulance\Notifications\EmergencyRequestNotification;
use Modules\Auth\Models\User;

class SendEmergencyRequestNotification
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
    public function handle(EmergencyRequestCreated $event): void
    {
        $employees = User::all();

        foreach ($employees as $employee) {
            $employee->notify(new EmergencyRequestNotification($event->request));
        }
    }
}
