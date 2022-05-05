@extends('layouts.simple.master')

@section('title', $pages['title'] ?? '-' )

@push('css')
<style>
	.va-top{
		vertical-align: top;
	}

	.va-middle{
		vertical-align: middle;
	}
</style>
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
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $user)
							<tr>
								<td>
									<div class="d-inline-block align-middle"><img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('uploads/avatar/'.RenderJson($user->profile, "photo", 'safari.png')) }}" alt="">
                                        <div class="d-inline-block"><span><strong>{{ $user->name }}</strong></span>
                                          <p class="font-roboto" style="font-size:7pt;">
										  {{ $user->username }}</p>
                                        </div>
									</div>
								</td>
								<td class="va-middle">{{ $user->email }}</td>
								<td class="va-middle">
									<span class="{{ $user->role->class }}">{{ $user->role->name }}</span>
								</td>
								<td class="va-middle">
									<a href="{{ route($pages['show']['url'], $user) }}" class="btn btn-outline-info btn-xs"><i class="fa fa-eye"></i></a>
									<a href="{{ route($pages['edit']['url'], $user) }}" class="btn btn-outline-success btn-xs"><i class="fa fa-pencil"></i></a>
									<a href="#" class="btn btn-outline-danger btn-xs remove" data-action="{{ route($pages['destroy'], $user) }}" data-id="{{$user}}"><i class="fa fa-trash"></i></a>
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
{{-- <script type="text/javascript">
	$(function () {
		
		var table = $('#example');

		table.DataTable({
			sDom: 'rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
			info: false,
			lengthChange: true,
			bFilter: true,
			destroy: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: {
				url:"{{route('user.fetch')}}",
				type: "GET"
			},
			columns: [
				{ 
					data: 'DT_RowIndex',
					name: 'DT_Row_Index', 
					"className": "text-center" ,
					orderable: false, 
					// searchable: false   
				},
				{
					data: 'name', name: 'name'                               
				},
				{
					data: 'email', name: 'email'  
				},                                 
				{
					data: 'action', name: 'action',
					"className": "text-center",
					orderable: false, 
					searchable: false    
				},    
			],
			columnDefs: [{
				targets: 1,
				searchable: true,
			}]
		}); 
		
		var tablee = $('#example').DataTable();

		$('#search').on('keyup', function() {
			var textSearch = $(this).val();
            tablee.search(textSearch).draw();
        });

		$.fn.dataTable.ext.errMode = () => tablee.draw();

		// $('#search').each(function() {
		// 	$(this).attr('data-remember', $(this).val());
		// });

		// $('#reset').click(function() {
		// 	$('#search').each(function() {
		// 		$(this).val($(this).attr('data-remember'));
		// 	});

		// 	tablee.search(this.value).draw();
		// });
    });
</script> --}}


<script>
	$(function() {
		// var table = $('#example');
		var table = $('#example').DataTable({
			responsive: true,
			paging: false,
			columnDefs: [
				{ width: 200, targets: 0 },
				{ width: 190, targets: 1 },
				{ width: 100, targets: 2 },
				{ width: 70, targets: 3 }
			],
			fixedColumns: true
		});

	} );
</script>
{{-- <script>
	// $(function () {
	// 	$('.js-basic-example').DataTable();

	// 	//Exportable table
	// 	// $('.js-exportable').DataTable({
	// 	// 	dom: 'Bfrtip',
	// 	// 	buttons: [
	// 	// 		'copy', 'csv', 'excel', 'pdf', 'print'
	// 	// 	]
	// 	// });
	// });	

	$(function () {
		
		var table = $('#example');

		table.DataTable({
			sDom: 'rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
			info: false,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('user.fetch') }}",
			columns: [
					{data: 'DT_RowIndex', name: 'DT_Row_Index', },
					{data: 'name', name: 'name'},
					{data: 'email', name: 'email'},
					{data: 'action', name: 'action', orderable: false, searchable: false, align:"center"},
			],
			columnDefs: [
				{ className: 'text-center', targets: [1, 2] },
			],
			rowReorder: {
				selector: 'td:nth-child(1)'
			},
		});

		var tablee = $('#example').DataTable();

		$('#search').on('keyup', function() {
            tablee.search(this.value).draw();
        });

		$.fn.dataTable.ext.errMode = () => tablee.draw();

		$('#search').each(function() {
			$(this).attr('data-remember', $(this).val());
		});

		$('#reset').click(function() {
			$('#search').each(function() {
				$(this).val($(this).attr('data-remember'));
			});

			tablee.search(this.value).draw();
		});
	  
	});
</script> --}}
@endpush
