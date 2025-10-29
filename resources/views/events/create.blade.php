<!-- resources/views/events/create.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Add Event</h2>
<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div class="mb-3"><label>Name</label>
        <input type="text" name="event_name" class="form-control" required>
    </div>
    <div class="mb-3"><label>Description</label>
        <textarea name="event_description" class="form-control"></textarea>
    </div>
    <div class="mb-3"><label>Amount</label>
        <input type="number" name="amount" class="form-control"></input>
    </div>
    <div class="mb-3"><label>Section Applied To</label>
        <select name="applied_to" class="form-control">
            @foreach($sections as $section)
                <option value="{{ $section->section_id }}">{{ $section->section_name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
