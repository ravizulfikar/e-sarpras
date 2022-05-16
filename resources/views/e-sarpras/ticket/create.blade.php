@extends('layouts.simple.master')

@section('title', $pages['create']['title'] ?? '-' )

@push('css')
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['create']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route($pages['index']) }}">{{ $pages['title'] ?? '-' }}</a></li>
<li class="breadcrumb-item active">{{ $pages['create']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				{{-- <div class="card-header"></div> --}}
				<div class="card-body">

                    <div class="form theme-form justify-content-center align-items-center">

					@include('layouts.simple.spinner')

						<form class="needs-validation" novalidate="" method="POST" action="{{ route($pages['create']['store']) }}" autocomplete="off">
							{{-- @method('POST') --}}
							@csrf

							


							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label>Name</label>
										<input value="{{ old('name') }}" class="form-control" type="text" placeholder="Name Region" name="name" id="name">
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label class="form-label" for="username">Address</label>
										<textarea class="form-control" name="detail[address]" id="detail.address" rows="3">{{ old('detail.address') }}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Latitude</label>
										<input value="{{ old('latitude') }}" class="form-control" type="text" placeholder="Name Latitude" name="latitude" id="latitude">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="mb-3">
										<label>Longitude</label>
										<input value="{{ old('longitude') }}" class="form-control" type="text" placeholder="Name Longitude" name="longitude" id="longitude">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="mb-3">
										<label>Code</label>
										<input value="{{ old('code') }}" class="form-control" type="text" placeholder="Code Region" name="code" id="code">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>City</label>
										<select class="form-select" name="city" id="city">
											<option value="">- Choice City -</option>
											@foreach ($cities as $key=>$valueCity)
												<option value="{{ $valueCity }}" @if(old('city')==$valueCity) selected @endif>{{  $valueCity }}</option>
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
												<option value="{{ $RegionLevel }}" @if(old('level')==$RegionLevel) selected @endif>{{  $RegionLevel }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-4">
									<div class="mb-3">
										<label>Postal Code</label>
										<input value="{{ old('detail.postal_code') }}" class="form-control" type="text" placeholder="Postal Code" id="detail.postal_code" name="detail[postal_code]">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>Telphone</label>
										<input value="{{ old('detail.telphone') }}" class="form-control" type="text" placeholder="Telphone" id="detail.telphone" name="detail[telphone]">
									</div>
								</div>

								<div class="col-sm-4">
									<div class="mb-3">
										<label>Email</label>
										<input value="{{ old('detail.email') }}" class="form-control" type="text" placeholder="Email Office" id="detail.email" name="detail[email]">
									</div>
								</div>
							</div>

							

							<div class="row">
								<div class="col">
									<div class="text-end">
										<a  style="margin-right:30px;" href="{{ route($pages['index']) }}">Back</a>
										<button type="submit" class="btn btn-info">Add</button>
									</div>
								</div>
							</div>
						</form>
                    </div>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection

@push('script')
<script>
$(function() {

});
</script>
@endpush
