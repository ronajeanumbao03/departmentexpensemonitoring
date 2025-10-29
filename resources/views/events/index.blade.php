<!-- resources/views/events/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <div class="mt-6">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Events Management</h1>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
                </button>
    </div>

</div>

<table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
    <thead class="table-dark">
        <tr class="bg-gray-100 dark:bg-gray-700 text-left">
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Amount</th>
            <th class="px-4 py-2">Section</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr class="border-t border-gray-200 dark:border-gray-700">
            <td class="px-4 py-2">{{ $event->event_id }}</td>
            <td class="px-4 py-2">{{ $event->event_name }}</td>
            <td class="px-4 py-2">{{ $event->event_description }}</td>
            <td class="px-4 py-2">{{ $event->amount }}</td>
            <td class="px-4 py-2">{{ $event->section->section_name }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('events.edit', $event->event_id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('events.destroy', $event->event_id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
