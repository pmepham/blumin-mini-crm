@extends('layouts.main')

@section('header')
    <div class="flex justify-between">
        {{ $contact->exists ? 'Update a Contact' : 'Create a Contact'}}
        <a href="{{ route('contacts.index') }}" class="rounded-md bg-gray-400 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back</a>
    </div>
@endsection

@section('content')
<div class="rounded-xl bg-white p-5">
    <form action="{{ $contact->exists ? route('contacts.update', $contact) : route('contacts.store') }}" method="POST">
        @csrf
        @if($contact->exists)
            @method('PUT')
        @endif
        <div class="space-y-12">
            <div class="pb-5">
                <h2 class="text-base/7 font-semibold text-gray-900">Contact Information</h2>
                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                    {{ $errors->first() }}
                    </div>
                @endif
                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Full name<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="name" type="text" name="name" autocomplete="given-name" value="{{ old('name', $contact->name) }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="email" type="email" name="email" autocomplete="email" value="{{ old('email', $contact->email) }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="company_name" class="block text-sm/6 font-medium text-gray-900">Company name<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="company_name" type="text" name="company_name" value="{{ old('company_name', $contact->company_name) }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($contact->status === 'account')
        <div class="border-b border-gray-900/10 -mx-5"></div>
        <div class="my-5 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="account_reference" class="block text-sm/6 font-medium text-gray-900">Account reference<span class="text-red-600">*</span></label>
                <div class="mt-2">
                    <input id="account_reference" type="text" name="account_reference" value="{{ old('account_reference', $contact->account_reference) }}"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="territory_code" class="block text-sm/6 font-medium text-gray-900">Territory code<span class="text-red-600">*</span></label>
                <div class="mt-2">
                    <input id="territory_code" type="text" name="territory_code" value="{{ old('territory_code', $contact->territory_code) }}"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>
        </div>
        @endif
        <div class="border-b border-gray-900/10 -mx-5">
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ $contact->exists ? route('contacts.show', $contact) : route('contacts.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>

@if($contact->exists)
    <div class="rounded-xl bg-white p-5 mt-5">
        <form action="{{ route('contacts.destroy', $contact) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
        </form>
    </div>
@endif
@endsection
