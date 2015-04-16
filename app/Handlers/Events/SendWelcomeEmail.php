<?php namespace App\Handlers\Events;

use App\Events\UserWasRegistered;
use App\Services\ApiDemoService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendWelcomeEmail {

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
    }

}
