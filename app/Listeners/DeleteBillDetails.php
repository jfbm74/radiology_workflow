<?php

namespace App\Listeners;

use App\Admission;
use App\Events\AdmissionWasDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteBillDetails
{

    /**
     * Handle the event.
     *
     * @param  AdmissionWasDeleted  $event
     * @return void
     */
    public function handle(AdmissionWasDeleted $event)
    {        
        foreach ($event->admission->billdetail as $item ) {
            $item->delete();
        }       
    }
}
