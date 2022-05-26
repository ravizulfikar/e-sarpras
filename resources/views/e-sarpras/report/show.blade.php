@extends('layouts.simple.master')

@section('title', $pages['show']['title'] ?? '-' )

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/dropzone.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/photoswipe.css')}}">
<style>
	.btnTrash {
		display: block;
		float:right;
		position:relative;
		z-index:100;
		top: -10px;
		right: -5px;
	}
</style>
@endpush

@section('breadcrumb-title')
	<h3>{{ $pages['show']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
	<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
	<li class="breadcrumb-item"><a href="{{ route($pages['index']) }}">{{ $pages['title'] ?? '-' }}</a></li>
	<li class="breadcrumb-item active">{{ $pages['show']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5 class="pull-left">Report {{ MonthName($data->month) }} {{ $data->year }}</h5>
				</div>
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="tabbed-card">
						<ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="pills-desc-tab" data-bs-toggle="pill" href="#pills-desc" role="tab" aria-controls="pills-desc" aria-selected="true"><i class="icofont icofont-listine-dots"></i>Description</a></li>
							<li class="nav-item"><a class="nav-link" id="pills-pics-tab" data-bs-toggle="pill" href="#pills-pics" role="tab" aria-controls="pills-pics" aria-selected="false"><i class="icofont icofont-ui-image"></i>Pictures</a></li>
							<li class="nav-item"><a class="nav-link" id="pills-download-tab" data-bs-toggle="pill" href="#pills-download" role="tab" aria-controls="pills-download" aria-selected="false"><i class="icofont icofont-download"></i>Output Report</a></li>
						</ul>
						<div class="tab-content" id="pills-clrtabContent">
							<div class="tab-pane fade show active" id="pills-desc" role="tabpanel" aria-labelledby="pills-desc-tab">
								@if($data->verification == 'open')
								<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Modal-Desc-Add">Add Description</button>
								<br><br>
								@endif

								@include($pages['folder'].'.show.description')
							</div>
							<div class="tab-pane fade" id="pills-pics" role="tabpanel" aria-labelledby="pills-pics-tab">
								@if($data->verification == 'open')
								<button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#Modal-Pics-Add">Add Picture</button>
								<br><br>
								@endif

								@include($pages['folder'].'.show.picture')
							</div>

							<div class="tab-pane fade" id="pills-download" role="tabpanel" aria-labelledby="pills-download-tab">
								<div class="row">
									<div class="col-md-12">
										<a href="{{ route('output.render', ['report', $data->id, "D"]) }}" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
										<br><br>
										<embed src= "{{ route('output.render', ['report', $data->id]) }}" width= "100%" height= "700">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Vertically centered modal-->
	@foreach($data->ReportDescription as $description)
	<div class="modal fade" id="Modal-Desc-{{ $description->id }}" tabindex="-1" role="dialog" aria-labelledby="Label-{{ $description->id }}" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ date('d M Y',strtotime($description->date)) }}</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="update-desc" method="post" action="{{ route($pages['description']['update'], $description) }}">
						@method('PUT')
						@csrf

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Date</label>
									<input required readonly value="{{ date('Y-m-d',strtotime($description->date)) }}" class="form-control" type="date" placeholder="Date" name="date" id="date">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Description <button class="btn btn-primary btn-xs" type="button" id="addDesc"><i class="fa fa-plus"></i></button></label>
									<table style="width: 100%;">
										<tbody id="forParamsDesc">
											@foreach(json_decode($description->descriptions, true) as $key => $value)
											<tr>
												<td style="width:5%;">
													<button class="btn btn-danger btn-xs deleteDesc" type="button"><i class="fa fa-trash"></i></button>
												</td>
												<td style="width:95%;">
													<input value="{{ $value }}" class="form-control" type="text" placeholder="Description" name="descriptions[]">
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" form="update-desc" type="button">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<div class="modal fade" id="Modal-Desc-Add" tabindex="-1" role="dialog" aria-labelledby="Label-Add" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Description</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="add-desc" method="post" action="{{ route($pages['description']['store'], $data->id) }}">
						@csrf

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Date</label>
									<input required value="{{ old('date') }}" class="form-control" type="date" placeholder="Date" name="date" id="date">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Description <button class="btn btn-primary btn-xs" type="button" id="addDesc"><i class="fa fa-plus"></i></button></label>
									<table style="width: 100%;">
										<tbody id="forParamsDesc">
											@php($i = 1)
											@php($x = 1)
											@foreach($paramsDesc as $key => $value)
											<tr>
												<td style="width:5%;">
													<button class="btn btn-danger btn-xs deleteDesc" type="button"><i class="fa fa-trash"></i></button>
												</td>
												<td style="width:95%;">
													<input value="{{ $value }}" class="form-control" type="text" placeholder="Description" name="descriptions[]">
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" form="add-desc" type="button">Save changes</button>
				</div>
			</div>
		</div>
	</div>

	@foreach($data->ReportPicture as $picture)
	<div class="modal fade" id="Modal-Pics-{{ $picture->id }}" tabindex="-1" role="dialog" aria-labelledby="Label-{{ $picture->id }}" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ date('d M Y',strtotime($picture->date)) }}</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="update-pics-{{ $picture->id }}" method="POST" enctype="multipart/form-data" action="{{ route($pages['picture']['update'], $picture) }}">
						@method('PUT')
						@csrf

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Date</label>
									<input required readonly value="{{ date('Y-m-d',strtotime($picture->date)) }}" class="form-control" type="date" placeholder="Date" name="date" id="date">
								</div>
							</div>
						</div>

						@if($picture->pictures != null)
							@foreach(json_decode($picture->pictures, true) as $key => $value)
							<input type="hidden" name="old_pictures[]" value="{{ $value }}">
							@endforeach
						@endif
						

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Add Picture</label>
									<div class="dropzone dropzone-default dropzone-primary" id="kt_dropzone_{{ $picture->id }}">
										<div class="dropzone-msg dz-message needsclick">
											<h4 class="dropzone-msg-title">Drop files here or click to upload.</h4>
											<span class="dropzone-msg-desc">Upload up to 10 files</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" form="update-pics-{{ $picture->id }}" type="button">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach

	<div class="modal fade" id="Modal-Pics-Add" tabindex="-1" role="dialog" aria-labelledby="Label-Add" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Pictures</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form id="add-pics" method="POST" enctype="multipart/form-data" action="{{ route($pages['picture']['store'], $data->id) }}">
						@csrf

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Date</label>
									<input required value="{{ old('date') }}" class="form-control" type="date" placeholder="Date" name="date" id="date">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<label>Picture</label>
									<div class="dropzone dropzone-default dropzone-primary" id="kt_dropzone_add">
										<div class="dropzone-msg dz-message needsclick">
											<h4 class="dropzone-msg-title">Drop files here or click to upload.</h4>
											<span class="dropzone-msg-desc">Upload up to 10 files</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="submit" form="add-pics" type="button">Save changes</button>
				</div>
			</div>
		</div>
	</div>


</div>

@endsection

@push('script')
<script>
@php($i = 1)
@foreach($paramsDesc as $key => $value)
	$('#deleteDesc-{{ $i++ }}').click(function(){
		$(this).parent().parent().remove();
	});
@endforeach
</script>

<script>
$('.deleteDesc').click(function(){
	$(this).parent().parent().remove();
});
//addDesc to table forParamsDesc
$('#addDesc').click(function(){
	$('#forParamsDesc').append('<tr><td style="width:5%;"><button class="btn btn-danger btn-xs deleteDesc" type="button"><i class="fa fa-trash"></i></button></td><td style="width:95%;"><input class="form-control" type="text" placeholder="Description" name="descriptions[]"></td></tr>');
});	
</script>

<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>

<script>

	Dropzone.autoDiscover = false;

	var uploadedDocumentMap = {}
	$('#kt_dropzone_add').dropzone({
	url: '{{ route("report.uploadPicture") }}',
	maxFiles: 10,
	maxFilesize: 2, // MB
	addRemoveLinks: true,
	acceptedFiles: ".jpeg,.jpg,.png",
	headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
	},
	success: function (file, response) {
		$('#add-pics').append('<input type="hidden" name="pictures[]" value="' + response.name + '">');
		uploadedDocumentMap[file.name] = response.name;
	},
	removedfile: function (file) {
		file.previewElement.remove();
		var name = '';
		if (typeof file.file_name !== 'undefined') {
			name = file.file_name;
		} else {
			name = uploadedDocumentMap[file.name];
		}
		RemoveFile(name);
		$('#add-pics').find('input[name="pictures[]"][value="' + name + '"]').remove();
	},
	// init: function () {
	// 	@if(isset($project) && $project->document)
	// 	var files = {!! json_encode($project->document) !!};
	// 	for (var i in files) {
	// 		var file = files[i];
	// 		this.options.addedfile.call(this, file);
	// 		file.previewElement.classList.add('dz-complete');
	// 		$('#add-pics').append('<input type="hidden" name="pictures[]" value="' + file.file_name + '">');
	// 	}
	// 	@endif
	// }
	});

</script>



@foreach($data->ReportPicture as $picture)
	<script>
		Dropzone.autoDiscover = false;

		var uploadedDocumentMap = {}
		$('#kt_dropzone_{{ $picture->id }}').dropzone({
		url: '{{ route("report.uploadPicture") }}',
		maxFiles: 10,
		maxFilesize: 2, // MB
		addRemoveLinks: true,
		acceptedFiles: ".jpeg,.jpg,.png",
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},
		success: function (file, response) {
			$('#update-pics-{{ $picture->id }}').append('<input type="hidden" name="pictures[]" value="' + response.name + '">');
			uploadedDocumentMap[file.name] = response.name;
		},
		removedfile: function (file) {
			file.previewElement.remove()
			var name = ''
			if (typeof file.file_name !== 'undefined') {
				name = file.file_name
			} else {
				name = uploadedDocumentMap[file.name]
			}
			RemoveFile(name);
			$('#update-pics-{{ $picture->id }}').find('input[name="pictures[]"][value="' + name + '"]').remove()
		},
		});
	</script>
@endforeach

<script>
function RemoveFile(filename){
	LoadingOn();
	var _token = "{{ csrf_token() }}";
	$.ajax({
		url:"{{ route('report.removePicture') }}",
		method:"POST",
		data: { filename : filename, _token:_token },
		success:function(data)
		{
			if(data.success == true){
				iziToast.success({
					title: 'Success',
					message: 'File has been deleted!',
				});
			} else {
				iziToast.error({
					title: 'Error',
					message: 'File has been deleted!',
				});
			}
			LoadingOff();
		}
	});
}
</script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script>
	Fancybox.bind("[data-fancybox]", {
  // Your options go here
	});
</script>

<script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
@endpush
