<form id="formSubmit" class="theme-form grid" novalidate="" method="POST" action="{{ route($pages['show']['update'], $data) }}" autocomplete="off">
@method('PUT')
@csrf

	<div class="row">
		<div class="col-sm-3">
			Token
		</div>

		<div class="col-sm-3">
			Date
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-3">
			<h5>{{ $data->token }}</h5>
		</div>

		<div class="col-sm-3">
			<h5>{{ date('Y-m-d', strtotime($data->date)); }}</h5>
		</div>
	</div>

	<div class="form-group row mb-3">
		<div class="col-sm-12">
			<label>Type</label>
			<select class="form-select" name="type" id="type">
			<option value="">- Choice Type -</option>
			@foreach ($typeTicket as $key => $value)
				<option value="{{ $value }}" @if($data->type==$value) selected @endif>{{ ucfirst($value) }}</option>
			@endforeach
			</select>
		</div>
	</div>


	<div class="form-group mb-3 grid-item wow lightSpeedIn" data-wow-duration="0.15s" id="container-locate">
		<label>Location</label>
		<select class="form-select" name="locate" id="locate">
			<option value="">- Choice Location -</option>
			@foreach ($location as $key => $value)
				<option value="{{ $value }}" @if(RenderJson($data->location, "city")==$value) selected @endif>{{ ucfirst($value) }}</option>
			@endforeach
		</select>
	</div>


	<div class="form-group mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-locate-server">
		<label class="col-form-label">Location</label>
		<input class="form-control" type="text" required="" id="location.location" name="location[location]" value="{{ RenderJson($data->location, "location") }}">
	</div>



	<div class="form-group row mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-dinas">
	<div class="col-sm-5">
		<label class="col-form-label">Floor</label>
		<select class="form-select" name="location[floor]" id="location.floor">
		<option value="">- Floor -</option>
		@foreach ($floorUnit as $key => $value)
			<option value="{{ $value }}" @if(RenderJson($data->location, "floor")==$value) selected @endif>{{ ucfirst($value) }}</option>
		@endforeach
		</select>
	</div>

	<div class="col-sm-7">
		<label class="col-form-label">Department</label>
		<input class="form-control" type="text" required="" placeholder="Department" name="location[department]" id="location.department" value="{{ RenderJson($data->location, "department") }}">
	</div>
	</div>


	<div class="form-group mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-region">
		<label class="col-form-label">Unit</label>
		<input class="form-control" type="hidden" name="location[city]" id="location_city" required="" value="{{ RenderJson($data->location, "city") }}">
		<input type="hidden" value="{{ RenderJson($data->location, "unit") }}" id="valueUnit">
		<select class="form-select" name="location[unit]" id="location_unit"></select>
	</div>


	<div class="form-group mb-3" id="container-locate-server">
		<label class="col-form-label">Category</label>
		{{-- <input class="form-control" type="text" required="" id="category" name="category"> --}}
		<input class="form-control" list="categorys" required="" id="category" name="category" value="{{ $data->category }}">
		<datalist id="categorys">
			@foreach($categorys as $category)
			<option value="{{ ucfirst($category->name) }}"> {{ ucfirst($category->name) }} </option>
			@endforeach
		</datalist>
	</div>

	@if($data->type == 'troubleshooting' || $data->type == 'server')
		@include('e-sarpras.ticket.view.trouble_server')
	@endif

	@if($data->type == 'monitoring')
		@include('e-sarpras.ticket.view.monitoring')
	@endif

	@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
		<div id="container-name">
			<div class="row">
				<div class="col-sm-9">
					Signer
				</div>
			</div>
		

			<div class="row mb-3">
				<div class="col-sm-9">
					<button class="btn btn-danger signBtnBefore" type="button" data-bs-toggle="modal" data-bs-target="#SignTicket">Click to Sign this Ticket</button>
					<button class="btn btn-success signBtnBefore" type="button" data-bs-toggle="modal"  data-bs-target="#SignWhatsapp">Share to Whatsapp</button>
					<button class="btn btn-info signBtnBefore" type="button" data-action="{{ route($pages['createUser']['sign'], $data) }}" id="btnCopyAction"><i class="fa fa-copy"></i></button>


					<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#SignTicket" id="signBtnAfter" style="display:none;">Edit Signer</button>
				</div>
			</div>
		</div>
	@endif


	<div class="row">
		<div class="col-sm-12">
			User Process
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-sm-12">
			<table class="table">
				<thead>
					<tr>
						<td colspan="2">Name</td>
					</tr>
				</thead>
				@php($index = 0)
				@foreach($userProcess as $user)
				<tr>
					<td style="width:7%;">
						@if($index > 0)
							@if(auth()->user()->id == $firstUser->user_id)
								<a href="#" class="btn btn-danger btn-xs remove" data-action="{{ route($pages['show']['deleteUser'], $user) }}" data-id="{{$user}}">
									<i class="fa fa-trash"></i>
								</a> 
							@endif
						@else
							@if(auth()->user()->id == $firstUser->user_id)
								<button class="btn btn-info btn-xs" type="button" data-bs-toggle="modal" data-bs-target="#btnAddUser"><i class="fa fa-plus"></i></button>
							@endif
						@endif
					</td>
					<td style="width:93%;">{{ $user->user->name }}</td>
				</tr>
				@php($index++)
				@endforeach
				<tbody id="tableUserProcess">
					
				</tbody>
			</table>
		</div>
	</div>

	
	<div class="form-group m-t-10 pull-right">
		<button class="btn btn-primary btn-block w-90" type="submit" id="btnSubmitForm">Update</button>
	</div>



</form>