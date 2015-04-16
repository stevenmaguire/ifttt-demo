<?php namespace App\Events;

use App\Events\Event;
use App\Tweet;

use Illuminate\Queue\SerializesModels;

class TweetWasPosted extends Event {

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        parent::__construct();
        $this->tweet = $tweet;
    }

}
