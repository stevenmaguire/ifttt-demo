<?php namespace App\Handlers\Events;

use App\Plan;
use App\Events\PaymentWasProcessed;
use App\Events\PlanWasChanged;
use App\Events\UserWasRegistered;
use App\Services\ApiDemoService;

class UserHandler
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
     * Handle assign default plan
     */
    private function assignDefaultPlan(UserWasRegistered $event)
    {
        $message = __METHOD__.' triggered after ' . $event->getSummary($event->user);
        $this->demo->push($message);

        $plan = new Plan(['user' => $event->user]);
        $response = event(new PlanWasChanged($plan));
    }

    /**
     * Handle user registration event
     */
    public function onUserRegistration(UserWasRegistered $event)
    {
        $this->sendWelcomeEmail($event);
        $this->assignDefaultPlan($event);
    }

    /**
     * Handle send welcome email
     */
    private function sendWelcomeEmail(UserWasRegistered $event)
    {
        $message = __METHOD__.' triggered after ' . $event->getSummary($event->user);
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
        $events->listen(UserWasRegistered::class, get_class().'@onUserRegistration');
    }
}
