@extends('layouts.simple.master')

@section('title', $pages['admin']['view']['title'] ?? '-' )

@push('css')
<style>
#signature {
	width: 400px;
	height: 400px;
	border: 1px solid black;
}

</style>
@endpush

@section('breadcrumb-title')
<h3>{{ $pages['admin']['view']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route($pages['main']['url']) }}">{{ $pages['main']['title'] }}</a></li>
<li class="breadcrumb-item active">{{ $pages['admin']['finish']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12 box-col-6">
			<div class="card card-absolute">
				<div class="card-header bg-{{ StatusHeader($data->status) }}">
					<h5 class="text-white">{{ $data->status }}</h5>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-sm-3">
							Token
						</div>

						<div class="col-sm-3">
							Date
						</div>

						<div class="col-sm-4">
							Type
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-3">
							<h5>{{ $data->token }}</h5>
						</div>

						<div class="col-sm-3">
							<h5>{{ date('Y-m-d', strtotime($data->date)); }}</h5>
						</div>

						<div class="col-sm-4">
							<h5>{!! TypeBadge($data->type) !!}</h5>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							Location
						</div>

						@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
						<div class="col-sm-3">
							City
						</div>
						@endif
					</div>

					<div class="row mb-3">
						<div class="col-sm-6">
							<h5>{!! Location($data->location, 'unit') !!}</h5>
						</div>

						@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
						<div class="col-sm-3">
							<h5>{!! Location($data->location, 'city') !!}</h5>
						</div>
						@endif
					</div>

					<div class="row">
						<div class="col-sm-12">
							Category
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-12">
							<h5>{{ $data->category }}</h5>
						</div>
					</div>

					@if($data->type == 'troubleshooting' || $data->type == 'server')
						@include('e-sarpras.ticket.view.detail_trouble_server')
					@endif

					@if($data->type == 'monitoring')
						@include('e-sarpras.ticket.view.detail_monitoring')
					@endif



					@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
						<div class="row">
							<div class="col-sm-4">
								Signature
							</div>
							<div class="col-sm-4">
								Signer
							</div>
							<div class="col-sm-3">
								{{ $signer->type_identity }}
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-4">
							@if($signer->sign != null)
								<img src="data:image/png;base64,{{$signer->sign}}" width="200px">
							@else
								-
							@endif
							</div>
							<div class="col-sm-4">
								<h5>{{ $signer->signer }}</h5>
							</div>
							<div class="col-sm-3">
								<h5>{{ $signer->number_identity }}</h5>
							</div>
						</div>
					@endif
					<hr>

					<div class="row">
						<div class="col-sm-12">
							<b>User Process</b>
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-12">
							<table class="table">
								@foreach($userProcess as $user)
								<tr>
									<td>{{ $user->user->name }}</td>
									<td>&nbsp;</td>
								</tr>
								@endforeach
							</table>
						</div>
					</div>
					
					<div class="row m-t-30">
						<div class="col-sm-12">
							<a href="{{ route($pages['main']['url']) }}" class="btn btn-warning">Back</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')


@endpush
