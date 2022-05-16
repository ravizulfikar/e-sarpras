@extends('layouts.simple.master')

@section('title', $pages['process']['title'] ?? '-' )

@push('css')
<style>
	tbody>tr { height: 75px; }
</style>
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['process']['title'] ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item">Ticket</li>
<li class="breadcrumb-item active">{{ $pages['process']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				{{-- <div class="card-header">
					<a href="{{ route($pages['create']['url']) }}" class="btn btn-pill btn-primary btn-air-primary pull-right"><i class="fa fa-plus"></i> Add Data</a>
				</div> --}}
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

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
									{{-- <a href="{{ route($pages['show']['url'], $ticket) }}" class="btn btn-outline-info btn-xs"><i class="fa fa-eye"></i></a> --}}
									{{-- <form method="POST" action="{{ route($pages['entry']['update'], $ticket) }}">
										@method('PUT')
										@csrf
										<button type="submit" class="btn btn-success btn-small">Process</button>
									</form> --}}
									<a href="{{ route($pages['process']['edit'], $ticket) }}" class="btn btn-outline-success btn-xs"> Update</a>
									<a href="#" class="btn btn-outline-danger btn-xs update" data-action="{{ route($pages['process']['delete'], $ticket) }}" data-id="{{$ticket}}" data-method="PUT"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
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
		var table = $('#example').DataTable({
			responsive: true,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 80, targets: 1 },
				{ width: 80, targets: 2 },
				{ width: 80, targets: 3 },
				{ width: 160, targets: 4 },
				{ width: 100, targets: 5 },
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
</script>

@endpush
