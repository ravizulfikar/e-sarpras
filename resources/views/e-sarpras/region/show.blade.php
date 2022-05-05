@extends('layouts.simple.master')

@section('title', $pages['show']['title'] ?? '-' )

@push('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/mapsjs-ui.css')}}">
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
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-6">
							<h5>{{ $data->name }}</h5>
							<span>
								({{ $data->code }} - {{ $data->city }}) 
								<br>{{ RenderJson($data->detail, 'address') }}, {{ RenderJson($data->detail, 'postal_code') }}
								<br>{{ RenderJson($data->detail, 'telphone') }} | {{ RenderJson($data->detail, 'email') }}
							</span>
						</div>
						<div class="col-6 text-end">
							<a class="btn" href="{{ route($pages['index']) }}">Back</a>
							<a href="{{ route($pages['edit']['url'], $data) }}" class="btn btn-pill btn-info btn-air-info"><i class="fa fa-pencil"></i> Edit Data</a>
						</div>
					</div>
				</div>
				<div class="card-body">
                    <div class="map-js-height" id="mapData"></div>
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

	


	// map12
	function addMarkersToMap(map, dataLat) {
		var dataLat = {{ $data->latitude }};
		var dataLong = {{ $data->longitude }};

		var londonMarker = new H.map.Marker({lat:dataLat, lng:dataLong});
		map.addObject(londonMarker);
	}

	var map = new H.Map(document.getElementById('mapData'), defaultLayers.normal.map,{
		center: {lat:{{ $data->latitude }}, lng:{{ $data->longitude }}},
		zoom: 15,
		pixelRatio: pixelRatio
	});

	var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

	var ui = H.ui.UI.createDefault(map, defaultLayers);

	addMarkersToMap(map);
});
</script>
@endpush
