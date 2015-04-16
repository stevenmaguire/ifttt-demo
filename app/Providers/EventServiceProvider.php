<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserWasRegistered' => [
            'App\Handlers\Events\SendWelcomeEmail',
            'App\Handlers\Events\AssignDefaultPlan',
        ],
        'App\Events\PlanWasChanged' => [
            'App\Handlers\Events\ProcessPayment',
        ],
        'App\Events\PaymentWasProcessed' => [
            'App\Handlers\Events\SendReceiptEmail',
        ],
        'App\Events\TweetWasPosted' => [
            'App\Handlers\Events\RetweetMention',
        ],
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

        //
    }

}
