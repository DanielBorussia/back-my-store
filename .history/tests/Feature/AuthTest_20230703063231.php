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
        $user = User::factory()->create([
            'password' => bcrypt('1234567891'),
            'email'=> 'Luis@gmail.com'
        ]);
        
        $response = $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => '1234567891'
        ]);
        dd($response->json());
        $response->assertStatus(200);
    
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
