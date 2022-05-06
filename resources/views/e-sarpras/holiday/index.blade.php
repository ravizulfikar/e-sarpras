@extends('layouts.simple.master')

@section('title', $pages['title'] ?? '-' )

@push('css')
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
					<a href="{{ route('holiday.sync') }}" class="btn btn-pill btn-success btn-air-success pull-right"><i class="fa fa-refresh"></i> Synchronize Data</a> <a href="{{ route($pages['create']['url']) }}" class="btn btn-pill btn-primary btn-air-primary pull-right"><i class="fa fa-plus"></i> Add Data</a>

					{{-- <button type="button" class="btn btn-primary" onclick="on()">Turn on overlay effect</button> --}}
				</div>
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Date</th>
								<th>Name</th>
								<th>Holiday</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $holiday)
							<tr>
								<td></td>
								<td>{{ date_format(date_create($holiday->date), 'Y-m-d') }}</td>
								<td>{{ $holiday->name }}</td>
								<td>{!! HolidayBadge($holiday->is_holiday) !!}</td>
								<td class="va-middle">
									<a href="{{ route($pages['edit']['url'], $holiday) }}" class="btn btn-outline-success btn-xs"><i class="fa fa-pencil"></i></a>
									<a href="#" class="btn btn-outline-danger btn-xs remove" data-action="{{ route($pages['destroy'], $holiday) }}" data-id="{{$holiday}}"><i class="fa fa-trash"></i></a>
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
				{ width: 100, targets: 1 },
				{ width: 280, targets: 2 },
				{ width: 90, targets: 3 },
				{ width: 50, targets: 4 }
			],
			order: [[ 1, 'DESC' ]],
			fixedColumns: true
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
