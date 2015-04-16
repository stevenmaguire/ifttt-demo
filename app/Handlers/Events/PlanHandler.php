<?php namespace App\Handlers\Events;

use App\Payment;
use App\Events\PaymentWasProcessed;
use App\Events\PlanWasChanged;
use App\Services\ApiDemoService;

class PlanHandler
{
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
     * Handle payment processed event
     */
    public function onPlanChange(PlanWasChanged $event)
    {
        $this->processPayment($event);
    }

    /**
     * Handle user login events.
     */
    public function processPayment(PlanWasChanged $event)
    {
        $message = __METHOD__.' triggered after ' . $event->getSummary($event->plan);
        $this->demo->push($message);

        $payment = new Payment(['plan' => $event->plan]);
        $response = event(new PaymentWasProcessed($payment));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(PlanWasChanged::class, get_class().'@onPlanChange');
    }
}
