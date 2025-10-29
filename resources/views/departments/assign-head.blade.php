@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white">Assign Treasurer to Department</h1>

        <form action="{{ route('departments.store-head') }}" method="POST">
            @csrf

            <!-- Department Selection -->
            <div class="mt-4">
                <label for="department_id" class="block text-sm font-medium text-gray-700">Select Department</label>
                <select name="department_id" id="department_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Select Head -->
            <div class="mt-4">
                <label for="user_id" class="block text-sm font-medium text-gray-700">Select Department Head</label>
                <select name="user_id" id="user_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    Assign Head
                </button>
            </div>
        </form>


    <!-- Table -->
    <div class="overflow-x-auto mt-3">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                    {{-- <th class="px-4 py-2">ID</th> --}}
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Full Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Address</th>
                    <th class="px-4 py-2">Gender</th>
                    <th class="px-4 py-2">Department</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        {{-- <td class="px-4 py-2">{{ $user->id }}</td> --}}
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}
                        </td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 capitalize">{{ $user->address }}</td>
                        <td class="px-4 py-2 capitalize">{{ $user->gender }}</td>
                        <td class="px-4 py-2 flex items-center gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700"
                                title="Edit">
                               {{--  <x-heroicon-o-pencil-square class="w-5 h-5" /> --}}
                            </a>
                            {{-- <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete" class="text-red-500 hover:text-red-700">
                                    <x-heroicon-o-trash class="w-5 h-5" />
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-4 py-4 text-gray-500 dark:text-gray-400">
                            No treasurers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>


@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endpush
