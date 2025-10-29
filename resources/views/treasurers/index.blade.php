<!-- resources/views/treasurers/index.blade.php -->
@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <div class="mt-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-5">Treasurers Management</h1>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    <a href="{{ route('treasurers.create') }}" class="btn btn-primary">Add Treasurer</a>
                </button>
    </div>

</div>
<div class="overflow-x-auto mt-3">
    <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
        <thead class="table-dark">
            <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Section</th>
                <th class="px-4 py-2">Actions</th></tr>
        </thead>
        <tbody>
        @foreach($treasurers as $treasurer)
            <tr class="border-t border-gray-200 dark:border-gray-700">
                <td class="px-4 py-2">{{ $treasurer->treasurer_id }}</td>
                <td class="px-4 py-2">{{ $treasurer->user->first_name.' '.$treasurer->user->last_name }}</td>
                <td class="px-4 py-2">{{ $treasurer->section->section_name }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('treasurers.edit', $treasurer->treasurer_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('treasurers.destroy', $treasurer->treasurer_id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
