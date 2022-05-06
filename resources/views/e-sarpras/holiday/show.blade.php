@extends('layouts.simple.master')

@section('title', $pages['show']['title'] ?? '-' )

@push('css')
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
	<div class="user-profile">
		<div class="row">
			<div class="col-sm-12 m-t-30">
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 m-t-50">
				<div class="card hovercard text-center">
					{{-- <div class="cardheader"></div> --}}
					<div class="user-image">
						<div class="avatar">
							<img alt="" src="{{ asset('uploads/avatar/'.RenderJson($data->profile, "photo", 'safari.png')) }}">
						</div>
						<div class="icon-wrapper">
							<a href="{{ route($pages['edit']['url'], $data) }}">
								<i class="icofont icofont-pencil-alt-5"></i>
							</a>
						</div>
					</div>

					<div class="info">
						<div class="row text-center">
							<div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">&nbsp;</div>
							<div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
								<div class="user-designation">
									<div class="title"><a target="_blank" href="">{{ $data->name }}</a></div>
									<div class="desc">{{ $data->role->name }}</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">&nbsp;</div>
						</div>
						<hr>
						{{-- <div class="social-media">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="fa fa-rss"></i></a></li>
							</ul>
						</div> --}}
						<div class="follow">
							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Email</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ $data->email }}</div>
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Username</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ $data->username }}</div>
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Position</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ RenderJson($data->profile, "jabatan") }}</div>
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-6 text-md-end border-right">
									<span>Handphone/Whatsapp</span>
								</div>
								<div class="col-6 text-md-start">
									<div class="follow-num counter">{{ RenderJson($data->profile, "no_hp") }}</div>
								</div>
							</div>

						</div>
					</div>

					<br>

					<div class="text-start">
						<a class="btn btn-warning" href="{{ route($pages['index']) }}">Back</a>
					</div>
					
				</div>
			</div>
			
			{{-- <div class="col-md-4 col-lg-4 col-xl-4 box-col-4 m-t-50">
                <div class="card custom-card p-0">
                  <div class="card-header"><img class="img-fluid" src="../assets/images/user-card/1.jpg" alt=""></div>
                  <div class="card-profile"><img class="rounded-circle" src="../assets/images/avtar/3.jpg" alt=""></div>
                  <ul class="card-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                  </ul>
                  <div class="text-center profile-details">
                    <h5>Mark Jecno</h5>
                    <h6>Manager</h6>
                  </div>
                  <div class="card-footer row">
                    <div class="col-4 col-sm-4">
                      <h6>Follower</h6>
                      <h5 class="counter">9564</h5>
                    </div>
                    <div class="col-4 col-sm-4">
                      <h6>Following</h6>
                      <h5><span class="counter">49</span>K</h5>
                    </div>
                    <div class="col-4 col-sm-4">
                      <h6>Total Post</h6>
                      <h5><span class="counter">96</span>M</h5>
                    </div>
                  </div>
                </div>
			</div> --}}
			{{-- <div class="col-sm-12">
				<div class="card">
					<div class="card-header"></div>
					<div class="card-body">

						@include('layouts.simple.spinner')
						<div class="form theme-form justify-content-center align-items-center"></div>
					</div>
				</div>
			</div> --}}
		</div>
	</div>
</div>

@endsection

@push('script')

@endpush
