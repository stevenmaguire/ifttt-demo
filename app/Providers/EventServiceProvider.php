<?php namespace App\Providers;

use App\Handlers\Events as Handlers;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Event::subscribe(Handlers\UserHandler::class);
        Event::subscribe(Handlers\PaymentHandler::class);
        Event::subscribe(Handlers\PlanHandler::class);
        Event::subscribe(Handlers\TweetHandler::class);
    }

}
