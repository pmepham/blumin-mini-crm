<?php

use App\Events\ProspectPromoted;
use App\Listeners\SendProspectPromotedNotification;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\ProspectPromotedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

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

test('prospect promoted listener sends notification', function () {
    Notification::fake();

    config(['crm.notification_email' => 'test@example.com']);

    $contact = Contact::factory()->create([
        'status' => 'account',
        'account_reference' => 'ACC-001',
        'territory_code' => 'NW1',
    ]);

    $listener = new SendProspectPromotedNotification();

    $listener->handle(new ProspectPromoted($contact));

    Notification::assertSentOnDemand(ProspectPromotedNotification::class);
});

test('when a prospect is promoted trigger email event', function () {
    Event::fake();

    $user = User::factory()->create();

    $contact = Contact::factory()->create([
        'status' => 'prospect',
    ]);

    $this->actingAs($user)
        ->put(route('contacts.promote.update', $contact), [
            'account_reference' => 'ABC123',
            'territory_code' => 'NW1',
        ]);

    Event::assertDispatched(ProspectPromoted::class);

    $this->assertDatabaseHas('contacts', [
        'id' => $contact->id,
        'status' => 'account',
        'account_reference' => 'ABC123',
        'territory_code' => 'NW1',
    ]);
});