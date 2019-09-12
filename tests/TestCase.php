<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;
use JWTAuth;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication,RefreshDatabase;

    /**
     * @var $token
     */
    protected $token;

    /**
     * @var $user
     */
    protected $user;


    /**
     * Set up the test
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->faker = Faker::create();

        $this->user = factory(User::class)->create();

        $this->token = JWTAuth::fromUser($this->user);
    }
}
