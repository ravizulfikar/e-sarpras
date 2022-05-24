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
							<li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i data-feather="target"></i>Troubleshooting & Monitoring</a></li>
							<li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="check-circle"></i>Server</a></li>
						</ul>
					</div>

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
													<th class="none">User</th>
													<th class="none">Type</th>
													<th class="all">Status</th>
													@if(in_array(auth()->user()->role->slug, ['kasatpel']))
														<th class="all">Action</th>
													@endif
													<th class="none">Troubleshooting</th>
												</tr>
											</thead>
											<tbody style="vertical-align: middle;">
											@foreach($data["trouble_monit"] as $trouble_monit)
												<tr>
													<td></td>
													<td style="font-size:9pt;">
														<a href="{{ route($pages['admin']['view']['url'], $trouble_monit) }}">
															<span class="badge badge-{{ StatusHeader($trouble_monit->status) }}">
																{{ $trouble_monit->token }}
															</span>
														</a>
													</td>
													<td style="font-size:9pt;">{{ date('Y-m-d', strtotime($trouble_monit->date)); }}</td>
													<td>{!! Location($trouble_monit->location, 'city') !!}</td>
													<td>{!! Location($trouble_monit->location, 'unit') !!}</td>
													<td>{{ (!empty($trouble_monit->SignerTickets) ? $trouble_monit->SignerTickets->signer : '-') }}</td>
													<td>{!! TypeBadge($trouble_monit->type) !!}</td>
													<td>{!! StatusBadge($trouble_monit->status) !!}</td>
													@if(in_array(auth()->user()->role->slug, ['kasatpel']))
														<td>
															@if($trouble_monit->status == 'process')
																<a href="#" class="btn btn-outline-success btn-xs" data-bs-toggle="modal" data-bs-target="#Modal-ViewAssign-{{ $trouble_monit->id }}">View Assigned</a>
															@else
																<a href="#" class="btn btn-outline-primary btn-xs ModalAssignTo" data-bs-toggle="modal" data-bs-target="#Modal-Assign-To" data-whatever="{{ $trouble_monit->id }}">Assign To</a>
															@endif
														</td>
													@endif
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
													@if(in_array(auth()->user()->role->slug, ['kasatpel']))
														<th class="all">Action</th>
													@endif
													<th class="none">Troubleshooting</th>
												</tr>
											</thead>
											<tbody style="vertical-align: middle;">
											@foreach($data["server"] as $server)
												<tr>

													<td></td>
													<td style="font-size:9pt;">
														<a href="{{ route($pages['admin']['view']['url'], $server) }}">
															<span class="badge badge-{{ StatusHeader($server->status) }}">
																{{ $server->token }}
															</span>
														</a>
													</td>
													<td style="font-size:9pt;">{{ date('Y-m-d', strtotime($server->date)); }}</td>
													<td>{!! Location($server->location, 'unit') !!}</td>
													
													<td>{{ $server->category }}</td>
													<td>{!! StatusBadge($server->status) !!}</td>
													@if(in_array(auth()->user()->role->slug, ['kasatpel']))
														<td>
															@if($server->status == 'process')
																<a href="#" class="btn btn-outline-success btn-xs" data-bs-toggle="modal" data-bs-target="#Modal-ViewAssignServer-{{ $server->id }}">View Assigned</a>
															@else
																<a href="#" class="btn btn-outline-primary btn-xs ModalAssignToServer" data-whatever="{{ $server->id }}" data-bs-toggle="modal" data-bs-target="#Modal-Assign-To-Server">Assign To</a>
															@endif
														</td>
													@endif
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

	<div class="modal fade" id="Modal-Assign-To" tabindex="-1" role="dialog" aria-labelledby="Label-Modal-Assign-To" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Assign To Officer</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="form-assign-to" method="post" action="{{ route($pages['officer']['assignPost']) }}">
						@csrf
						<input type="hidden" name="ticket_id" id="ticket_id">

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Name Officer <button class="btn btn-primary btn-xs" type="button" id="addDescOfficer"><i class="fa fa-plus"></i></button></label>
									<table style="width: 100%;" cellspacing="0" cellpadding="0">
										<tr>
											<td style="width:5%;">&nbsp;</td>
											<td style="width:95%;">
												<select class="form-select" name="user_id[]" required>
													<option value="">- Choice Officer -</option>
													@foreach ($paramsOfficer as $user)
														<option value="{{ $user->id }}">{{ $user->name }}</option>
													@endforeach
												</select>
											</td>
										</tr>
										<tbody id="forParamsDesc">
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" form="form-assign-to" type="button">Submit</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="Modal-Assign-To-Server" tabindex="-1" role="dialog" aria-labelledby="Label-Modal-Assign-To-Server" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Assign To Officer</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="form-assign-to-server" method="post" action="{{ route($pages['officer']['assignPost']) }}">
						@csrf

						<input type="hidden" name="ticket_id" id="ticket_id_server">

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Name Officer <button class="btn btn-primary btn-xs" type="button" id="addDescOfficerServer"><i class="fa fa-plus"></i></button></label>
									<table style="width: 100%;" cellspacing="0" cellpadding="0">
										<tr>
											<td style="width:5%;">&nbsp;</td>
											<td style="width:95%;">
												<select class="form-select" name="user_id[]" required>
													<option value="">- Choice Officer -</option>
													@foreach ($paramsOfficerServer as $userServer)
														<option value="{{ $userServer->id }}">{{ $userServer->name }}</option>
													@endforeach
												</select>
											</td>
										</tr>
										<tbody id="forParamsDescServer">
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" form="form-assign-to-server" type="button">Submit</button>
				</div>
			</div>
		</div>
	</div>


	@foreach($data["trouble_monit"] as $trouble_monit)
		<div class="modal fade" id="Modal-ViewAssign-{{ $trouble_monit->id }}" tabindex="-1" role="dialog" aria-labelledby="Label-Modal-Assign-To" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">View Assign Officer</h5>
						<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<b>User Process</b>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-12">
								<table class="table table-bordered table-hover table-striped" style="">
								@if(getUserProcess($trouble_monit->id))
									@foreach(getUserProcess($trouble_monit->id) as $officer)
									<tr>
										<td>{{ $officer->user->name }}</td>
										<td>&nbsp;</td>
									</tr>
									@endforeach
								@endif
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	@endforeach

	@foreach($data["server"] as $server)
		<div class="modal fade" id="Modal-ViewAssignServer-{{ $server->id }}" tabindex="-1" role="dialog" aria-labelledby="Label-Modal-Assign-To" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">View Assign Officer</h5>
						<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<b>User Process</b>
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-12">
								<table class="table table-bordered table-hover table-striped" style="">
								@if(getUserProcess($server->id))
									@foreach(getUserProcess($server->id) as $officer)
									<tr>
										<td>{{ $officer->user->name }}</td>
										<td>&nbsp;</td>
									</tr>
									@endforeach
								@endif
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	@endforeach

</div>

@endsection

@push('script')

<script>
	//deleteDescOfficer btn to delete table forParamsDesc
	$(document).on('click', '#addDescOfficer', function() {
		$('#forParamsDesc').append(
			'<tr>'+
				'<td style="width:5%;"><button type="button" class="btn btn-danger btn-xs deleteDescOfficer"><i class="fa fa-trash"></i></button></td>'+
				'<td style="width:95%;">'+
					'<select class="form-select" name="user_id[]" required>'+
						'<option value="">- Choice Officer -</option>'+
						@foreach ($paramsOfficer as $user)
							'<option value="{{ $user->id }}">{{ $user->name }}</option>'+
						@endforeach
					'</select>'+
				'</td>'+
			'</tr>'
		);
	});

	//deleteDescOfficer btn to delete table forParamsDesc
	$(document).on('click', '.deleteDescOfficer', function() {
		$(this).closest('tr').remove();
	});


	//deleteDescOfficer btn to delete table forParamsDesc
	$(document).on('click', '#addDescOfficerServer', function() {
		$('#forParamsDescServer').append(
			'<tr>'+
				'<td style="width:5%;"><button type="button" class="btn btn-danger btn-xs deleteDescOfficerServer"><i class="fa fa-trash"></i></button></td>'+
				'<td style="width:95%;">'+
					'<select class="form-select" name="user_id[]" required>'+
						'<option value="">- Choice Officer -</option>'+
						@foreach ($paramsOfficerServer as $useServerr)
							'<option value="{{ $userServer->id }}">{{ $userServer->name }}</option>'+
						@endforeach
					'</select>'+
				'</td>'+
			'</tr>'
		);
	});

	//deleteDescOfficer btn to delete table forParamsDesc
	$(document).on('click', '.deleteDescOfficerServer', function() {
		$(this).closest('tr').remove();
	});	

	//click modal send data-whatever
	$(document).on('click', '.ModalAssignTo', function() {
		var data = $(this).data('whatever');
		$('#ticket_id').val(data);
		// console.log(data);
		// $('#form-assign-to').attr('action', '{{ route($pages['officer']['assignPost']) }}/'+data);
		// $('#Modal-Assign-To').find('input[name="ticket_id"]').val(data);
	});

	$(document).on('click', '.ModalAssignToServer', function() {
		var data = $(this).data('whatever');
		$('#ticket_id_server').val(data);
	});
</script>

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
