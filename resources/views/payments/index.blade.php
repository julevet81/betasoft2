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
	<div class="main-dashboard-header-right">
		<div>
			<label class="tx-13">Customer Ratings</label>
			<div class="main-star">
				<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
					class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i
					class="typcn typcn-star"></i> <span>(14,873)</span>
			</div>
		</div>
		<div>
			<label class="tx-13">Online Sales</label>
			<h5>563,275</h5>
		</div>
		<div>
			<label class="tx-13">Offline Sales</label>
			<h5>783,675</h5>
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
			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">
					<!-- Button trigger modal -->
					<a href="{{ route('payments.create') }}" class="btn btn-primary">
						Add payment
					</a>
				</div>
			</div>
			<div class="card-body">
				<!-- Filter -->
				<form method="GET" action="{{ route('payments.index') }}" class="mb-4">
					<div class="row g-2">
						<div class="col-md-3">
							<select name="status" class="form-control" onchange="this.form.submit()">
								<option value="">All Statuses</option>
								<option value="completed" {{ $status=='completed' ? 'selected' : '' }}>Completed</option>
								<option value="failed" {{ $status=='failed' ? 'selected' : '' }}>Failed</option>
								<option value="partially_completed" {{ $status=='partially_completed' ? 'selected' : '' }}>Partially
									Completed</option>
								<option value="refunded" {{ $status=='refunded' ? 'selected' : '' }}>Refunded</option>
							</select>
						</div>
				
						<div class="col-md-3">
							<select name="type" class="form-control" onchange="this.form.submit()">
								<option value="">All Types</option>
								<option value="salary" {{ $type=='salary' ? 'selected' : '' }}>Salary</option>
								<option value="client payment" {{ $type=='client payment' ? 'selected' : '' }}>Client Payment</option>
								<option value="bonus" {{ $type=='bonus' ? 'selected' : '' }}>Bonus</option>
							</select>
						</div>
					</div>
				</form>
				<!-- Payments Table -->
				<div class="table-responsive">
					<table class="table table-bordered align-middle">
						<thead class="table-light">
							<tr>
								<th>#</th>
								<th>Payment Type</th>
								<th>User</th>
								<th>Amount</th>
								<th>Project</th>
								<th>Payment Date</th>
								<th>Status</th>
								<th>Method</th>
								<th>Reference</th>
								<th>Notes</th>
								<th>{{ trans('actions.actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($payments as $index => $payment)
							<tr>
								<td>{{ $index + 1 }}</td>
								<td>{{ $payment->type }}</td>
								<td>{{ $payment->user->name }}</td>
								<td>{{ $payment->amount }}</td>
								<td>{{ $payment->project->name }}</td>
								<td>{{ $payment->payment_date }}</td>
								<td>
									<span class="badge 
								                @if($payment->status == 'completed') bg-success 
												@elseif($payment->status == 'pending') bg-warning
								                @elseif($payment->status == 'failed') bg-danger
								                @elseif($payment->status == 'partially_completed') bg-warning
								                @elseif($payment->status == 'refunded') bg-secondary
								                @endif">
										{{ ucfirst(str_replace('_', ' ', $payment->status)) }}
									</span>
								</td>
								<td>{{ $payment->method }}</td>
								<td>{{ $payment->reference }}</td>
								<td>{{ $payment->notes }}</td>
								<td>
									<a href="{{ route('payments.show', $payment->id) }}"
										class="btn btn-sm btn-success">Show</a>
									<a href="{{ route('payments.edit', $payment->id) }}"
										class="btn btn-sm btn-info">Edit</a>
									<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
										data-toggle="modal" href="#delete{{$payment->id}}">delete<i
											class="las la-trash"></i></a>

								</td>
							</tr>
							@include('payments.delete')
							@empty
							<tr>
								<td colspan="6" class="text-center">No payments found</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<!-- Container closed -->
				@endsection
				@section('js')
				<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
				<script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

				@endsection