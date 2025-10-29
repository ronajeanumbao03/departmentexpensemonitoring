@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            @if ($isAdmin)
                All Department Budgets
            @else
                Budget for Department: {{ $department->name ?? '' }}
            @endif
        </h1>
    </div>

    @if ($isAdmin)
        <div class="flex justify-between mb-4">
            <a href="{{ route('departments.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-2">
                <x-heroicon-o-plus-circle class="w-5 h-5" />
                <span class="text-sm">Create Department</span>
            </a>
            @isset($department)
                <a href="{{ route('departments.create-budget', $department->id) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 flex items-center gap-2">
                    <x-heroicon-o-plus-circle class="w-5 h-5" />
                    <span class="text-sm">Create Budget</span>
                </a>
            @endisset
        </div>

        <div class="space-y-4">
            <p class="text-gray-600 dark:text-gray-400">List of all department budgets:</p>
            <table class="min-w-full bg-white dark:bg-gray-800 rounded shadow">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2">Department Name</th>
                        <th class="px-4 py-2">Annual Budget</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr class="border-t border-gray-200 dark:border-gray-700">
                            <td class="px-4 py-2">{{ $department->name }}</td>
                            <td class="px-4 py-2">₱{{ number_format($department->annual_budget, 2) }}</td>
                            <td class="px-4 py-2 flex gap-2 items-center">
                                <a href="{{ route('departments.budget.edit', $department->id) }}" title="Edit Budget"
                                    class="text-blue-500 hover:text-blue-700">
                                    <x-heroicon-s-pencil-square class="w-5 h-5" />
                                </a>

                                <form action="{{ route('departments.budget.delete', $department->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" title="Delete Budget"
                                        class="delete-btn text-red-600 hover:text-red-800">
                                        <x-heroicon-s-trash class="w-5 h-5" />
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="space-y-4">
            <p class="text-gray-600 dark:text-gray-400">Department budget details:</p>
            <div>
                <h2 class="text-lg font-semibold">Budget Details</h2>
                <p><strong>Annual Budget:</strong> ${{ number_format($department->annual_budget, 2) }}</p>
            </div>
        </div>
    @endif

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Delete Confirmation --}}
        <script>
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will permanently delete the department and its budget.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Yes, delete it!',
                        background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#fff',
                        color: document.documentElement.classList.contains('dark') ? '#f9fafb' : '#000',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>

        {{-- Success Toast --}}
        @if (session('success'))
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif
    @endpush
@endsection
