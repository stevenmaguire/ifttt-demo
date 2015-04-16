<?php namespace App\Handlers\Events;

use App\Tweet;
use App\Events\TweetWasPosted;
use App\Services\ApiDemoService;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RetweetMention {

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
    public function handle(TweetWasPosted $event)
    {
        $tweet = $event->tweet;

        if ($this->tweetMentionsUser($tweet)) {
            $message = get_class() . ' triggered after ' . $event->getSummary($tweet);
            $this->demo->push($message);
        }
    }

    /**
     * Check if Tweet mentions user
     *
     * @param  Tweet $tweet
     *
     * @return bool
     */
    private function tweetMentionsUser(Tweet $tweet)
    {
        return isset($tweet->username)
            && isset($tweet->body)
            && strpos($tweet->body, $tweet->username);
    }

}
