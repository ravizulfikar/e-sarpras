@extends('layouts.simple.master')

@section('title', $pages['reporting']['title'] ?? '-' )

@push('css')
<style>
	tbody>tr { height: 75px; }
</style>
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['reporting']['title'] ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['reporting']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">

				</div>
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
						<thead>
							<tr>
								<th class="all">#</th>
								<th class="all">Officer</th>
								<th class="all">Year</th>
								<th class="all">Month</th>
								<th class="all">Value</th>
								<th class="all">Verification</th>
								<th class="all">Action</th>
							</tr>
						</thead>
						<tbody style="vertical-align: middle;">
						@foreach($data as $report)
							<tr>
								<td></td>
								<td>{{ $report->user->name }}</td>
								<td>{{ $report->year }}</td>
								<td>{{ MonthName($report->month) }}</td>
								<td class="va-middle">
									{{-- {{ $report->ReportPicture()->exists() }} --}}

									@if($report->ReportPicture()->exists())
										<a href="#" class="btn btn-outline-success btn-xs">Pictures {{ $report->ReportPicture()->count() }}</a>
									@else
										<a href="#" class="btn btn-outline-danger btn-xs">Pictures</a>
									@endif

									@if($report->ReportDescription()->exists())
										<a href="#" class="btn btn-outline-success btn-xs">Descriptions {{ $report->ReportDescription()->count() }}</a>
									@else
										<a href="#" class="btn btn-outline-danger btn-xs">Descriptions</a>
									@endif

									{{-- <a href="#" class="btn btn-outline-danger btn-xs">Descriptions</a> --}}
								</td>
								{{-- <td>{!! ReportVerify($report->verification) !!}</td> --}}
								<td>
									@if($report->verification == 'kasubbag')
																
										<a href="#" disabled class="btn btn-success btn-xs">Verified</a><br>

									@elseif($report->verification == 'kasatpel')

										@if(in_array(auth()->user()->role->slug, ['kasatpel']))
											<a href="#" disabled class="btn btn-success btn-xs">Verified</a><br>
										@elseif(in_array(auth()->user()->role->slug, ['kasubbag']))
											<a href="#" data-action="{{ route($pages['reporting']['verifyNow'], $report) }}" data-id="{{ $report->id }}" data-method="PUT" class="btn btn-info btn-xs verify">Verify Now</a><br>
										@endif

									@else

										<a href="#" data-action="{{ route($pages['reporting']['verifyNow'], $report) }}" data-id="{{ $report->id }}" data-method="PUT" class="btn btn-info btn-xs verify">Verify Now</a><br>

									@endif
								</td>
								<td class="va-middle">
									<a href="{{ route($pages['reporting']['show']['url'], $report) }}" class="btn btn-outline-info btn-xs">View</a>
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

{{-- <script>
	$(function() {
		// var table = $('#example');
		var table = $('#example').DataTable({
			responsive: true,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 50, targets: 1 },
				{ width: 50, targets: 2 },
				{ width: 80, targets: 3 },
				{ width: 80, targets: 4 },
				{ width: 50, targets: 5 }
			],
			order: [[ 1, 'asc' ]],
			fixedColumns: true
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
@endpush
