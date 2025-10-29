<!-- resources/views/treasurers/create.blade.php -->
@extends('layouts.app')
@section('content')
<h2>Add Treasurer</h2>
<form action="{{ route('treasurers.store') }}" method="POST">
    @csrf

    <div class="mb-3"><label>Registered User</label>
        <select name="user_id" id="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name.' '.$user->last_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3"><label>Assign Section</label>
        <select name="section_assigned" class="form-control">
            @foreach($sections as $section)
                <option value="{{ $section->section_id }}">{{ $section->section_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3"><label>Year Level</label>
       <select name="section_assigned" class="form-control">
                @foreach($sections as $section)
                    <option value="{{ $section->section_id }}">{{ explode('-', $section->year_level)[1] ?? '' }}</option>
                @endforeach
        </select>
    </div>
    <button class="btn btn-success">Save</button>
</form>
@endsection
