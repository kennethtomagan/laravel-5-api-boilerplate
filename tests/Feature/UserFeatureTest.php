<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Users\User;

class UserFeatureTest extends TestCase
{
    // use RefreshDatabase;
    
    /** @test  */
    public function it_can_list_all_users()
    {
        $users = factory(User::class, 3)->create();

        $this->get(route('users.index'), ['Authorization' => 'Bearer ' . $this->token])
            // ->assertJson(['name' => $users->first()->name, 'count' => 4]) // +1 user created in the TestCase.php
            ->assertStatus(200);
    }
    
}
