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
            ->orderBy('created_at', 'DESC')
            ->paginate(10)->withQueryString();
        return view('contact.index', compact('contacts', 'status'));
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequest $request)
    {
        Contact::create($request->validated());
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
    }

    public function update(Request $request, Contact $contact)
    {
    }

    public function destroy(Contact $contact)
    {
    }
}
