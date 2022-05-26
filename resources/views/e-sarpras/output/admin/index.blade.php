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
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
						<thead>
							<tr style="vertical-align: middle; text-align: center;">
								<th>No</th>
								<th>User</th>
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
								<td>{{ $output->user->name }}</td>
								<td>{{ $output->year }}</td>
								<td>{{ MonthName($output->month) }}</td>
								
								<td>
									@if(!empty($output->tickets))
										<a data-fancybox data-type="pdf" data-height="700" href="{{ url('/storage/output/'.$output->user->id.'/'.$output->tickets) }}" class="btn btn-outline-primary w-100"><i class="fa fa-download"></i> Tickets</a>
									@else
										<button type="button" class="btn btn-danger w-100" disabled><i class="fa fa-upload"></i> Not Yet</button>
									@endif
								</td>
								<td>
									@if(!empty($output->reports))
										{{-- <a href="#" class="btn btn-outline-primary btn-xs"><i class="fa fa-download"></i> Reports</a> --}}
										<a data-fancybox data-type="pdf" data-height="700" href="{{ url('/storage/output/'.$output->user->id.'/'.$output->reports) }}" class="btn btn-outline-primary w-100"><i class="fa fa-download"></i> Reports</a>
									@else
										<button type="button" class="btn btn-danger w-100" disabled><i class="fa fa-upload"></i> Not Yet</button>
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
