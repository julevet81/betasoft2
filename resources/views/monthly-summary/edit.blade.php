@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <div class="mb-4">
        <h2>Edit montlhy-summary</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form action="{{ route('monthly-summary.update', $summary->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Employee --}}
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select name="employee_id" id="employee_id" class="form-select">
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == old('employee_id', $summary->employee_id) ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Month --}}
        <div class="mb-3">
            <label for="month" class="form-label">Month</label>
            <input type="month" name="month" id="month" class="form-control" value="{{ old('month', $summary->month) }}" required>
        </div>

        {{-- Total Hours --}}
        <div class="mb-3">
            <label for="total_hours" class="form-label">Total Hours</label>
            <input type="number" name="total_hours" id="total_hours" class="form-control" value="{{ old('total_hours', $summary->total_hours) }}" required>
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" rows="3">{{ old('notes', $summary->notes) }}</textarea>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update monthly-summary</button>
    </form>
</div>
@endsection
@section('js')
@endsection