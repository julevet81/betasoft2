@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
    <h2>Assign Permissions to {{ $user->name }}</h2>

   <div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </div>

    <form action="{{ route('users.permissions.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            @foreach($permissions as $permission)
                <div class="col-md-3">
                    <div class="form-check">
                        <input type="checkbox"
                               name="permissions[]"
                               value="{{ $permission->id }}"
                               class="form-check-input"
                               id="perm-{{ $permission->id }}"
                               {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Permissions</button>
    </form>
</div>
@endsection
@section('js')
@endsection