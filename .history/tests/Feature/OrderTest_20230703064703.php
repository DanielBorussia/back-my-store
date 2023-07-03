<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_create_order()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->post(route('orders.store', [
            "idUser" => $user->id, 
            "total" => 45000, 
            "products" => [
                ["id" => 1 ],
                ["id" => 2 ] 
            ] 
        ]));

        $this->assertDataBaseHas('orders', [
            'total' => 45000
        ]);

    }

    public function test_user_consult_orders()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create([
            'id' => 1
        ]);
        $this->actingAs($user);

        $response = $this->getJson(route('orders.show', $user->id));
        dd($response->json());
        $this->assertDataBaseHas('orders', [
            'total' => 45000
        ]);

    }
}
