@extends('layouts.main')

@section('header')
    <div class="flex justify-between">    
        <span>Contacts</span>
        <a href="{{ route('contacts.create') }}" class="flex justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create a Contact</a>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="mb-6 rounded-md border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif
    Contacts filter and paginated table
@endsection
