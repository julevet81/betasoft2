@extends('dashboard.layouts.master')
@section('css')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back!</h2>
						  <p class="mg-b-0">Sales monitoring dashboard template.</p>
						</div>
					</div>
					
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
	<div class="row row-sm">
		<!--div-->
		<div class="col-xl-12">
			<div class="card mg-b-20">
	
	
				<div class="container">
					<h2>Monthly Work Summaries</h2>
					<a href="{{ route('monthly-summary.create') }}" class="btn btn-primary mb-3">Add Summary</a>
	
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
								<th>Employee</th>
								<th>Month</th>
								<th>Total Hours</th>
								<th>Notes</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($summaries as $summary)
							<tr>
								<td>{{ $summary->employee->user->name }}</td>
								<td>{{ $summary->month }}</td>
								<td>{{ $summary->total_hours }}</td>
								<td>{{ $summary->notes }}</td>
								<td>
									<a href="{{ route('monthly-summary.show', $summary) }}"
										class="btn btn-info btn-sm">Show</a>
									<a href="{{ route('monthly-summary.edit', $summary) }}"
										class="btn btn-warning btn-sm">Edit</a>
									<form action="{{ route('monthly-summary.destroy', $summary) }}" method="POST"
										style="display:inline-block;">
										@csrf @method('DELETE')
										<button type="submit" class="btn btn-danger btn-sm"
											onclick="return confirm('Delete this record?')">Delete</button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
	
					{{ $summaries->links() }}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection