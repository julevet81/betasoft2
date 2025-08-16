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
    
		<div>
			<h2>payment Details</h2>
		</div>
	
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Field</th>
					<th>Value</th>
				</tr>
			</thead>
			<tbody>
				@foreach($summaryData as $key => $value)
				<tr>
					<td>{{ ucfirst(str_replace('_', ' ', $key)) }}</td>
					<td>{{ $value }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	
	

    <a href="{{ route('monthly-summary.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection

@section('js')
@endsection