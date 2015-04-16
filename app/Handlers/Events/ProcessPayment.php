<?php namespace App\Handlers\Events;

use App\Payment;
use App\Events\PlanWasChanged;
use App\Events\PaymentWasProcessed;
use App\Services\ApiDemoService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class ProcessPayment {

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
     * @param  TweetWasPosted  $event
     * @return void
     */
    public function handle(PlanWasChanged $event)
    {
        $message = get_class() . ' triggered after ' . $event->getSummary($event->plan);
        $this->demo->push($message);
        $payment = new Payment(['plan' => $event->plan]);
        $response = event(new PaymentWasProcessed($payment));
    }

}
