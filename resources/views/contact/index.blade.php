@extends('layouts.main')

@section('header')
    <div class="flex justify-between">
        <span>Contacts</span>
        <a href="{{ route('contacts.create') }}"
            class="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
            a Contact</a>
    </div>
@endsection

@section('content')
    <div class="rounded-xl bg-white p-5 mb-5">
        <form class="flex">
            <div class="w-[300px] me-3">
                <label for="status" class="block text-sm/6 font-medium text-gray-900">Status</label>
                <div class="mt-2">
                    <select id="status" type="text" name="status"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    <option value="">Select an option...</option>
                    <option value="prospect" @selected(request('status') === 'prospect')>Prospect</option>
                    <option value="account" @selected(request('status') === 'account')>Account</option>
                    </select>
                </div>
            </div>
            <button type="submit"
                class="self-end rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Filter</button>
        </form>
    </div>
    <div class="rounded-xl bg-white p-5">
        @if (session('success'))
            <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Contact
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Email
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Company name
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                        Action
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($contacts as $contact)
                    <tr class="hover:bg-gray-50">
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            {{ $contact->name }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                            {{ $contact->email }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                            {{ $contact->company_name }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                            {{ ucfirst($contact->status) }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-right text-sm">
                            <a href="{{ route('contacts.show', $contact) }}"
                                class="rounded-md bg-gray-400 px-3 py-1.5 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $contacts->links() }}
    </div>
@endsection
