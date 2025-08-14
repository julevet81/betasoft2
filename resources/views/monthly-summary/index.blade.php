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
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<!-- Button trigger modal -->
									<a href="{{ route('monthly-summary.create') }}" class="btn btn-primary">
										Add monthly Summary
									</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									 <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Employee</th>
                    <th>Month</th>
                    <th>Total Hours</th>
					<th>Notes</th>
                    <th>{{ trans('actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($summaries as $index => $summary)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $summary->employee->user->name }}</td>
                    <td>{{ $summary->month->format('F Y') }}</td>
                    <td>{{ $summary->total_hours }}</td>
					<td>{{ $summary->notes }}</td>
                    <td>
                        <a href="{{ route('monthly-summary.show', $summary->id) }}" class="btn btn-sm btn-success">Show</a>
                        <a href="{{ route('monthly-summary.edit', $summary->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$summary->id}}">delete<i class="las la-trash"></i></a>

                    </td>
                </tr>
                @include('monthly-summary.delete')
                @endforeach
            </tbody>
        </table>	
								</div>
		<!-- Container closed -->
@endsection
@section('js')
<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection