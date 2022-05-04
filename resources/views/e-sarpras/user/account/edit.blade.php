@extends('layouts.simple.master')

@section('title', $pages['edit']['title'] ?? '-' )

@push('css')
<style>
#profile-upload{
    background-size:cover;
    background-position: center;
    height: 150px; width: 150px;
    border: 1px solid #bbb;
	position:relative;
  	border-radius:250px;
  	overflow:hidden;
}

#profile-upload:hover input.upload{
  display:block;
}

#profile-upload:hover .hvr-profile-img{
  display:inline-block;
}

#profile-upload .fa{   
	background-color: #fff;
	margin: auto;
    position: absolute;
    bottom: -4px;
    left: 0;
    text-align: center;
    right: 0;
    padding: 6px;
   	opacity:1;
  	transition:opacity 1s linear;
   -webkit-transform: scale(.75); 
}

#profile-upload:hover .fa{
   opacity:1;
   -webkit-transform: scale(1); 
}

#profile-upload input.upload {
    z-index:1;
    left: 0;
    margin: 0;
    bottom: 0;
    top: 0;
    padding: 0;
    opacity: 0;
    outline: none;
    cursor: pointer;
    position: absolute;
    background:#ccc;
    width:100%;
    display:none;
}

#profile-upload .hvr-profile-img {
  width:100%;
  height:100%;
  display: none;
  position:absolute;
  vertical-align: middle;
  position: relative;
  background: transparent;
 }
#profile-upload .fa:after {
    content: "";
    position:absolute;
    bottom:0; left:0;
    width:100%; height:0px;
    background:rgba(0,0,0,0.3);
    z-index:-1;
    transition: height 0.3s;
    }

#profile-upload:hover .fa:after { height:100%; }
</style>
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['edit']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $pages['edit']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	@include('layouts.simple.spinner')

		<div class="row">
			
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<form class="needs-validation" novalidate="" method="POST" action="{{ route($pages['edit']['update'], $data->id) }}" autocomplete="off" id="submitForm" enctype="multipart/form-data">

							@method('PUT')
							@csrf

							<div class="row">
								<div class="col-xl-3">
									<div class="row mb-2">
										<div class="profile-title">
											<div class="text-center">
												<center>
													<div id='profile-upload' style="background-image:url('{{ asset('uploads/avatar/'.RenderJson($data->profile, "photo", 'safari.png')) }}');">
														<div class="hvr-profile-img">
															<input type="file" name="image" id='getval' class="upload w180" id="imag" accept=".jpeg,.png,.jpg">
														</div><span class="text-primary"><i class="fa fa-camera"></i></span>
													</div>
												</center>

												<br>

												<a class="btn btn-success btn-block" href="{{ route($pages['show']['url'], $data) }}">View User Profile</a>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-9">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label">Full Name</label>
												<input required class="form-control" type="text" name="name" value="{{ $data->name }}">
											</div>
										</div>

										<div class="col-md-6">
											<div class="mb-3">
												<label class="form-label">Position</label>
												<input required class="form-control" type="text" id="profile.jabatan" name="profile[jabatan]" value="{{ RenderJson($data->profile, "jabatan") }}">
											</div>
										</div>

										<div class="col-md-6">
											<div class="mb-3">
												<label class="form-label">Hanphone/Whatsapp</label>
												<input required class="form-control" type="text" id="profile.no_hp" name="profile[no_hp]" value="{{ RenderJson($data->profile, "no_hp") }}">
											</div>
										</div>

										

										

									</div>
									<hr>
									<div class="row">

										<div class="col-md-6">
											<div class="mb-3">
												<label class="form-label">Email-Address</label>
												<input required class="form-control" type="email" name="email" value="{{ $data->email }}">
											</div>
										</div>

										<div class="col-md-6">
											<div class="mb-3">
												<label class="form-label">Username</label>
												<input required class="form-control" type="text" name="username" value="{{ $data->username }}">
											</div>
										</div>

										<div class="col-sm-6">
											<div class="mb-3">
												<label>Role</label>
												<select class="form-select" name="role_id" id="role_id">
													<option value="">- Choice Role -</option>
													@foreach ($roles as $role)
														<option value="{{ $role->id }}" @if($data->role_id==$role->id) selected @endif>{{  $role->name }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input class="form-control" type="password" name="password">
											</div>
										</div>

										<div class="col-sm-2">
											<div class="mb-3 text-start">
												<label class="">Confirmed</label>
												<div class="media-body icon-state switch-outline">
													<label class="switch">
														<input type="checkbox" @if($data->confirmed == true) checked @endif name="confirmed"><span class="switch-state bg-primary"></span>
													</label>
												</div>
											</div>
										</div>

										<div class="col-sm-2">
											<div class="mb-3 text-start">
												<label class="">Active</label>
												<div class="media-body icon-state switch-outline">
													<label class="switch">
														<input type="checkbox" @if($data->active == true) checked @endif name="active"><span class="switch-state bg-primary"></span>
													</label>
												</div>
											</div>
										</div>


									</div>
								</div>
							</div>
						</form>
						
					</div>

					<div class="card-footer text-end">
						<a class="btn" href="{{ route('user.account', $data->username) }}">Back</a>
						<button class="btn btn-primary btn-block" type="submit" form="submitForm">Update</button>
					</div>
				</div>
			</div>

			
		</div>

	

</div>

@endsection

@push('script')
<script>
	document.getElementById('getval').addEventListener('change', readURL, true);
	function readURL(){
		var file = document.getElementById("getval").files[0];
		var reader = new FileReader();
		reader.onloadend = function(){
			document.getElementById('profile-upload').style.backgroundImage = "url(" + reader.result + ")";        
		}
		if(file){
			reader.readAsDataURL(file);
		}else{
		}
	}
</script>
@endpush
