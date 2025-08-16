@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">

    <div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </div>
    <div class="mb-4">
        <h2>Add project</h2>
    </div>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        {{-- project Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">project Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        {{-- Client Name --}}
        <div class="mb-3">
            <label for="client" class="form-label">Client Name</label>
            <select name="client_id" id="client" class="form-select" required>
                <option value="">-- Choose Client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == old('client_id') ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status_id" id="status" class="form-select" required>
                <option value="">-- Choose Status --</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $status->id == old('status_id') ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Budget --}}
        <div class="mb-3">
            <label for="budget" class="form-label">Budget</label>
            <input type="number" name="budget" id="budget" class="form-control" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        {{-- Manager Name --}}
        <div class="mb-3">
            <label for="manager_id" class="form-label">Manager Name</label>
            <select name="manager_id" id="manager_id" class="form-select" required>
                <option value="">-- Choose Employee --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == old('manager_id') ? 'selected' : '' }}>
                        {{ $employee->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Start Date --}}
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        {{-- Expected End Date --}}
        <div class="mb-3">
            <label for="expected_end_date" class="form-label">Expected End Date</label>
            <input type="date" name="expected_end_date" id="expected_end_date" class="form-control" required>
        </div>

        {{-- Actual End Date --}}
        <div class="mb-3">
            <label for="actual_end_date" class="form-label">Actual End Date</label>
            <input type="date" name="actual_end_date" id="actual_end_date" class="form-control">
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="btn btn-primary">Add project</button>
        </div>
    </form>
</div>
@endsection
@section('js')
@endsection