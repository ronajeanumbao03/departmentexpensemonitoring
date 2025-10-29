@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submit Remittance</h2>

    <form action="{{ route('remittances.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="event_id">Event</label>
            <select name="event_id" id="event_id" class="form-control" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Remittance</button>
    </form>

    <hr>

    <h4>Your Remittances</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Event</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($myRemittances as $r)
                <tr>
                    <td>{{ $r->event->name }}</td>
                    <td>{{ $r->amount }}</td>
                    <td>
                        @if($r->is_remitted==1)
                            <span class="badge bg-success">Acknowledged</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>{{ $r->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
