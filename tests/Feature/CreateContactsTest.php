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
test('authenticated user can access the contacts create page', function(){
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('contacts.create'))
        ->assertOk();
});

//create a contact
test('authenticated user can create a contact', function(){
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->post(route('contacts.store'), [
            'name' => 'John Smith',
            'email' => 'john@example.com',
            'company_name' => 'Asda',
            'status' => 'prospect',
        ]);

    $response->assertRedirect(route('contacts.index'));

    $this->assertDatabaseHas('contacts', [
        'name' => 'John Smith',
        'email' => 'john@example.com',
        'company_name' => 'Asda',
        'status' => 'prospect',
    ]);
});

//check validation errors
test('name email company name and status are required when creating a contact', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('contacts.store'), [])
        ->assertSessionHasErrors([
            'name',
            'email',
            'company_name',
            'status',
        ]);
});