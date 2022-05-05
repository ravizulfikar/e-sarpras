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
					<a href="{{ route($pages['create']['url']) }}" class="btn btn-pill btn-primary btn-air-primary pull-right"><i class="fa fa-plus"></i> Add Data</a>

					{{-- <button type="button" class="btn btn-primary" onclick="on()">Turn on overlay effect</button> --}}
				</div>
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<table id="example" class="table table-bordernone table-hover table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Level</th>
								<th>Class</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $role)
							<tr>
								<td></td>
								<td>{{ $role->name }}</td>
								<td>{!! LevelBadge($role->level) !!}</td>
								<td><span class="{{ $role->class }}">{{ $role->class }}</span></td>
								<td class="va-middle">
									<a href="{{ route($pages['edit']['url'], $role) }}" class="btn btn-outline-success btn-xs"><i class="fa fa-pencil"></i></a>
									<a href="#" class="btn btn-outline-danger btn-xs remove" data-action="{{ route($pages['destroy'], $role) }}" data-id="{{$role}}"><i class="fa fa-trash"></i></a>
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
			paging: false,
			columnDefs: [
				{ searchable: false, orderable: false, width: 10, targets: 0, className: 'text-center' },
				{ width: 220, targets: 1 },
				{ width: 80, targets: 2 },
				{ width: 170, targets: 3 },
				{ width: 50, targets: 4 }
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
</script>

@endpush
