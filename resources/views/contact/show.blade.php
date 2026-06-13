@extends('layouts.main')

@section('header')
    Contacts
@endsection

@section('content')
    <div class="rounded-xl bg-white p-5">
        <div class="flex items-center gap-4 mb-8">
            <div class="h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center">
                <span class="text-xl font-semibold text-gray-700">
                    JD
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

        <div class="border-b border-gray-900/10 -mx-5">
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('contacts.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Promote to Account</button>
        </div>
    </div>
@endsection
