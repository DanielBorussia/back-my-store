<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function register_an_user_can_create_order(): void
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->post(route('orders.store', [
            'total' => 45000,
            "products" => array(
                "id" => 1
            )
        ]));

        $this->assertDataBaseHas('orders', [
            'total' => 45000
        ]);

    }
}
