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
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);
        $phone= 7775552112;
        

       $this->post(route('users.store'), [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password
        ]);

       
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
    }
}
