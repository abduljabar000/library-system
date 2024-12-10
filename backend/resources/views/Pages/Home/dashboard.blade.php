@extends('layouts.app')
@section('title', 'Book Management Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Book Management Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Books Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Total Books</h2>
            <div class="text-3xl font-bold text-blue-600">
                {{ $stats['counts']['books'] ?? '0' }}
            </div>
        </div>

        <!-- Workers Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Active Workers</h2>
            <div class="text-3xl font-bold text-green-600">
                {{ $stats['counts']['workers']['active'] ?? '0' }}
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
</div>
@endsection