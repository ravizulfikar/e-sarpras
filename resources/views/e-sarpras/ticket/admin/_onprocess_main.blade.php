@extends('layouts.simple.master')

@section('title', $pages['admin']['title'] ?? '-' )

@push('css')
<style>
	tbody>tr { height: 75px; }
</style>
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['admin']['title'] ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['admin']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row project-cards">
		<div class="col-md-12 project-list">
			<div class="card">
				<div class="row">
					<div class="col-md-6">
						<ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>Troubleshooting</a></li>
							<li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i data-feather="info"></i>Monitoring</a></li>
							<li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Server</a></li>
						</ul>
					</div>
					{{-- <div class="col-md-6">                    
						<div class="form-group mb-0 me-0"></div><a class="btn btn-primary" href="projectcreate.html"> <i data-feather="plus-square"> </i>Create New Project</a>
					</div> --}}
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="tab-content" id="top-tabContent">
						<div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
							<div class="row">
								<div class="col-md-12">
									<table id="table_troubleshooting" class="table table-bordernone table-hover table-striped " style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Token</th>
												<th>City</th>
												<th>Location</th>
												<th>User</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody style="vertical-align: middle;">
										@foreach($data["troubleshooting"] as $troubleshooting)
											<tr>
												<td></td>
												<td style="font-size:8pt;">{{ $troubleshooting->token }} <br> {{ date('Y-m-d', strtotime($troubleshooting->date)); }}</td>
												<td>{!! Location($troubleshooting->location, 'city') !!}</td>
												<td>{!! Location($troubleshooting->location, 'unit') !!}</td>
												<td>{{ (!empty($troubleshooting->SignerTickets) ? $troubleshooting->SignerTickets->signer : '-') }}</td>
												<td>{!! StatusBadge($troubleshooting->status) !!}</td>
												<td class="va-middle">
													<a href="{{ route($pages['admin']['view']['url'], $troubleshooting) }}" class="btn btn-outline-info btn-xs">View</a>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
									<br>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
							<div class="row">
								<div class="col-md-12">
									<table id="table_monitoring" class="table table-bordernone table-hover table-striped " style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Token</th>
												<th>City</th>
												<th>Location</th>
												<th>User</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody style="vertical-align: middle;">
										@foreach($data["monitoring"] as $monitoring)
											<tr>
												<td></td>
												<td style="font-size:8pt;">{{ $monitoring->token }} <br> {{ date('Y-m-d', strtotime($monitoring->date)); }}</td>
												<td>{!! Location($monitoring->location, 'city') !!}</td>
												<td>{!! Location($monitoring->location, 'unit') !!}</td>
												<td>{{ (!empty($monitoring->SignerTickets) ? $monitoring->SignerTickets->signer : '-') }}</td>
												<td>{!! StatusBadge($troubleshooting->status) !!}</td>
												<td class="va-middle">
													<a href="{{ route($pages['admin']['view']['url'], $monitoring) }}" class="btn btn-outline-info btn-xs">View</a>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
									<br>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
							<div class="row">
								<div class="col-md-12">
									<table id="table_server" class="table table-bordernone table-hover table-striped " style="width:100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Token</th>
												<th>Category</th>
												<th>Location</th>
												<th>Status</th>
												<th>Action</th>
												{{-- <th>User</th> --}}
											</tr>
										</thead>
										<tbody style="vertical-align: middle;">
										@foreach($data["server"] as $server)
											<tr>
												<td></td>
												<td style="font-size:8pt;">{{ $server->token }} <br> {{ date('Y-m-d', strtotime($server->date)); }}</td>
												<td>{{ $server->category }}</td>
												<td>{!! Location($server->location, 'unit') !!}</td>
												<td>{!! StatusBadge($troubleshooting->status) !!}</td>
												<td class="va-middle">
													<a href="{{ route($pages['admin']['view']['url'], $server) }}" class="btn btn-outline-info btn-xs">View</a>
												</td>
											</tr>
										@endforeach
										</tbody>
									</table>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>

@endsection

@push('script')

<script>
	$(function() {
		// var table = $('#example');
		var table = $('#table_troubleshooting').DataTable({
			responsive: true,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 60, targets: 1 },
				// { width: 80, targets: 2 },
				{ width: 70, targets: 2 },
				{ width: 160, targets: 3 },
				{ width: 120, targets: 4 },
				{ width: 50, targets: 5 },
				{ width: 50, targets: 6 }
			],
			order: [[ 1, 'asc' ]],
			fixedColumns:   {
				heightMatch: 'none'
			}
		});

		table.on( 'order.dt search.dt', function () {
			let i = 1;
	
			table.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
				this.data(i++);
			} );
		} ).draw();

	} );
</script>

<script>
	$(function() {
		// var table = $('#example');
		var table = $('#table_monitoring').DataTable({
			responsive: true,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 60, targets: 1 },
				// { width: 80, targets: 2 },
				{ width: 70, targets: 2 },
				{ width: 160, targets: 3 },
				{ width: 170, targets: 4 },
				{ width: 30, targets: 5 },
				{ width: 30, targets: 6 }
			],
			order: [[ 1, 'asc' ]],
			fixedColumns:   {
				heightMatch: 'none'
			}
		});

		table.on( 'order.dt search.dt', function () {
			let i = 1;
	
			table.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
				this.data(i++);
			} );
		} ).draw();

	} );
</script>

<script>
	$(function() {
		// var table = $('#example');
		var table = $('#table_server').DataTable({
			responsive: true,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 60, targets: 1 },
				// { width: 80, targets: 2 },
				// { width: 80, targets: 2 },
				{ width: 150, targets: 2 },
				{ width: 200, targets: 3 },
				{ width: 50, targets: 4 },
				{ width: 50, targets: 5 }
			],
			order: [[ 1, 'asc' ]],
			fixedColumns:   {
				heightMatch: 'none'
			}
		});

		table.on( 'order.dt search.dt', function () {
			let i = 1;
	
			table.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
				this.data(i++);
			} );
		} ).draw();

	} );
</script>
@endpush
