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
			
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<form class="needs-validation" novalidate="" method="POST" action="{{ route($pages['edit']['update'], $data->id) }}" autocomplete="off" id="submitForm">

							@method('PUT')
							@csrf

							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label>Name</label>
										<input value="{{ $data->name }}" class="form-control" type="text" placeholder="Name Region" name="name" id="name">
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label class="form-label" for="username">Address</label>
										<textarea class="form-control" name="detail[address]" id="detail.address" rows="3">{{ RenderJson($data->detail, "address") }}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Latitude</label>
										<input value="{{ $data->latitude }}" class="form-control" type="text" placeholder="Name Latitude" name="latitude" id="latitude">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="mb-3">
										<label>Longitude</label>
										<input value="{{ $data->longitude }}" class="form-control" type="text" placeholder="Name Longitude" name="longitude" id="longitude">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="mb-3">
										<label>Code</label>
										<input value="{{ $data->code }}" class="form-control" type="text" placeholder="Code Region" name="code" id="code">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>City</label>
										<select class="form-select" name="city" id="city">
											<option value="">- Choice City -</option>
											@foreach ($cities as $key=>$valueCity)
												<option value="{{ $valueCity }}" @if($data->city==$valueCity) selected @endif>{{  $valueCity }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>Region Levels</label>
										<select class="form-select" name="level" id="level">
											<option value="">- Choice Level -</option>
											@foreach ($levels as $key=>$RegionLevel)
												<option value="{{ $RegionLevel }}" @if($data->level==$RegionLevel) selected @endif>{{  $RegionLevel }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="mb-3">
										<label>Postal Code</label>
										<input value="{{ RenderJson($data->detail, "postal_code") }}" class="form-control" type="text" placeholder="Postal Code" id="detail.postal_code" name="detail[postal_code]">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>Telphone</label>
										<input value="{{ RenderJson($data->detail, "telphone") }}" class="form-control" type="text" placeholder="Telphone" id="detail.telphone" name="detail[telphone]">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>Email</label>
										<input value="{{ RenderJson($data->detail, "email") }}" class="form-control" type="text" placeholder="Email Office" id="detail.email" name="detail[email]">
									</div>
								</div>
							</div>

						</form>

						<div class="row m-t-30">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-body">
										<div class="map-js-height" id="map13"></div>
									</div>
								</div>
							</div>
						</div>
						
					</div>

					<div class="card-footer text-end">
						<a style="margin-right:30px;" href="{{ route($pages['index']) }}">Back</a>
						<button class="btn btn-primary btn-block" type="submit" form="submitForm">Update</button>
					</div>
				</div>
			</div>

			
		</div>

	

</div>

@endsection

@push('script')

<script src="{{asset('assets/js/map-js/mapsjs-core.js')}}"></script>
<script src="{{asset('assets/js/map-js/mapsjs-service.js')}}"></script>
<script src="{{asset('assets/js/map-js/mapsjs-ui.js')}}"></script>
<script src="{{asset('assets/js/map-js/mapsjs-mapevents.js')}}"></script>
<script>
$(function() {
	// Common settings

	var platform = new H.service.Platform({
		app_id: 'devportal-demo-20180625',
		app_code: '9v2BkviRwi9Ot26kp2IysQ',
		useHTTPS: true
	});

	var pixelRatio = window.devicePixelRatio || 1;

	var defaultLayers = platform.createDefaultLayers({
		tileSize: pixelRatio === 1 ? 256 : 512,
		ppi: pixelRatio === 1 ? undefined : 320
	});

	
	// map13
	function addDraggableMarker(map, behavior){
		var marker = new H.map.Marker({lat:{{ $data->latitude }}, lng:{{ $data->longitude }}});
		marker.draggable = true;
		map.addObject(marker);
		map.addEventListener('dragstart', function(ev) {
			var target = ev.target;
			if (target instanceof H.map.Marker) {
				behavior.disable();
			}
		}, false);
		map.addEventListener('dragend', function(ev) {
			var target = ev.target;
			if (target instanceof mapsjs.map.Marker) {
				behavior.enable();
			}
		}, false);
		map.addEventListener('drag', function(ev) {
			var target = ev.target,
				pointer = ev.currentPointer;
			if (target instanceof mapsjs.map.Marker) {
				target.setPosition(map.screenToGeo(pointer.viewportX, pointer.viewportY));
				console.log([target.b.lat, target.b.lng]);
				setLatLng(target.b.lat, target.b.lng);
			}
		}, false);
	}

	var map = new H.Map(document.getElementById('map13'), defaultLayers.normal.map,{
		center: {lat:{{ $data->latitude }}, lng:{{ $data->longitude }}},
		zoom: 15,
		pixelRatio: pixelRatio
	});

	var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

	var ui = H.ui.UI.createDefault(map, defaultLayers, 'en-US');

	addDraggableMarker(map, behavior);

	function setLatLng(Lat, Lng){
		$('#latitude').val('');
		$('#longitude').val('');
		$('#latitude').val(Lat);
		$('#longitude').val(Lng);
	}
});
</script>


@endpush
