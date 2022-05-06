@extends('layouts.simple.master')

@section('title', $pages['edit']['title'] ?? '-' )

@push('css')
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['edit']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route($pages['index']) }}">{{ $pages['title'] ?? '-' }}</a></li>
<li class="breadcrumb-item active">{{ $pages['edit']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	@include('layouts.simple.spinner')

		<div class="row">
			
			<div class="col-xl-6">
				<div class="card">
					<div class="card-body">
						<form class="needs-validation" novalidate="" method="POST" action="{{ route($pages['edit']['update'], $data->id) }}" autocomplete="off" id="submitForm">

							@method('PUT')
							@csrf

							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label>Name</label>
										<input value="{{ $data->name }}" class="form-control" type="text" placeholder="Holiday Name" name="name" id="name">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label>Date</label>
										<input value="{{ date_format(date_create($data->date), 'Y-m-d') }}" class="form-control" type="date" placeholder="Date" id="date" name="date">
									</div>
								</div>

							</div>

							<div class="row">

								<div class="col-sm-6">
									<div class="mb-3 text-start">
										<label class="">Is Holiday?</label>
										<div class="media-body icon-state switch-outline">
											<label class="switch">
												<input type="checkbox" @if($data->is_holiday == true) checked @endif name="is_holiday" id="is_holiday"><span class="switch-state bg-primary"></span>
											</label>
										</div>
									</div>
								</div>
							</div>

						</form>
						
					</div>

					<div class="card-footer text-end">
						<a class="" style="margin-right:30px;" href="{{ route($pages['index']) }}">Back</a>
						<button class="btn btn-primary btn-block" type="submit" form="submitForm">Update</button>
					</div>
				</div>
			</div>

			
		</div>

	

</div>

@endsection

@push('script')
<script>
$(function() {
	//Slug From Name
	$('#name').on('keyup', function() {
		var name = $(this).val();
		var slug = name.toLowerCase();
		slug = slug.replace(/ /g, '-');
		$('#slug').val(slug);
	});

	function delay(callback, ms) {
		var timer = 0;
		return function() {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
			callback.apply(context, args);
			}, ms || 0);
		};
	}

	$('#class').keyup(delay(function (e) {
		var className = $(this).val();
		$('#viewClass').removeClass();
		$('#viewClass').text(className);
		$('#viewClass').addClass(className);
	}, 1500));

});
</script>
@endpush
