<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests cannot access the contacts page', function () {
    $this->get(route('contacts.index'))
        ->assertRedirect(route('login'));
});

test('authenticated users can access the contacts page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('contacts.index'))
        ->assertOk();
});

//can access create contact page

//create create a contact

//check validation errors