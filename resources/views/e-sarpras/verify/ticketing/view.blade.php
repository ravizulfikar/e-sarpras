@extends('layouts.simple.master')

@section('title', $pages['ticketing']['show']['title'] ?? '-' )

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
<h3>{{ $pages['ticketing']['show']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route($pages['ticketing']['index']) }}">{{ $pages['ticketing']['title'] }}</a></li>
<li class="breadcrumb-item active">{{ $pages['ticketing']['show']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row project-cards">
		<div class="col-md-12">
			<div class="card p-4">
				<div class="row">
					<div class="col-md-6">

						@if($data->verification == 'kasubbag')
																
							<a href="#" disabled class="btn btn-success">Verified</a><br>

						@elseif($data->verification == 'kasatpel')

							@if(in_array(auth()->user()->role->slug, ['kasatpel']))
								<a href="#" disabled class="btn btn-success">Verified</a><br>
							@elseif(in_array(auth()->user()->role->slug, ['kasubbag']))
								<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-info verify">Verify Now</a><br>
							@endif

						@else

							@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
								@if($data->SignerTickets->sign != null)
									<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-info verify">Verify Now</a>
								@endif

								<a href="#" data-action="{{ route($pages['ticketing']['reSign'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-danger resign">Re Sign</a>
							@else

							<a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-info verify">Verify Now</a>

							@endif
							

						@endif

						{{-- <a href="#" data-action="{{ route($pages['ticketing']['verifyNow'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-primary verify">Verify Now</a>
						<a href="#" data-action="{{ route($pages['ticketing']['reSign'], $data) }}" data-id="{{ $data->id }}" data-method="PUT" class="btn btn-success resign">Re Sign</a> --}}
					</div>
					<div class="col-md-6">
						<a href="{{ route($pages['ticketing']['index']) }}" class="btn btn-warning pull-right">Back</a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card">
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')
					<div class="row">
						<div class="col-sm-3">
							Token
						</div>

						<div class="col-sm-3">
							Date
						</div>

						<div class="col-sm-4">
							Status
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
							<h5>{!! StatusBadge($data->status) !!}</h5>
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
						<div class="col-sm-6">
							Category
						</div>
						<div class="col-sm-6">
							Type
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-6">
							<h5>{{ $data->category }}</h5>
						</div>
						<div class="col-sm-6">
							<h5>{!! TypeBadge($data->type) !!}</h5>
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
					
				</div>
			</div>
		</div>
	</div>


	
</div>
@endsection

@push('script')


@endpush
