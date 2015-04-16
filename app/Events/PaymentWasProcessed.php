<?php namespace App\Events;

use App\Events\Event;
use App\Payment;

use Illuminate\Queue\SerializesModels;

class PaymentWasProcessed extends Event {

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        parent::__construct();
        $this->payment = $payment;
    }

}
