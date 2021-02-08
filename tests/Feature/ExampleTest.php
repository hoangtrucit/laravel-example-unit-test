<?php

namespace Tests\Feature;

use App\Classes\Firebase;
use Mockery;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class ExampleTest extends TestCase
{
    private static $mockFirebase;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$mockFirebase = Mockery::mock(Firebase::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDemoRoute()
    {
        $response = $this->get('/get-user-test');
        $response->assertStatus(200);
    }

    public function testNotification()
    {
        // expect result
        $expectRresult = [
            "userId"    => 2,
            "id"        => 100,
            "title"     => "this is my message",
            "completed" => false,
        ];

        self::$mockFirebase->shouldReceive("pushNotification")
                           ->andReturn($expectRresult);

        // make instance for constructor injection
        $this->app->instance('App\Classes\Firebase', self::$mockFirebase);

        // make class Notifications
        $mockNotifications = $this->app->make('App\Classes\Notifications');

        $result = $mockNotifications->sendMessageToGroup("groups", "hello message");

        assertEquals($expectRresult, $result);

        // reset all mocks
        Mockery::close();
    }
}
