<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanListUsers()
    {
        factory(User::class)->create();

        $response = $this->call('GET', 'api/users');
        
        $response->assertStatus(200);
    }
}
