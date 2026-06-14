<?php

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test('guests cannot access the edit contacts page', function () {
    $contact = Contact::factory()->create();
    $this->get(route('contacts.edit', $contact))
        ->assertRedirect(route('login'));
});