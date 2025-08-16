@extends('dashboard.layouts.master')
@section('css')
@endsection

@section('content')
				
<div class="container">
    <h2>Edit Role</h2>
    <div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </div>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Role Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $role->name) }}"
                   class="form-control" required>
        </div>

        {{-- Permissions --}}
        <div class="mb-3">
            <label class="form-label">Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input type="checkbox"
                                   name="permissions[]"
                                   value="{{ $permission->id }}"
                                   class="form-check-input"
                                   id="perm-{{ $permission->id }}"
                                   {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
@section('js')
@endsection