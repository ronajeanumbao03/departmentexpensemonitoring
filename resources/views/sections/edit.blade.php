<!-- resources/views/sections/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h2>Edit Section</h2>

<form action="{{ route('sections.update', $section->section_id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Section Name</label>
        <input type="text" name="section_name" value="{{ $section->section_name }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Year Level</label>
        <input type="text" name="year_level" value="{{ $section->year_level }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No. of Students</label>
        <input type="number" name="no_of_students" class="form-control" required>
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
