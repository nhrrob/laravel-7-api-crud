<?php

namespace Tests\Feature\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    //Need to test assertJson : json return
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertSee('The email field is required.')
            ->assertSee('The password field is required.');
    }

    //Need to test json return
    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this
        ->actingAs($user, 'api')
        ->postJson('/api/products', ['title' => 'Sally']);

        $response
            ->assertStatus(201)
            ->assertSee('Sally');
    }
}
