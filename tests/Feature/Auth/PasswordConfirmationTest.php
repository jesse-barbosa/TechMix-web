<?php

use App\Models\Store;

test('confirm password screen can be rendered', function () {
    $user = Store::factory()->create();

    $response = $this->actingAs($user)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {
    $user = Store::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'password',
    ]);

    $response->assertRedirect();
    $response->assertSessionHasNoErrors();
});

test('password is not confirmed with invalid password', function () {
    $user = Store::factory()->create();

    $response = $this->actingAs($user)->post('/confirm-password', [
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors();
});
