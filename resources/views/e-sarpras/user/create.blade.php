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
								<div class="col">
									<div class="mb-3">
										<label>Full Name</label>
										<input value="{{ old('name') }}" class="form-control" type="text" placeholder="Full Name" name="name" id="name">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label class="form-label" for="username">Username</label>
										<input value="{{ old('username') }}" class="form-control" id="username" type="text" name="username" placeholder="Username">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="mb-3">
										<label class="form-label" for="email">E-Mail Address</label>
										<input value="{{ old('email') }}" class="form-control" id="email" type="email" name="email" placeholder="Email Address">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Position</label>
										<input value="{{ old('profile.jabatan') }}" class="form-control" type="text" placeholder="Position" id="profile.jabatan" name="profile[jabatan]">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-3">
										<label>Role</label>
										<select class="form-select" name="role_id" id="role_id">
											<option value="">- Choice Role -</option>
											@foreach ($roles as $role)
												<option value="{{ $role->id }}" @if(old('role_id')==$role->id) selected @endif>{{  $role->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="text-end">
										<a style="margin-right:30px;" href="{{ route($pages['index']) }}">Back</a>
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
	// const btnSubmit = document.getElementById('submit-form');

	const valueUsername = $('username').val();
	const contUsername = document.getElementById('contUsername');

	const valueEmail = $('email').val();
	const contEmail = document.getElementById('contEmail');

	// window.addEventListener('load', function() {
	// 	var forms = document.getElementsByClassName('needs-validation');
	// 	var validation = Array.prototype.filter.call(forms, function(form) {
	// 		form.addEventListener('submit', function(event) {
	// 			LoadingOn();

	// 			if (form.checkValidity() === false) {
	// 				event.preventDefault();
	// 				event.stopPropagation();

	// 				// btnSubmit.disabled = true;
	// 			}

	// 			if(valueUsername == '' || valueUsername == null) {
	// 				invalid(contUsername);
	// 				contUsername.innerHTML = 'Username is required!';
	// 			} else {
	// 				fetchUser('username', valueUsername);
	// 			}

	// 			if(valueEmail == '' || valueEmail == null) {
	// 				invalid(contEmail);
	// 				contEmail.innerHTML = 'E-Mail Address is required!';
	// 			} else {
	// 				fetchUser('email', valueEmail);
	// 			}

	// 			return false;
	// 			// form.classList.add('was-validated');

	// 			LoadingOff();
	// 		}, false);
	// 	});
	// }, false);

	function invalid(container){
		container.classList.add("invalid-feedback");
		container.classList.add("text-danger");
	}

	function valid(container){
		container.classList.add("valid-feedback");
		container.classList.add("text-success");
	}

	// function checkValidityUser(){
	// 	const valueUsername = $('username').val();
	// 	const contUsername = document.getElementById('contUsername');

	// 	const valueEmail = $('email').val();
	// 	const contEmail = document.getElementById('contEmail');

	// 	if(valueUsername == '' || valueUsername == null) {
	// 		invalid(contUsername);
	// 		contUsername.innerHTML = 'Username is required!';
	// 	}

	// 	if(valueEmail == '' || valueEmail == null) {
	// 		invalid(contEmail);
	// 		contEmail.innerHTML = 'E-Mail Address is required!';
	// 	}
	// }

	// function fetchUser(type, value){
	// 	const urlWeb = '/user/' + type + '/' + value;

    //     $.ajax({
    //         url: "{{ url("+urlWeb+") }}",
    //         type: 'GET',
    //         success: function(response){
    //             console.log(response);
	// 			// return false;
    //         },
    //         error: function(response){
    //             swal("Server Error Detected !!", {
    //                 icon: "error",
    //             });

    //             LoadingOff();
    //         }
    //     });

        
    // }
});
</script>
@endpush
