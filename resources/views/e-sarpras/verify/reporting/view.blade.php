@extends('layouts.simple.master')

@section('title', $pages['reporting']['show']['title'] ?? '-' )

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
@endpush

@section('breadcrumb-title')
	<h3>{{ $pages['reporting']['show']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
	<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
	<li class="breadcrumb-item"><a href="{{ route($pages['reporting']['index']) }}">{{ $pages['reporting']['title'] ?? '-' }}</a></li>
	<li class="breadcrumb-item active">{{ $pages['reporting']['show']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row project-cards">
		<div class="col-md-12">
			<div class="card p-4">
				<div class="row">
					<div class="col-md-6">
						@if($data->verification == 'kabid')

								<a href="#" disabled class="btn btn-success">Verified</a><br>

						@elseif($data->verification == 'kasubbag')

							@if(in_array(auth()->user()->role->slug, ['kasatpel', 'kasubbag']))
								<a href="#" disabled class="btn btn-success">Verified</a><br>
							@elseif(in_array(auth()->user()->role->slug, ['kabid']))
								<a href="#" data-action="{{ route($pages['reporting']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-info verify">Verify Now</a><br>
							@endif

						@elseif($data->verification == 'kasatpel')

							@if(in_array(auth()->user()->role->slug, ['kasatpel']))
								<a href="#" disabled class="btn btn-success">Verified</a><br>
							@elseif(in_array(auth()->user()->role->slug, ['kasubbag']))
								<a href="#" data-action="{{ route($pages['reporting']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-info verify">Verify Now</a><br>
							@endif

						@else

							<a href="#" data-action="{{ route($pages['reporting']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-info verify">Verify Now</a><br>

						@endif


					</div>
					<div class="col-md-6">
						<a href="{{ route($pages['reporting']['index']) }}" class="btn btn-warning pull-right">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5 class="pull-left">Report {{ MonthName($data->month) }} {{ $data->year }} - {{ UserName($data->user_id) }}</h5>
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
								@include($pages['folder'].'.reporting.show.description')
							</div>
							<div class="tab-pane fade" id="pills-pics" role="tabpanel" aria-labelledby="pills-pics-tab">
								@include($pages['folder'].'.reporting.show.picture')
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



</div>

@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script>
	Fancybox.bind("[data-fancybox]", {
  // Your options go here
	});
</script>
@endpush
