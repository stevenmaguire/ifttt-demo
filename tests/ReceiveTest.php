<?php

use App\Events;
use App\Handlers\Events as Handlers;

class ReceiveTest extends TestCase {

    /**
     * Test Register User Method.
     *
     * @return void
     */
    public function testRegisterUser()
    {
        $response = $this->call('POST', route('receive.register-user'),['name' => 'Steven']);

        $body = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(is_array($body));
        $this->assertCount(4, $body);
        $this->assertContains(Events\UserWasRegistered::class, $body[0]);
        $this->assertContains(Handlers\UserHandler::class.'::sendWelcomeEmail', $body[0]);
        $this->assertContains(Events\UserWasRegistered::class, $body[1]);
        $this->assertContains(Handlers\UserHandler::class.'::assignDefaultPlan', $body[1]);
        $this->assertContains(Events\PlanWasChanged::class, $body[2]);
        $this->assertContains(Handlers\PlanHandler::class.'::processPayment', $body[2]);
        $this->assertContains(Events\PaymentWasProcessed::class, $body[3]);
        $this->assertContains(Handlers\PaymentHandler::class.'::sendReceiptEmail', $body[3]);
    }

    /**
     * Test Change Plan Method.
     *
     * @return void
     */
    public function testChangePlan()
    {
        $response = $this->call('POST', route('receive.change-plan'),['plan' => 'gold']);

        $body = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(is_array($body));
        $this->assertCount(2, $body);
        $this->assertContains(Events\PlanWasChanged::class, $body[0]);
        $this->assertContains(Handlers\PlanHandler::class.'::processPayment', $body[0]);
        $this->assertContains(Events\PaymentWasProcessed::class, $body[1]);
        $this->assertContains(Handlers\PaymentHandler::class.'::sendReceiptEmail', $body[1]);
    }

    /**
     * Test Post Tweet Method Retweets When Username Mentioned.
     *
     * @return void
     */
    public function testPostTweetRetweet()
    {
        $response = $this->call('POST',
            route('receive.post-tweet'),
            ['author' => '@mbsings', 'body' => 'I love @stevenmaguire', 'username' => '@stevenmaguire']);

        $body = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(is_array($body));
        $this->assertCount(1, $body);
        $this->assertContains(Events\TweetWasPosted::class, $body[0]);
        $this->assertContains(Handlers\TweetHandler::class.'::retweetMention', $body[0]);
    }

    /**
     * Test Post Tweet Method Does Not Retweet When Username Not Mentioned.
     *
     * @return void
     */
    public function testPostTweetNoRetweet()
    {
        $response = $this->call('POST',
            route('receive.post-tweet'),
            ['author' => '@mbsings', 'body' => 'I love @churchofbolton', 'username' => '@stevenmaguire']);

        $body = json_decode($response->getContent());

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEmpty($body);
    }

}
