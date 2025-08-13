@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <div class="mb-4">
        <h2>Edit task</h2>
    </div>

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- task Title --}}
        <div class="mb-3">
            <label for="title" class="form-label">task Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
        </div>

        {{-- task Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">task Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $task->description) }}</textarea>
        </div>

        {{-- Project --}}
        <div class="mb-3">
            <label for="project_id" class="form-label">Project</label>
            <select name="project_id" id="project_id" class="form-select" required>
                <option value="">-- Choose Project --</option>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Employee --}}
        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                <option value="">-- Choose Employee --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id', $task->employee_id) == $employee->id ? 'selected' : '' }}>{{ $employee->user->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- task Status --}}
        <div class="mb-3">
            <label for="status_id" class="form-label">task Status</label>
            <select name="status_id" id="status_id" class="form-select" required>
                <option value="">-- Choose Status --</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->id }}" {{ old('status_id', $task->status_id) == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Estimated Hours --}}
        <div class="mb-3">
            <label for="estimated_hours" class="form-label">Estimated Hours</label>
            <input type="number" name="estimated_hours" id="estimated_hours" class="form-control" value="{{ old('estimated_hours', $task->estimated_hours) }}" required>
        </div>

        {{-- Hours Worked --}}
        <div class="mb-3">
            <label for="hours_worked" class="form-label">Hours Worked</label>
            <input type="number" name="hours_worked" id="hours_worked" class="form-control" value="{{ old('hours_worked', $task->hours_worked) }}" required>
        </div>

        {{-- Notes --}}
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control" required>{{ old('notes', $task->notes) }}</textarea>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update task</button>
    </form>
</div>
@endsection
@section('js')
@endsection