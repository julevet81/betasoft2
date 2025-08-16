@extends('dashboard.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">User Information</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
    <h2>{{ trans('Dashboard/auth.info_user') }}</h2>

    <div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userData as $key => $value)
                <tr>
                    <td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
                    <td>
                        @if($key === 'image')
                            <img src="{{ asset('storage/' . $value) }}" alt="User Image" width="80" height="80">
                        @elseif($key === 'password')
                            ****  {{-- Don’t show plain password! --}}
                        @else
                            {{ $value }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
				
@endsection
@section('js')
@endsection