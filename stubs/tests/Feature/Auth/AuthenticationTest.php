<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;

test('login screen can be rendered')
    ->get('/login')
    ->assertStatus(200);

test('login credentials are being validated', function ($data, $errors) {
    $response = $this->post('/login', [
        'email' => data_get($data, 'email'),
        'password' => data_get($data, 'password'),
    ]);

    $response->assertSessionHasErrors($errors);

    $this->assertGuest();
})->with('login_validations');

test('users can authenticate with correct credentials', function () {
    $response = $this->post('/login', [
        'email' => User::factory()->create()->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});
