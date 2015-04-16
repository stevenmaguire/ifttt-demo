<?php namespace App\Handlers\Events;

use App\Payment;
use App\Events\PaymentWasProcessed;
use App\Events\PlanWasChanged;
use App\Services\ApiDemoService;

class PaymentHandler
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
    public function onPaymentProcessed(PaymentWasProcessed $event)
    {
        $this->sendReceiptEmail($event);
    }

    /**
     * Handle send receipt email
     */
    private function sendReceiptEmail(PaymentWasProcessed $event)
    {
        $message = __METHOD__.' triggered after ' . $event->getSummary($event->payment);
        $this->demo->push($message);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(PaymentWasProcessed::class, get_class().'@onPaymentProcessed');
    }
}
