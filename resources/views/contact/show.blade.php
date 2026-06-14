@extends('layouts.main')

@section('header')
    <div class="flex justify-between">
        Contact
        <a href="{{ route('contacts.index') }}" class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
    </div>
@endsection

@section('content')
    <div class="rounded-xl bg-white p-5">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center">
                <span class="text-xl font-semibold text-gray-700">
                    {{ $contact->initials }}
                </span>
            </div>

            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    {{ $contact->name }}
                </h1>
                <p class="text-sm text-gray-500">
                    Contact Profile
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 mb-6">
            <div>
                <div class="text-sm font-medium text-gray-500">Email</div>
                <div class="mt-1 text-sm text-gray-900">{{ $contact->email }}</div>
            </div>

            <div>
                <div class="text-sm font-medium text-gray-500">Status</div>
                <div class="mt-1">
                    <span
                        class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700">
                        {{ ucfirst($contact->status) }}
                    </span>
                </div>
            </div>

            <div>
                <div class="text-sm font-medium text-gray-500">Company</div>
                <div class="mt-1 text-sm text-gray-900">{{ $contact->company_name }}</div>
            </div>
        </div>
        @if($contact->status === 'account')
        <div class="border-b border-gray-900/10 -mx-5"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 my-6">
            <div>
                <div class="text-sm font-medium text-gray-500">Account reference</div>
                <div class="mt-1 text-sm text-gray-900">{{ $contact->account_reference }}</div>
            </div>
            <div>
                <div class="text-sm font-medium text-gray-500">Territory code</div>
                <div class="mt-1 text-sm text-gray-900">{{ $contact->territory_code }}</div>
            </div>

        </div>
        @endif
        

        <div class="border-b border-gray-900/10 -mx-5"></div>
        <div class="mt-6 flex items-center justify-end gap-x-3">
            <a href="{{ route('contacts.edit', $contact) }}"
                                class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Edit
                            </a>
            @if($contact->status === 'prospect')
            <a href="{{ route('contacts.promote.edit', $contact) }}"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Promote to Account</a>
            @endif
        </div>
    </div>
@endsection
