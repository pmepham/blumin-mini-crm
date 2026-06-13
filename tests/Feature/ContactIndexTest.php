<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays contacts on the index page', function () {
    $user = User::factory()->create();

    Contact::factory()->create([
        'name' => 'Peter Test',
        'email' => 'peter@example.com',
        'company_name' => 'text company',
        'status' => 'prospect',
    ]);

    $response = $this->actingAs($user)->get(route('contacts.index'));

    $response->assertOk()
        ->assertViewIs('contact.index')
        ->assertViewHas('contacts')
        ->assertSee('Peter Test')
        ->assertSee('peter@example.com');
});

it('filters contacts by status', function () {
    $user = User::factory()->create();
    Contact::factory()->create([
        'name' => 'Prospect',
        'email' => 'test@example.com',
        'company_name' => 'text company',
        'status' => 'prospect',
    ]);

    Contact::factory()->create([
        'name' => 'Account',
        'email' => 'test@example.com',
        'company_name' => 'text company',
        'status' => 'account',
    ]);

    $response = $this->actingAs($user)->get(route('contacts.index', [
        'status' => 'account',
    ]));

    $response->assertOk()
        ->assertViewIs('contact.index')
        ->assertViewHas('status', 'account')
        ->assertSee('Account');

    $response->assertViewHas('contacts', function ($contacts) {
        return $contacts->pluck('name')->contains('Account')
            && ! $contacts->pluck('name')->contains('Prospect');
    });
});