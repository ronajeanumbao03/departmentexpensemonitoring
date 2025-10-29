@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-3xl font-semibold text-gray-800 dark:text-white mb-5">Submit Remittance</h2>
    <form action="{{ route('remittances.store') }}" method="POST">
        @csrf
        <input type="hidden" name="treasurer_id" value="{{ Auth::user()->id }}">
       <div class="mb-3">
            <label for="event_id">Event</label>
            <select name="event_id" id="event_id" class="form-control" required>
                @foreach($events as $event)
                    <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control">
        </div>
        <div class="mb-3">
            <label>Remittance Date</label>
            <input type="date" name="remittance_date" class="form-control">
        </div>
        <div class="mb-3">
            <label>Remarks</label>
            <input type="text" name="remarks" class="form-control">
        </div>
        <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    Save
                </button>
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    <a href="{{ route('remittances.index') }}" class="btn btn-warning">Cancel</a>
                </button>

        </div>
        {{-- <button type="submit" class="btn btn-success">Save</button> --}}
        {{-- <a href="{{ route('remittances.index') }}" class="btn btn-secondary">Cancel</a> --}}
    </form>


</div>
@endsection
