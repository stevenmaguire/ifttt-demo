<?php namespace App\Http\Controllers;

use App\Plan;
use App\Tweet;
use App\User;
use App\Events\PlanWasChanged;
use App\Events\TweetWasPosted;
use App\Events\UserWasRegistered;
use App\Services\ApiDemoService;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    public function __construct(ApiDemoService $demo)
    {
        $this->middleware('guest');
        $this->demo = $demo;
    }

    public function postRegisterUser(Request $request)
    {
        $user = new User($request->input());

        $response = event(new UserWasRegistered($user));

        return $this->demo->fetch();
    }

    public function postChangePlan(Request $request)
    {
        $plan = new Plan($request->input());

        $response = event(new PlanWasChanged($plan));

        return $this->demo->fetch();
    }

    public function postPostTweet(Request $request)
    {
        $tweet = new Tweet($request->input());

        $response = event(new TweetWasPosted($tweet));

        return $this->demo->fetch();
    }
}
