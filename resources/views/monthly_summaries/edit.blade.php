@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')

<div class="container">
    <h2>{{ isset($monthlySummary) ? 'Edit' : 'Add' }} Monthly Summary</h2>

    <form method="POST" action="{{ isset($monthlySummary) ? route('monthly-summary.update', $monthlySummary) : route('monthly-summary.store') }}">
        @csrf
        @if(isset($monthlySummary))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ isset($monthlySummary) && $monthlySummary->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Month</label>
            <input type="month" name="month" class="form-control" value="{{ $monthlySummary->month ?? old('month') }}" required>
        </div>

        <div class="mb-3">
            <label>Total Hours</label>
            <input type="number" step="0.01" name="total_hours" class="form-control" value="{{ $monthlySummary->total_hours ?? old('total_hours') }}" required>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ $monthlySummary->notes ?? old('notes') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('monthly-summary.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@section('js')
@endsection