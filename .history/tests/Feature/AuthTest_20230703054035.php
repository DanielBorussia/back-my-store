<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;
   
    public function test_user_login()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_register()
    {
        $name = $this->faker->name;
        $phone = '31024545';
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);
        echo $password;

        $response = $this->post('users', [
            'name' => $name,
            'email' => $email,
            'email' => $phone,
            'password' => $password
        ]);

       
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
    }
}
