@extends('layouts.simple.master')

@section('title', $pages['main']['title'] ?? '-' )

@push('css')
<style>
	tbody>tr { height: 75px; }
</style>
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['main']['title'] ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['main']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row project-cards">
		<div class="col-md-12 project-list">
			<div class="card">
				<div class="row">
					<div class="col-md-6">
						<ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
							@if(auth()->user()->role->slug == 'ta-asisten' || auth()->user()->role->slug == 'ta-teknisi') 
							<li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>Troubleshooting & Monitoring</a></li>
							@endif

							@if(auth()->user()->role->slug == 'ta-asisten' || auth()->user()->role->slug == 'ta-admin') 
							<li class="nav-item"><a class="nav-link @if(auth()->user()->role->slug == 'ta-admin') active @endif" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Server</a></li>
							@endif
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card">
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="tab-content" id="top-tabContent">

						@if(auth()->user()->role->slug == 'ta-asisten' || auth()->user()->role->slug == 'ta-teknisi')
						<div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-primary" id="btn-show-all-doc">Expand / Collapse</button>

										<div class="table-responsive mt-3">
											<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
												<thead>
													<tr>
														<th class="all">#</th>
														<th class="all">Token</th>
														<th class="all">Date</th>
														<th class="all">City</th>
														<th class="all">Location</th>
														<th class="all">User</th>
														<th class="all">Sign</th>
														<th class="none">Action</th>
														<th class="none">Type</th>
														<th class="none">Status</th>
														{{-- <th class="none">Troubleshooting</th> --}}
													</tr>
												</thead>
												<tbody style="vertical-align: middle;">
												@foreach($data as $trouble_monit)
													@if($trouble_monit->type == 'troubleshooting' || $trouble_monit->type == 'monitoring')
													<tr>
														<td></td>
														<td style="font-size:9pt;">
															<a href="{{ route($pages['show']['url'], $trouble_monit) }}">
																<span class="badge badge-{{ StatusHeader($trouble_monit->status) }}">
																	{{ $trouble_monit->token }}
																</span>
															</a>
														</td>
														<td style="font-size:9pt;">{{ date('Y-m-d', strtotime($trouble_monit->date)); }}</td>
														<td>{!! Location($trouble_monit->location, 'city') !!}</td>
														<td>{!! Location($trouble_monit->location, 'unit') !!}</td>
														<td>{{ (!empty($trouble_monit->SignerTickets) ? $trouble_monit->SignerTickets->signer : '-') }}</td>
														<td>
															@if($trouble_monit->SignerTickets->sign != null)
																<i class="fa fa-check-square-o text-success"></i>
															@else
																<i class="fa fa-minus-square-o text-danger"></i>
															@endif
														</td>
														<td class="va-middle">
															@if($trouble_monit->verification == 'open')
																<a href="{{ route($pages['show']['url'], $trouble_monit) }}" class="btn btn-outline-info btn-xs">View</a>
																<a href="#" class="btn btn-outline-danger btn-xs remove" data-action="{{ route($pages['destroy'], $trouble_monit) }}" data-id="{{$trouble_monit}}">Delete</a>
															@else
																<button class="btn btn-success btn-xs" type="button" disabled>Verified</button>
															@endif
														</td>
														<td>{!! TypeBadge($trouble_monit->type) !!}</td>
														<td>{!! StatusBadge($trouble_monit->status) !!}</td>
														{{-- <td>{{ RenderJson($trouble_monit->detail, "trouble", '-') }}</td> --}}
													</tr>
													@endif
												@endforeach
												</tbody>
											</table>
										</div>
									<br>
								</div>
							</div>
						</div>
						@endif

						@if(auth()->user()->role->slug == 'ta-asisten' || auth()->user()->role->slug == 'ta-admin') 
						<div class="tab-pane fade @if(auth()->user()->role->slug == 'ta-admin') show active @endif" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-primary" id="btn-show-all-doc-2">Expand / Collapse</button>

									<div class="table-responsive mt-3">
										<table id="example_server" class="table table-bordernone table-hover table-striped" style="width:100%">
											<thead>
												<tr>
													<th class="all">#</th>
													<th class="all">Token</th>
													<th class="all">Date</th>
													<th class="all">Location</th>
													<th class="all">Category</th>
													<th class="all">Status</th>
													<th class="none">Action</th>
												</tr>
											</thead>
											<tbody style="vertical-align: middle;">
											@foreach($data as $server)
												@if($server->type == 'server')
												<tr>
													<td></td>
													<td style="font-size:9pt;">
														<a href="{{ route($pages['show']['url'], $server) }}">
															<span class="badge badge-{{ StatusHeader($server->status) }}">
																{{ $server->token }}
															</span>
														</a>
													</td>
													<td style="font-size:9pt;">{{ date('Y-m-d', strtotime($server->date)); }}</td>
													<td>{!! Location($server->location, 'unit') !!}</td>
													
													<td>{{ $server->category }}</td>
													<td>{!! StatusBadge($server->status) !!}</td>
													{{-- <td>{{ RenderJson($server->detail, "trouble", '-') }}</td> --}}
													<td>
														@if($server->verification == 'open')
														<a href="{{ route($pages['show']['url'], $server) }}" class="btn btn-outline-info btn-xs">View</a>
														<a href="#" class="btn btn-outline-danger btn-xs remove" data-action="{{ route($pages['destroy'], $server) }}" data-id="{{$server}}">Delete</a>
														@else
															<button class="btn btn-success btn-xs" type="button" disabled>Verified</button>
														@endif
													</td>
												</tr>
												@endif
											@endforeach
											</tbody>
										</table>
									</div>
									<br>
								</div>
							</div>
						</div>
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- <div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="table-responsive mt-3">
						<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Token</th>
									<th>Type</th>
									<th>City</th>
									<th>Location</th>
									<th>User</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody style="vertical-align: middle;">
							@foreach($data as $ticket)
								<tr>
									<td></td>
									<td style="font-size:8pt;">{{ $ticket->token }} <br> {{ date('Y-m-d', strtotime($ticket->date)); }}</td>
									<td>{!! TypeBadge($ticket->type) !!}</td>
									<td>{!! Location($ticket->location, 'city') !!}</td>
									<td>{!! Location($ticket->location, 'unit') !!}</td>
									<td>{{ (!empty($ticket->SignerTickets) ? $ticket->SignerTickets->signer : '-') }}</td>
									<td class="va-middle">
										
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> --}}

</div>

@endsection

@push('script')

{{-- <script>
	$(function() {
		// var table = $('#example');
		var table = $('#example').DataTable({
			responsive: true,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 80, targets: 1 },
				{ width: 80, targets: 2 },
				{ width: 80, targets: 3 },
				{ width: 140, targets: 4 },
				{ width: 120, targets: 5 },
				{ width: 70, targets: 6 }
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
</script> --}}
<script>
	
	$(function() {
		/* Formatting function for row details - modify as you need */
		var table = $('#example').DataTable({
		responsive: {
			details: {
			type: 'column'
			}
		},
		columnDefs: [{
			className: 'control',
			orderable: false,
			targets: 0
		}],
		order: [1, 'asc']
		});

		$('#btn-show-all-doc').on('click', expandCollapseAll);

		function expandCollapseAll() {
			table.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length || 
			table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
		}
	} );
</script>

<script>
	
	$(function() {
		/* Formatting function for row details - modify as you need */
		var table2 = $('#example_server').DataTable({
		responsive: {
			details: {
			type: 'column'
			}
		},
		columnDefs: [{
			className: 'control',
			orderable: false,
			targets: 0
		}],
		order: [1, 'asc']
		});

		$('#btn-show-all-doc-2').on('click', expandCollapseAll);

		function expandCollapseAll() {
			table2.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length || 
			table2.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
		}
	} );
</script>
@endpush
