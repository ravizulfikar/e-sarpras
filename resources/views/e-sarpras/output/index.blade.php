@extends('layouts.simple.master')

@section('title', $pages['title'] ?? '-' )

@push('css')
<link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"
    />
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['title'] ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<a href="{{ route($pages['generate']['url']) }}" class="btn btn-pill btn-primary btn-air-primary pull-right"><i class="fa fa-plus"></i> Generate Output</a>

				</div>
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Year</th>
								<th>Month</th>
								<th>Tickets</th>
								<th>Reports</th>
								{{-- <th>Action</th> --}}
							</tr>
						</thead>
						<tbody>
						@foreach($data as $output)
							<tr style="vertical-align: middle; text-align: center;">
								<td></td>
								<td>{{ $output->year }}</td>
								<td>{{ MonthName($output->month) }}</td>
								
								<td>
									@if(!empty($output->tickets))
										<a data-fancybox data-type="pdf" data-height="700" href="{{ url('/storage/output/'.$output->user->id.'/'.$output->tickets) }}" class="btn btn-outline-primary w-100"><i class="fa fa-download"></i> Tickets</a>
									@else
										<form method="POST" action="{{ route($pages['generate']['tickets'], [$output, $output->month, $output->year]) }}">
											@method('PUT')
											@csrf
											<button type="submit" class="btn btn-danger w-100"><i class="fa fa-upload"></i> Generate Tickets</button>
										</form>
									@endif
								</td>
								<td>
									@if(!empty($output->reports))
										{{-- <a href="#" class="btn btn-outline-primary btn-xs"><i class="fa fa-download"></i> Reports</a> --}}
										<a data-fancybox data-type="pdf" data-height="700" href="{{ url('/storage/output/'.$output->user->id.'/'.$output->reports) }}" class="btn btn-outline-primary w-100"><i class="fa fa-download"></i> Reports</a>
									@else
										{{-- <a href="#" class="btn btn-outline-danger btn-xs"><i class="fa fa-upload"></i> Generate Reports</a> --}}
										<form method="POST" action="{{ route($pages['generate']['reports'], [$output, $output->month, $output->year]) }}">
											@method('PUT')
											@csrf
											<button type="submit" class="btn btn-danger w-100"><i class="fa fa-upload"></i> Generate Reports</button>
										</form>
									@endif
									
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

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script>
	$(function() {
		// var table = $('#example');
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

		table.on( 'order.dt search.dt', function () {
			let i = 1;
	
			table.cells(null, 0, {search:'applied', order:'applied'}).every( function (cell) {
				this.data(i++);
			} );
		} ).draw();

		Fancybox.bind("[data-fancybox]", {});

	} );
</script>


@endpush
