<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('guests cannot access the contacts page', function () {
    $this->get(route('contacts.index'))
        ->assertRedirect(route('login'));
});