@extends('layouts.main')

@section('header')
    Contacts
@endsection

@section('content')
<div class="rounded-xl bg-white p-5">
    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="prospect">
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
                            <input id="name" type="text" name="name" autocomplete="given-name" value="{{ old('name') }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="email" type="email" name="email" autocomplete="email" value="{{ old('email') }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="company_name" class="block text-sm/6 font-medium text-gray-900">Company name<span class="text-red-600">*</span></label>
                        <div class="mt-2">
                            <input id="company_name" type="text" name="company_name" value="{{ old('company_name') }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="border-b border-gray-900/10 -mx-5">
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('contacts.index') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
</div>
@endsection
