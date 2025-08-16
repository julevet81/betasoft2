@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Add client</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        {{-- client Name --}}
        <div class="mb-3">
            <label for="userid" class="form-label">client Name</label>
            <select name="user_id" id="userid" class="form-select" required>
              <option value="">-- Choose User --</option>
              @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }}>
                  {{ $user->name }}
                </option>
              @endforeach
            </select>
        </div>
        
        {{-- Submit --}}
        <div>
            <button type="submit" class="btn btn-primary">Add client</button>
        </div>
    </form>
</div>
@endsection
@section('js')
@endsection