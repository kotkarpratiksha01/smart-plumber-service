@extends('layouts.dashboard')

@section('dashboard-content')
<div class="p-6">
    <h1 class="text-2xl font-bold">User Dashboard</h1>
    <p>Welcome, {{ $user->name }}</p>
</div>
@endsection
