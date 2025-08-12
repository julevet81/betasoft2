@extends('dashboard.layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Hi, welcome back {{ Auth::user()->name }}!</h2>
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
					<div class="card-body">
								<div class="table-responsive">
									<table id="example" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">user Name</th>
												<th class="border-bottom-0">Email</th>
												<th class="border-bottom-0">Phone</th>
												<th class="border-bottom-0">Address</th>
												<th class="border-bottom-0">Image</th>
												<th class="border-bottom-0">Status</th>
												<th class="border-bottom-0">Role</th>
												<th class="border-bottom-0">Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($users as $user)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>{{ $user->name }}</td>
												<td>{{ $user->email }}</td>
												<td>{{ $user->phone }}</td>
												<td>{{ $user->address }}</td>
												<td>{{ $user->image }}</td>
												<td>
													<span class="badge {{ $user->status == 'active' ? 'badge-success' : 'badge-danger' }}">
														{{ ucfirst($user->status) }}
													</span>
												</td>
												<td>
													@if (!empty($user->getRoleNames()))
													@foreach ($user->getRoleNames() as $v)
													<label class="badge badge-primary">{{ $v }}</label>
													@endforeach
													@endif
												</td>
												@can('manage-users')
												<!-- manage-user -->
												<td>
													<a class="modal-effect btn btn-sm btn-success"  href="{{ route('users.show', $user->id) }}">show<i class="las la-pen"></i></a>
													<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"  data-toggle="modal" href="#edit{{$user->id}}"><i class="las la-pen"></i></a>
                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"  data-toggle="modal" href="#delete{{$user->id}}">delete<i class="las la-trash"></i></a>
                                                    <a class="modal-effect btn btn-sm btn-warning" href="{{ route('users.permissions.edit', $user->id) }}"><i class="las la-trash"></i></a>
												</td>
												@endcan
											</tr>
											@include('dashboard.user.edit')
											@include('dashboard.user.delete')
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
				</div>
@endsection
@section('js')

<script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection