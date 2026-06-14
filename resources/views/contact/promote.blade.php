@extends('layouts.main')

@section('header')
    Promote a Contact
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
    <form action="{{ route('contacts.promote.update', $contact) }}" method="POST">
        @csrf
        @if($contact->exists)
            @method('PUT')
        @endif
        <div class="space-y-12">
            <div class="pb-5">
                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 p-4 text-sm text-red-700">
                    {{ $errors->first() }}
                    </div>
                @endif
                <p>Are you sure you want to promote this prospect? </p>
                <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="account_reference" class="block text-sm/6 font-medium text-gray-900">Account reference<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="account_reference" type="text" name="account_reference" value="{{ old('account_reference') }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="territory_code" class="block text-sm/6 font-medium text-gray-900">Territory code<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="territory_code" type="text" name="territory_code" value="{{ old('territory_code') }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="border-b border-gray-900/10 -mx-5">
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ $contact->exists ? route('contacts.show', $contact) : route('contacts.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>
@endsection
