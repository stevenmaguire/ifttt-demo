<?php namespace App\Handlers\Events;

use App\Tweet;
use App\Events\TweetWasPosted;
use App\Services\ApiDemoService;

class TweetHandler
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
     * Handle tweet posted event
     */
    public function onTweetPosted(TweetWasPosted $event)
    {
        $this->retweetMention($event);
    }

    /**
     * Handle busines logic for retweeting.
     */
    private function retweetMention(TweetWasPosted $event)
    {
        $tweet = $event->tweet;

        if ($this->tweetMentionsUser($tweet)) {
            $message = __METHOD__.' triggered after ' . $event->getSummary($tweet);
            $this->demo->push($message);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(TweetWasPosted::class, get_class().'@onTweetPosted');
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
