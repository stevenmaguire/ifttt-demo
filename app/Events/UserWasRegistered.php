<?php namespace App\Events;

use App\Events\Event;
use App\User;

use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event {

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();
        $this->user = $user;
    }

}
