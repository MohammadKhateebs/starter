<?php

namespace App\Listeners;

use App\Events\OfferViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncCount
{


    public function handle(OfferViewer $event)
    {
      $this ->upateviwr($event->offerShow);
    }

    function upateviwr($viewoff)
    {
        $viewoff-> viewer = $viewoff -> viewer +1;
        $viewoff ->save();

    }
}
