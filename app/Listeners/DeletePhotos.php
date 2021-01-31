<?php

namespace App\Listeners;

use App\Events\AdmissionWasDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeletePhotos
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdmissionWasDeleted  $event
     * @return void
     */
    public function handle(AdmissionWasDeleted $event)
    {
        $event->admission->photos->delete();
    }
}
