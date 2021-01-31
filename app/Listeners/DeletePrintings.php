<?php

namespace App\Listeners;

use App\Events\AdmissionWasDeleted;
use App\Photos;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeletePrintings
{
    /**
     * Handle the event.
     *
     * @param  AdmissionWasDeleted  $event
     * @return void
     */
    public function handle(AdmissionWasDeleted $event)
    {
        $so = $event->admission->serviceorder;

        try {
            foreach ($so->serviceorderdetail as $sod) {
                foreach ($sod->printing as $item) {
                    $item->delete();
                }
                $sod->delete();
            }
            foreach ($event->admission->photos as $item) {
                $photo = app()->call('App\Http\Controllers\Attention\PhotosController@destroy', ['photo' => $item]);
            }
            $so->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
}
