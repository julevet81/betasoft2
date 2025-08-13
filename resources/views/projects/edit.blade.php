@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <div class="mb-4">
        <h2>Edit project</h2>
    </div>

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- project Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">project Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $project->name) }}"
                   class="form-control" required>
                   
        </div>
        {{-- Client Name --}}
        <div class="mb-3">
            <label for="client_id" class="form-label">Client Name</label>
            <select name="client_id" id="client_id" class="form-select" required>
                <option value="">-- Choose Client --</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" {{ $client->id == old('client_id', $project->client_id) ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- Status --}}
        <div class="mb-3">
            <label for="status_id" class="form-label">Status</label>
            <select name="status_id" id="status_id" class="form-select" required>
                <option value="">-- Choose Status --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ $status->id == old('status_id', $project->status_id) ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- Budget --}}
        <div class="mb-3">
            <label for="budget" class="form-label">Budget</label>
            <input type="number" name="budget" id="budget" class="form-control" value="{{ old('budget', $project->budget) }}" required>
        </div>
        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $project->description) }}</textarea>
        </div>
        {{-- Manager --}}
        <div class="mb-3">
            <label for="manager_id" class="form-label">Manager</label>
            <select name="manager_id" id="manager_id" class="form-select" required>
                <option value="">-- Choose Manager --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == old('manager_id', $project->manager_id) ? 'selected' : '' }}>
                        {{ $employee->user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- Start Date --}}
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}" required>
        </div>

        {{-- Expected End Date --}}
        <div class="mb-3">
            <label for="expected_end_date" class="form-label">Expected End Date</label>
            <input type="date" name="expected_end_date" id="expected_end_date" class="form-control" value="{{ old('expected_end_date', $project->expected_end_date) }}" required>
        </div>

        {{-- Actual End Date --}}
        <div class="mb-3">
            <label for="actual_end_date" class="form-label">Actual End Date</label>
            <input type="date" name="actual_end_date" id="actual_end_date" class="form-control" value="{{ old('actual_end_date', $project->actual_end_date) }}" >
        </div>



        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update project</button>
    </form>
</div>
@endsection
@section('js')
@endsection