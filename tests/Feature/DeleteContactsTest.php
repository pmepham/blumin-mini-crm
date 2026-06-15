<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can delete a contact', function () {
    $user = User::factory()->create();

    $contact = Contact::factory()->create([
        'name' => 'John Smith',
    ]);

    $this->actingAs($user)
        ->delete(route('contacts.destroy', $contact))
        ->assertRedirect(route('contacts.index'))
        ->assertSessionHas('success', 'Contact deleted successfully.');

    $this->assertDatabaseMissing('contacts', [
        'id' => $contact->id,
    ]);
});
