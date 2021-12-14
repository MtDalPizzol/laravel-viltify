<?php

use App\Models\User;

dataset('login_validations', [
    'missing email on request' => [
        ['password' => 'password'],
        ['email']
    ],
    'email that\'s not a string' => [
        [
            'email' => 123,
            'password' => 'password'
        ],
        ['email']
    ],
    'invalid email' => [
        [
            'email' => 'wrong@',
            'password' => 'password'
        ],
        ['email']
    ],
    'missing password on request' => [
        fn () => [
            'email' => User::factory()->create()->email
        ],
        ['password']
    ],
    'password that isn\'t a string' => [
        fn () => [
            'email' => User::factory()->create()->email,
            'password' => 123
        ],
        ['password']
    ],
    'wrong password' => [
        fn () => [
            'email' => User::factory()->create()->email,
            'password' => 'wrongpassword'
        ],
        ['email']
    ],
    'unregistered user' => [
        [
            'email' => 'missing@myemail.host',
            'password' => 'password'
        ],
        ['email']
    ]
]);

dataset('register_validations', [
    'missing name on request' => [
        fn () => userData()->except('name')->all(),
        ['name']
    ],
    'empty name' => [
        fn () => userData()->put('name', '')->all(),
        ['name']
    ],
    'null name' => [
        fn () => userData()->put('name', null)->all(),
        ['name']
    ],
    'name that\'s not a string' => [
        fn () => userData()->put('name', 123)->all(),
        ['name']
    ],
    'name that\'s too long' =>  [
        fn () => userData()->put('name', Faker\Factory::create()->sentence(255))->all(),
        ['name']
    ],
    'missing email on request' => [
        fn () => userData()->except('email')->all(),
        ['email']
    ],
    'empty email' => [
        fn () => userData()->put('email', '')->all(),
        ['email']
    ],
    'null email' => [
        fn () => userData()->put('email', null)->all(),
        ['email']
    ],
    'email that\'s not a string' => [
        fn () => userData()->put('email', 123)->all(),
        ['email']
    ],
    'email that\'s too long' => [
        fn () => userData()->put('email', Faker\Factory::create()->sentence(255))->all(),
        ['email']
    ],
    'invalid email' => [
        fn () => userData()->put('email', 'invalid@')->all(),
        ['email']
    ],
    'email that is already registered' => [
        function () {
            $user = User::factory()->create();
            return collect($user->only($user->getFillable()))->put('password_confirmation', 'password')->all();
        },
        ['email']
    ],
    'missing password on request' => [
        fn () => userData()->except('password')->all(),
        ['password']
    ],
    'empty password' => [
        fn () => userData()->put('password', '')->all(),
        ['password']
    ],
    'null password' => [
        fn () => userData()->put('password', null)->all(),
        ['password']
    ],
    'password that\'s too short' => [
        fn () => userData()->put('password', 'a12')->all(),
        ['password']
    ],
    'missing password_confirmation on request' => [
        fn () => userData()->except('password_confirmation')->all(),
        ['password_confirmation']
    ],
    'empty password_confirmation' =>  [
        fn () => userData()->put('password_confirmation', '')->all(),
        ['password_confirmation']
    ],
    'null password_confirmation' =>  [
        fn () => userData()->put('password_confirmation', null)->all(),
        ['password_confirmation']
    ],
    'password and password_confirmation mismatch' => [
        fn () => userData()->put('password_confirmation', 'mismatchpassword')->all(),
        ['password', 'password_confirmation']
    ]
]);
