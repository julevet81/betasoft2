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
								<i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star active"></i> <i class="typcn typcn-star"></i> <span>(14,873)</span>
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
									<a href="{{ route('employees.create') }}" class="btn btn-primary">
										Add Employee
									</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									 <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Post Title</th>
                    <th>Contract Type</th>
                    <th>Start Date</th>
                    <th>{{ trans('actions.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $index => $employee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $employee->user->name }}</td>
                    <td>{{ $employee->user->email }}</td>
                    <td>{{ $employee->user->phone }}</td>
                    <td>
                        <span class="badge {{ $employee->user->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($employee->user->status) }}
                        </span>
                    </td>
                    <td>{{ $employee->post->title ?? '-' }}</td>
                    <td>{{ $employee->contractType->name ?? '-' }}</td>
                    <td>{{ $employee->start_date }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-success">Show</a>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$employee->id}}">delete<i class="las la-trash"></i></a>

                    </td>
                </tr>
                @include('employees.delete')
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