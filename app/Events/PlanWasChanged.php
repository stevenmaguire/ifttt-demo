<?php namespace App\Events;

use App\Events\Event;
use App\Plan;

use Illuminate\Queue\SerializesModels;

class PlanWasChanged extends Event {

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Plan $plan)
    {
        parent::__construct();
        $this->plan = $plan;
    }

}
