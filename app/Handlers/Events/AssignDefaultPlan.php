<?php namespace App\Handlers\Events;

use App\Plan;
use App\Events\PlanWasChanged;
use App\Events\UserWasRegistered;
use App\Services\ApiDemoService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class AssignDefaultPlan {

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
     * @param  UserWasRegistered  $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        $message = get_class() . ' triggered after ' . $event->getSummary($event->user);
        $this->demo->push($message);
        $plan = new Plan(['user' => $event->user]);
        $response = event(new PlanWasChanged($plan));
    }

}
