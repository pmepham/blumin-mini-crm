<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('displays contact totals on the dashboard', function () {
    $user = User::factory()->create();
    Contact::factory()->count(3)->create([
        'status' => 'prospect',
    ]);

    Contact::factory()->count(2)->create([
        'status' => 'account',
    ]);

    $response = $this->actingAs($user)->get(route('dashboard.index'));

    $response
        ->assertOk()
        ->assertViewIs('dashboard.dashboard')
        ->assertViewHas('totals', function ($totals) {
            return (int) $totals->total_contacts === 5
                && (int) $totals->total_prospects === 3
                && (int) $totals->total_accounts === 2;
        });
});