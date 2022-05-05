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
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Name</label>
										<input value="{{ old('name') }}" class="form-control" type="text" placeholder="Full Name" name="name" id="name">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									<div class="mb-3">
										<label class="form-label" for="username">Description</label>
										<textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Slug</label>
										<input value="{{ old('slug') }}" class="form-control" type="text" placeholder="Slug" id="slug" name="slug">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="mb-3">
										<label>Level</label>
										<select class="form-select" name="level" id="level">
											<option value="">- Choice Level -</option>
											@foreach ($levels as $level)
												<option value="{{ $level->level }}" @if(old('level')==$level->level) selected @endif>{{  $level->level }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Class</label>
										<input value="{{ old('class') }}" class="form-control" type="text" placeholder="class" id="class" name="class">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="mb-3">
										<label>View</label><br>
										<span id="viewClass" class="">badge badge-secondary</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="text-end">
										<a class="btn" href="{{ route($pages['index']) }}">Back</a>
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
