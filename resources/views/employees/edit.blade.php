@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit employee</h2>

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- employee Name --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">employee Name</label>
            <input type="text" name="user_id" id="user_id"
                   value="{{ old('name', $employee->user->name) }}"
                   class="form-control" required>
                   
        </div>
        {{-- Post --}}
        <div class="mb-3">
            <label for="post" class="form-label">Post</label>
            <select name="post_id" id="post" class="form-select" required>
                <option value="">-- Choose Post --</option>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}" {{ $post->id == old('post_id', $employee->post_id) ? 'selected' : '' }}>
                        {{ $post->title }}
                    </option>
                @endforeach
            </select>
        </div>
        
        {{-- Contract Type --}}
        <div class="mb-3">
            <label for="contract_type_id" class="form-label">Contract Type</label>
            <select name="contract_type_id" id="contract_type_id" class="form-select" required>
                <option value="">-- Choose Contract Type --</option>
                @foreach ($contractTypes as $contractType)
                    <option value="{{ $contractType->id }}" {{ $contractType->id == old('contract_type_id', $employee->contract_type_id) ? 'selected' : '' }}>
                        {{ $contractType->name }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- Start Date --}}
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $employee->start_date) }}" required>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update employee</button>
    </form>
</div>
@endsection
@section('js')
@endsection