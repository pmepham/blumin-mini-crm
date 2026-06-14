<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests cannot access the promote contact page', function () {
    $contact = Contact::factory()->create();
    $this->get(route('contacts.promote.edit', $contact))
        ->assertRedirect(route('login'));
});

test('authenticated users can access the promote contact page', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create();

    $this->actingAs($user)
        ->get(route('contacts.promote.edit', $contact))
        ->assertOk();
});

test('authenticated user can promote a contact', function () {
    $user = User::factory()->create();
    $contact = Contact::factory()->create([
        'name' => 'John Smith',
        'email' => 'john@example.com',
        'company_name' => 'Asda',
        'status' => 'prospect',
    ]);

    $response = $this
        ->actingAs($user)
        ->put(route('contacts.promote.update', $contact), [
            'account_reference' => 'TestRef',
            'territory_code' => 'M50',
        ]);

    $response->assertRedirect(route('contacts.show', $contact));

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'status' => 'account',
        'account_reference' => 'TestRef',
        'territory_code' => 'M50',
    ]);
});