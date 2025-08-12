@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Add employee</h2>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        {{-- Employee Name --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">Employee Name</label>
            <select name="user_id" id="user_id" class="form-select" required>
              <option value="">-- Choose User --</option>
              @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }}>
                  {{ $user->name }}
                </option>
              @endforeach
            </select>
        </div>
        {{-- Post --}}
        <div class="mb-3">
            <label for="post" class="form-label">Post</label>
            <select name="post_id" id="post" class="form-select" >
                <option value="">-- Choose Post --</option>
                @foreach($posts as $post)
                    <option value="{{ $post->id }}" {{ $post->id == old('post_id') ? 'selected' : '' }}>
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
                    <option value="{{ $contractType->id }}" {{ $contractType->id == old('contract_type_id') ? 'selected' : '' }}>
                        {{ $contractType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Start Date --}}
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        {{-- Submit --}}
        <div>
            <button type="submit" class="btn btn-primary">Add employee</button>
        </div>
    </form>
</div>
@endsection
@section('js')
@endsection