@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    <div class="mb-4">
        <h2>Add Monthly Summary</h2>
    </div>

    <form action="{{ route('monthly-summary.store') }}" method="POST">
        @csrf

        {{-- Employee --}}
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select name="employee_id" id="employee_id" class="form-select">
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Month --}}
        <div class="mb-3">
            <label for="month" class="form-label">Month</label>
            <input type="month" name="month" id="month" class="form-control" required>
        </div>

        {{-- Total Hours --}}
        <div class="mb-3">
            <label for="total_hours" class="form-label">Total Hours</label>
            <input type="number" name="total_hours" id="total_hours" class="form-control" required>
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="btn btn-primary">Add Monthly Summary</button>
        </div>
    </form>
</div>
@endsection
@section('js')
@endsection