@extends('layouts.simple.master')

@section('title', $pages['process']['title'] ?? '-' )

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
<h3>{{ $pages['process']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route($pages['process']['url']) }}">{{ $pages['process']['title'] ?? '-' }}</a></li>
<li class="breadcrumb-item active">{{ $pages['process']['titleEdit'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	@include('layouts.simple.spinner')

		<div class="row">
			
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body">
						<form class="needs-validation" novalidate="" method="POST" action="{{ route($pages['process']['update'], $data->id) }}" autocomplete="off" id="submitForm">

							@method('PUT')
							@csrf

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
								<div class="col-sm-3">
									City
								</div>

								<div class="col-sm-9">
									Location
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-3">
									<h5>{!! Location($data->location, 'city') !!}</h5>
								</div>

								<div class="col-sm-9">
									<h5>{!! Location($data->location, 'unit') !!}</h5>
								</div>
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

							<div class="row">
								<div class="col-sm-12">
									Detail
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-12">
									<h5>{{ RenderJson($data->detail, 'trouble') }}</h5>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									Solution
								</div>
							</div>

							<div class="row mb-3">
								<div class="col-sm-12">
									<input name="detail[trouble]" type="hidden" value="{{ RenderJson($data->detail, 'trouble') }}">
									<textarea class="form-control" name="detail[solution]" id="detail.solution" rows="3">{{ RenderJson($data->detail, "solution") }}</textarea>
								</div>
							</div>
							
							@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
								<div class="row">
									<div class="col-sm-9">
										Signer
									</div>
								</div>
							

								<div class="row mb-3">
									<div class="col-sm-9">
										<button class="btn btn-danger signBtnBefore" type="button" data-bs-toggle="modal" data-bs-target="#SignTicket">Click to Sign this Ticket</button>
										<button class="btn btn-success signBtnBefore" type="button" data-bs-toggle="modal"  data-bs-target="#SignWhatsapp">Share to Whatsapp</button>


										<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#SignTicket" id="signBtnAfter" style="display:none;">Ticket is Signed !</button>
									</div>
								</div>

								<hr>
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
												<td>Name</td>
												<td>
													<button class="btn btn-info" type="button" data-bs-toggle="modal"  data-bs-target="#btnAddUser">Add User</button>
												</td>
											</tr>
										</thead>
										@foreach($userProcess as $user)
										<tr>
											<td>{{ $user->user->name }}</td>
											<td>&nbsp;</td>
										</tr>
										@endforeach
										<tbody id="tableUserProcess">
											
										</tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-12">
									
								</div>
							</div>

						</form>
						
						<form method="POST" action="{{ route($pages['process']['finish'], $data) }}" id="finishForm">
							@method('PUT')
							@csrf
						</form>
					
						
					</div>

					<div class="card-footer text-end">
						<a style="margin-right:30px;" href="{{ route($pages['process']['url']) }}">Back</a>
						<button class="btn btn-primary btn-block" type="submit" form="submitForm">Update</button>
						<button class="btn btn-success btn-block" type="submit" form="finishForm">Finish</button>
					</div>
				</div>
			</div>
		</div>
</div>

@if($data->type == 'troubleshooting' || $data->type == 'monitoring')
	<div class="modal fade" id="SignTicket" tabindex="-1" role="dialog" aria-labelledby="SignTicketTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="SignTicketTitle">Sign Ticket</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="row">
						<div class="col-sm-12">
							Name
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-12">
							<h5>{{ $signer->signer }}</h5>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							{{ $signer->type_identity }}
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-12">
							<h5>{{ $signer->number_identity }}</h5>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12">
							Signature
							<br>
							<input id='output' name="sign" type="hidden" class="form-control" readonly required><br/>
							@if(!empty($signer->sign))
							<img src="data:image/png;base64,{{$signer->sign}}" id='signAfter' width="200px">
							@endif
							<img src='' id='sign_prev' style="display: none; width:200px;" />
						</div>
					</div>

					<div class="row mb-3">
						<div class="col-sm-12">
							<button class="btn btn-danger" type="button" data-bs-toggle="modal"  data-bs-target="#Signature">Sign</button>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-primary" type="button" id="btnSign" data-action="{{ route('process.signer', $signer) }}" data-id="{{ $signer->id }}">Save Sign</button>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="Signature" tabindex="-1" role="dialog" aria-labelledby="SignatureLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="SignatureLabel">Digital signature</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<center>
						<div id="signature" style=''>
							<canvas id="signature-pad" class="signature-pad" width="400px" height="400px"></canvas>
						</div>
					</center>
					<br/>
				</div>
				<div class="modal-footer">
					<button type="button" id='hapus' class="btn btn-danger button clear" data-action="clear">Clear</button>
					<input type='button' id='click' value='Apply' class="btn btn-secondary" data-dismiss="modal">
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="SignWhatsapp" tabindex="-1" role="dialog" aria-labelledby="SignWhatsappLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="SignWhatsappLabel">Share Sign Ticket</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="row">
						<div class="col-sm-12">
							<div class="mb-3">
								<label>Whatsapp Number</label>
								<input id="whatsapp" class="form-control" type="text" placeholder="Whatsapp Number">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-success" type="button" id="btnShareWhatsapp" data-url="Linknya">Share to Whatsapp</button>
				</div>
			</div>
		</div>
	</div>
@endif
{{-- <div class="modal fade" id="SignTelegram" tabindex="-1" role="dialog" aria-labelledby="SignTelegramLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="SignTelegramLabel">Share Sign Ticket</h5>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body justify-content-center align-items-center">

				@include('layouts.simple.spinner')

				<div class="row">
					<div class="col-sm-12">
						<div class="mb-3">
							<label>Telegram Id</label>
							<input id="telegram" class="form-control" type="text" placeholder="Telegram ID">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-info" type="button" id="btnShareTelegram" data-url="Linknya">Share to Telegram</button>
			</div>
		</div>
	</div>
</div> --}}

<div class="modal fade" id="btnAddUser" tabindex="-1" role="dialog" aria-labelledby="btnAddUserLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="btnAddUserLabel">Add User</h5>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body justify-content-center align-items-center">

				@include('layouts.simple.spinner')

				<div class="col-sm-4">
					<div class="mb-3">
						<label>User</label>
						<select class="form-select" name="user_id" id="user_id">
							<option value="">- Choice Other User -</option>
							@foreach ($paramsUser as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button class="btn btn-info" type="button" id="btnProcessAddUser" data-action="{{ route('process.addUser') }}" data-ticket="{{ $data->id }}">Add</button>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')

<script type="text/javascript">
	$(document).ready(function() {
		@if(!empty($signer->sign))
			$('#signBtnAfter').show();
			$('.signBtnBefore').hide();
		@else
			$('#signBtnAfter').hide();
			$('.signBtnBefore').show();
		@endif
	})
</script>

<script>
$(document).ready(function() {
	//button to share whatsapp
	$('#btnProcessAddUser').click(function() {
		LoadingOn();
		$('#btnAddUser').modal('hide');

		var UserId = $('#user_id').val();
		var UserName = $("#user_id option:selected").text();
		var TicketId = $(this).data('ticket');
		var url = $(this).data('action');

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				_token: '{{ csrf_token() }}',
				ticket_id: TicketId,
				user_id: UserId,
			},
			success: function(data) {
				if(data.success == true){
					iziToast.success({
						message: data.message,
						position: 'topRight'
					});

					//insert to row table
					var row = '<tr>\
							<td>'+UserName+'</td>\
							<td>&nbsp;</td>\
						</tr>';

					$('#tableUserProcess').append(row);

				} else {
					iziToast.error({
						message: data,
						position: 'topRight'
					});
				}
				LoadingOff();
			}
		});
	});

	$("#btnShareWhatsapp").click(function(e) {
		e.preventDefault();

		var nomor = $('#whatsapp').val();
		var url = $(this).data('url');

		if (nomor === '') {
			iziToast.error({
				message: "Number Whatsapp must be Filled !",
				position: 'topRight'
			});
			return false;
		}

		if(!/^[0-9]+$/.test(nomor)){
			iziToast.error({
				message: "Number Whatsapp not valid !",
				position: 'topRight'
			});
			return false;
		}

		var WA = nomor.indexOf('0') == 0 ? nomor.substring(1) : nomor;
		var LinkShare = "https://wa.me/+62" + WA + "?text=" + url;
		window.open(
			LinkShare,
			'_blank'
		);

		$('#SignWhatsapp').modal('hide');
		$('#whatsapp').val('');
	});


	// $("#btnShareTelegram").click(function(e) {
	// 	e.preventDefault();

	// 	var nomor = $('#telegram').val();
	// 	var url = $(this).data('url');

	// 	if (nomor === '') {
	// 		iziToast.error({
	// 			message: "Telegram id must be Filled !",
	// 			position: 'topRight'
	// 		});
	// 		return false;
	// 	}

	// 	// https://telegram.me/share/url?url=<URL>&text=<TEXT>

	// 	// var WA = nomor.indexOf('0') == 0 ? nomor.substring(1) : nomor;
	// 	// var LinkShare = "https://wa.me/+62" + WA + "?text=" + url;
	// 	var LinkShare = "https://telegram.me/share/url?url=" + nomor + "&text=" + url;
	// 	window.open(
	// 		LinkShare,
	// 		'_blank'
	// 	);

	// 	$('#SignTelegram').modal('hide');
	// 	$('#telegram').val('');
	// });

	//send message to telegram with user id

});
</script>

<script src="{{ asset('assets/plugin/spad/docs/js/signature_pad.umd.js') }}"></script>

<script type="text/javascript">

      $(document).ready(function() {
		var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
		var clearButton = document.getElementById('hapus');
		var aplbtn = document.getElementById('click');

		$(aplbtn).click(function(){
				var datattd = signaturePad.toDataURL('image/png');
				var data = datattd.replace(/^data:image\/(png|jpg);base64,/, "");
				$('#output').val(data);
				$("#sign_prev").show();
				$("#sign_prev").attr("src","data:image/png;base64,"+data);
				$("#signAfter").hide();
				$('#Signature').modal('hide');
		});

		$(clearButton).click(function(){
			signaturePad.clear();
		});

      })
</script>

<script>
	$(document).ready(function() {
		//btnSign to post signer_ticket
		$('#btnSign').click(function() {
			LoadingOn();
			$('#SignTicket').modal('hide');

			var current_object = $(this);
			var action = current_object.attr('data-action');
			var dataID = current_object.attr('data-id');
			var dataSign = $('#output').val();
			var data = {
				_token: '{{ csrf_token() }}',
				_method: 'PUT',
				id: dataID,
				sign: dataSign,
				
			};

			$.ajax({
				url: action,
				type: 'PUT',
				data: data,
				success: function(response) {

					if(response.success == true){
						iziToast.success({
							message: response.message,
							position: 'topRight'
						});
					} else {
						iziToast.error({
							message: "Server Error !",
							position: 'topRight'
						});
					}

					$('#signBtnAfter').show();
					$('.signBtnBefore').hide();

					LoadingOff();
				}
			});
		});
	});
</script>

@endpush
