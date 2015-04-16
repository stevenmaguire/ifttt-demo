<?php namespace App\Handlers\Events;

use App\Events\PaymentWasProcessed;
use App\Services\ApiDemoService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendReceiptEmail {

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct(ApiDemoService $demo)
    {
        $this->demo = $demo;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentWasProcessed  $event
     * @return void
     */
    public function handle(PaymentWasProcessed $event)
    {
        $message = get_class() . ' triggered after ' . $event->getSummary($event->payment);
        $this->demo->push($message);
    }

}
