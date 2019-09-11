<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Hashing\BcryptHasher;
use App\Models\Users\User;

class AuthFeatureTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_returns_user_not_found_when_the_credentials_are_not_found_in_the_database()
    {
        $data = [
            'email' => 'john@doe.com',
            'password' => 'unknown'
        ];

        $this->post(route('login'), $data)
            ->assertJson(['error' => 'User not found.'])
            ->assertStatus(404);
    }


    /** @test */
    public function it_returns_an_error_when_the_email_and_password_combination_does_not_match()
    {
        $data = [
            'email' => 'john@doe.com',
            'password' => 'unknown'
        ];

        factory(User::class)->create([
            'email' => 'john@doe.com',
            'password' => (new BcryptHasher)->make('secret')
        ]);

        $this->post(route('login'), $data)
            ->assertJson(['error' => 'Email or password is incorrect. Authentication failed.'])
            ->assertStatus(401);
    }


    /** @test */
    public function it_can_create_jwt_token()
    {
        $data = [
            'email' => 'john@doe.com',
            'password' => 'secret'
        ];

        factory(User::class)->create([
            'email' => 'john@doe.com',
            'password' => (new BcryptHasher)->make('secret')
        ]);

        $this->post(route('login'), $data)
            ->assertJsonStructure(['token', 'user'])
            ->assertStatus(200);
    }

    
}
