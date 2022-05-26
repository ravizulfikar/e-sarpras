@extends('layouts.simple.master')

@section('title', $pages['ticketing']['title'] ?? '-' )

@push('css')
<style>
	tbody>tr { height: 75px; }
</style>

<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['ticketing']['title'] ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['ticketing']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row project-cards">
		<div class="col-md-12 project-list">
			<div class="card">
				<div class="row">
					<div class="col-md-6">
						<ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>Troubleshooting & Monitoring</a></li>
							<li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Server</a></li>
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
														<th class="all">Verify</th>
														<th class="none">Action</th>
														<th class="none">Type</th>
														<th class="none">Status</th>
														<th class="none">Troubleshooting</th>
													</tr>
												</thead>
												<tbody style="vertical-align: middle;">
												@foreach($data["trouble_monit"] as $trouble_monit)
													<tr>
														<td></td>
														<td style="font-size:9pt;">
															<a data-fancybox data-type="pdf" data-height="700" href="{{ route('output.render', ['ticket', $trouble_monit->id]) }}">
																<span class="badge badge-{{ StatusHeader($trouble_monit->status) }}">
																	{{ $trouble_monit->token }}
																</span>
															</a>
															{{-- <a href="{{ route($pages['ticketing']['show']['url'], $trouble_monit) }}">
																<span class="badge badge-{{ StatusHeader($trouble_monit->status) }}">
																	{{ $trouble_monit->token }}
																</span>
															</a> --}}
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
															

															@if($trouble_monit->verification == 'kasubbag')
																
																<a href="#" disabled class="btn btn-success btn-xs">Verified</a><br>

															@elseif($trouble_monit->verification == 'kasatpel')

																@if(in_array(auth()->user()->role->slug, ['kasatpel']))
																	<a href="#" disabled class="btn btn-success btn-xs">Verified</a><br>
																@elseif(in_array(auth()->user()->role->slug, ['kasubbag']))
																	<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $trouble_monit) }}" data-id="{{ $trouble_monit->id }}" data-method="PUT" class="btn btn-info btn-xs verify">Verify Now</a><br>
																@endif

															@else

																@if($trouble_monit->SignerTickets->sign != null)
																	<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $trouble_monit) }}" data-id="{{ $trouble_monit->id }}" data-method="PUT" class="btn btn-info btn-xs verify">Verify Now</a><br>
																@endif

																<a href="#" data-action="{{ route($pages['ticketing']['reSign'], $trouble_monit) }}" data-id="{{ $trouble_monit->id }}" data-method="PUT" class="btn btn-danger btn-xs resign">Re Sign</a>

															@endif
															
															
														</td>
														<td class="va-middle">
															<a href="{{ route($pages['ticketing']['show']['url'], $trouble_monit) }}" class="btn btn-outline-info btn-xs">View Ticket</a>
														</td>
														<td>{!! TypeBadge($trouble_monit->type) !!}</td>
														<td>{!! StatusBadge($trouble_monit->status) !!}</td>
														<td>{{ RenderJson($trouble_monit->detail, "trouble", '-') }}</td>
													</tr>
												@endforeach
												</tbody>

											</table>
										</div>
									<br>
								</div>
							</div>
						</div>


						<div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
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
													<th class="all">Verify</th>
													<th class="none">Action</th>
													<th class="none">Troubleshooting</th>
												</tr>
											</thead>
											<tbody style="vertical-align: middle;">
											@foreach($data["server"] as $server)
												<tr>

													<td></td>
													<td style="font-size:9pt;">
														<a data-fancybox data-type="pdf" data-height="700" href="{{ route('output.render', ['ticket', $server->id]) }}">
															<span class="badge badge-{{ StatusHeader($server->status) }}">
																{{ $server->token }}
															</span>
														</a>
													</td>
													<td style="font-size:9pt;">{{ date('Y-m-d', strtotime($server->date)); }}</td>
													<td>{!! Location($server->location, 'unit') !!}</td>
													
													<td>{{ $server->category }}</td>
													<td>{!! StatusBadge($server->status) !!}</td>
													<td class="va-middle">

														@if($server->verification == 'kasubbag')
																
															<a href="#" disabled class="btn btn-success btn-xs">Verified</a><br>

														@elseif($server->verification == 'kasatpel')

															@if(in_array(auth()->user()->role->slug, ['kasatpel']))
																<a href="#" disabled class="btn btn-success btn-xs">Verified</a><br>
															@elseif(in_array(auth()->user()->role->slug, ['kasubbag']))
																<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $server) }}" data-id="{{ $server->id }}" data-method="PUT" class="btn btn-info btn-xs verify">Verify Now</a><br>
															@endif

														@else

															<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $server) }}" data-id="{{ $server->id }}" data-method="PUT" class="btn btn-info btn-xs verify">Verify Now</a><br>

														@endif

													</td>
													<td class="va-middle">
														<a href="{{ route($pages['ticketing']['show']['url'], $server) }}" class="btn btn-outline-info btn-xs">View Ticket</a>
													</td>
													<td>{{ RenderJson($server->detail, "trouble", '-') }}</td>
												</tr>
											@endforeach
											</tbody>
										</table>
									</div>
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

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

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
		// order: [7, 'desc']
		});

		$('#btn-show-all-doc').on('click', expandCollapseAll);

		function expandCollapseAll() {
			table.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length || 
			table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
		}

		Fancybox.bind("[data-fancybox]", {});
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
		// order: [1, 'asc']
		});

		$('#btn-show-all-doc-2').on('click', expandCollapseAll);

		function expandCollapseAll() {
			table2.rows('.parent').nodes().to$().find('td:first-child').trigger('click').length || 
			table2.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click')
		}
	} );
</script>


<script>
	$(function() {
		
	});
</script>
@endpush
