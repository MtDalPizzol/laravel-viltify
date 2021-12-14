<?php

use App\Providers\RouteServiceProvider;

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

test('registration data is being validated', function ($data, $errors) {
    $response = $this->post(route('register'), $data);

    $response->assertSessionHasErrors($errors);

    $this->assertGuest();
})->with('register_validations');

test('new users can register', function () {
    $response = $this->postJson('/register', userData()->all());

    $response->assertRedirect(RouteServiceProvider::HOME);

    $this->assertAuthenticated();
});
