<?php

namespace App\Http\Controllers;

use App\Events\ProspectPromoted;
use App\Http\Requests\PromoteContactRequest;
use App\Models\Contact;

class PromoteContactController extends Controller
{

    public function edit(Contact $contact)
    {
        return view('contact.promote', compact('contact'));
    }

    public function update(PromoteContactRequest $request, Contact $contact)
    {
        $contact->fill([
            ...$request->validated(), 
            'status' => 'account'
        ]);
        $contact->save();
        event(new ProspectPromoted($contact));

        return redirect()
        ->route('contacts.show', $contact)
        ->with('success', 'Contact promoted successfully.');
    }

}
