<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {   
        $status = $request->status;
        $contacts = Contact::query()
            ->when($request->filled('status'), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)->withQueryString();
        return view('contact.index', compact('contacts', 'status'));
    }

    public function create()
    {
        $contact = new Contact();
        return view('contact.create', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        Contact::create([
            ...$request->validated(), 
            'status' => 'prospect'
        ]);
        return redirect()
        ->route('contacts.index')
        ->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contact.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contact.create', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {   
        $contact->fill($request->validated());
        $contact->save();
        return redirect()
        ->route('contacts.show', $contact)
        ->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()
        ->route('contacts.index')
        ->with('success', 'Contact deleted successfully.');
    }

}
