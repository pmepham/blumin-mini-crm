
@extends('layouts.main')

@section('header')
    Dashboard
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <div class="rounded-xl bg-white p-5">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $totals->total_contacts }}</h1> Contacts
    </div>

    <div class="rounded-xl bg-white p-5">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $totals->total_prospects }}</h1> Prospects
    </div>

    <div class="rounded-xl bg-white p-5">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $totals->total_accounts }}</h1> Accounts
    </div>
</div>
@endsection