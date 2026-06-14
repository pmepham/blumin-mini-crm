<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('guests cannot access the edit contacts page', function () {
    $contact = Contact::factory()->create();
    $this->get(route('contacts.edit', $contact))
        ->assertRedirect(route('login'));
});

test('authenticated users can access the edit contacts page', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create();

    $this->actingAs($user)
        ->get(route('contacts.edit', $contact))
        ->assertOk();
});

