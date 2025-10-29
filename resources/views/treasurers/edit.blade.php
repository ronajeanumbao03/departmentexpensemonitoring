<!-- resources/views/treasurers/create.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Edit Treasurer</h2>
<form action="{{ route('treasurers.store') }}" method="POST">
    @csrf
    <div class="mb-3"><label>Name</label>
        <input type="text" name="treasurer_name" value="{{ $treasurer->treasurer_name }}" class="form-control" required>
    </div>
    <div class="mb-3"><label>Assign Section</label>
        <select name="section_assigned" class="form-control">
            @foreach($sections as $section)
                <option value="{{ $section->section_id }}">{{ $section->section_name }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
