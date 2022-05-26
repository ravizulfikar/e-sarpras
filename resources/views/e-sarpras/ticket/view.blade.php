@extends('layouts.simple.master')

@section('title', $pages['show']['title'] ?? '-' )

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
<h3>{{ $pages['show']['title']  ?? '-' }} </h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href="{{ route($pages['dashboard']) }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route($pages['main']['url']) }}">{{ $pages['main']['title'] ?? '-' }}</a></li>
<li class="breadcrumb-item active">{{ $pages['show']['title'] ?? '-' }}</li>
@endsection

@section('content')
<div class="container-fluid">

	<div class="row project-cards">
		<div class="col-md-12 project-list">
			<div class="card">
				<div class="row">
					<div class="col-md-6">
						<ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="top-detail-tab" data-bs-toggle="tab" href="#top-detail" role="tab" aria-controls="top-detail" aria-selected="true"><i class="fa fa-file-text"></i>Detail</a></li>

							<li class="nav-item"><a class="nav-link" id="edit-top-tab" data-bs-toggle="tab" href="#top-edit" role="tab" aria-controls="top-edit" aria-selected="false"><i class="fa fa-pencil"></i> Edit</a></li>

							<li class="nav-item"><a class="nav-link" id="report-top-tab" data-bs-toggle="tab" href="#top-report" role="tab" aria-controls="top-report" aria-selected="false"><i class="fa fa-flag-o"></i> Output Report</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="card">
				<div class="card-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="tab-content" id="top-tabContent">


						<div class="tab-pane fade show active" id="top-detail" role="tabpanel" aria-labelledby="top-detail-tab">
							<div class="row">
								<div class="col-md-12">
									@include($pages['show']['view'].'.detail')
								</div>
							</div>
						</div>
 
						<div class="tab-pane fade" id="top-edit" role="tabpanel" aria-labelledby="edit-top-tab">
							<div class="row">
								<div class="col-md-12">
									@include($pages['show']['view'].'.edit')
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="top-report" role="tabpanel" aria-labelledby="report-top-tab">
							<div class="row">
								<div class="col-md-12">
									<a href="{{ route('output.render', ['ticket', $data->id, "D"]) }}" class="btn btn-primary"><i class="fa fa-download"></i> Download</a>
									<br><br>
									<embed src= "{{ route('output.render', ['ticket', $data->id]) }}" width= "100%" height= "700">
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>

	@include('layouts.simple.spinner')

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
								<input name="signer" id="signer" type="text" class="form-control" value="{{ $signer->signer }}">
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								Type Identity
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-12">
								<select class="form-select" name="type_identity" id="type_identity">
									<option value="">- Type -</option>
									@foreach ($identityType as $key => $value)
									<option value="{{ $value }}" @if($signer->type_identity==$value) selected @endif>{{ ucfirst($value) }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								Number Identity
							</div>
						</div>

						<div class="row mb-3">
							<div class="col-sm-12">
								<input name="number_identity" id="number_identity" type="text" class="form-control" value="{{ $signer->number_identity }}">
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
						<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
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
						<button class="btn btn-success" type="button" id="btnShareWhatsapp" data-url="{{ route($pages['createUser']['sign'], $data) }}">Share to Whatsapp</button>
					</div>
				</div>
			</div>
		</div>
	@endif


	<div class="modal fade" id="btnAddUser" tabindex="-1" role="dialog" aria-labelledby="btnAddUserLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="btnAddUserLabel">Add User</h5>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body justify-content-center align-items-center">

					@include('layouts.simple.spinner')

					<div class="col-sm-12">
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
					var Route = data.route;
					var dataID = data.data;

					iziToast.success({
						message: data.message,
						position: 'topRight'
					});

					//insert to row table
					var row = '<tr><td>\
							@if(auth()->user()->id == $firstUser->user_id)\
							<a href="#" class="btn btn-danger btn-xs remove" data-action="'+Route+'" data-id="'+dataID+'">\
								<i class="fa fa-trash"></i>\
							</a>\
							@endif\
							</td>\
							<td>'+UserName+'</td>\
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

	//button to copy data action
	$('#btnCopyAction').click(function() {
		var url = $(this).data('action');
		console.log(url);
		// url.select();
		navigator.clipboard.writeText(url);
		iziToast.success({
			message: "Link copied to clipboard !",
			position: 'topRight'
		});

	});

	//btnCopyAction to copy text from data action
	
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
			var Signer = $('#signer').val();
			var TypeIdentity = $('#type_identity').val();
			var NumberIdentity = $('#number_identity').val();

			var data = {
				_token: '{{ csrf_token() }}',
				_method: 'PUT',
				id: dataID,
				sign: dataSign,
				signer : Signer,
				type_identity: TypeIdentity,
				number_identity: NumberIdentity,
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

{{-- <script type="text/javascript">
	$(document).ready(function() {
		
	});
</script> --}}


<script type="text/javascript">
	$(document).ready(function() {
		$("#location_unit").select2();

		function hideAll(){
            $('#container-locate').hide();
            $('#container-locate-server').hide();
            $('#container-dinas').hide();
            $('#container-region').hide();
		}

        hideAll();

		function ContainerTroubleshooting(){
			$('#container-locate').show();
			$('#container-locate-server').hide();
			$('#container-detail').show();
			$('#container-name').show();
		}

		function ContainerMonitoring(){
			$('#container-locate').show();
			$('#container-locate-server').hide();
			$('#container-detail').hide();
			$('#container-name').show();
		}

		function ContainerServer(){
			$('#container-locate').hide();
			$('#container-locate-server').show();
			$('#container-detail').show();
			$('#container-name').hide();
		}

		function ContainerHide(){
			$('#container-locate').hide();
			$('#container-locate-server').hide();
			$('#container-detail').hide();
			$('#container-name').hide();
		}

		$('#type').on('change', function() {

              LoadingOn();

              var value = this.value;
              
              if(value == 'troubleshooting'){
                hideAll();
                ContainerTroubleshooting();
              } else if(value == 'monitoring'){
                hideAll();
                ContainerMonitoring();
              } else if(value == 'server'){
                hideAll();
                ContainerServer();
              } else {
                hideAll();
                ContainerHide();
              }

              LoadingOff();
		});

		function LocateDinas(){
			$('#container-dinas').show();
			$('#container-region').hide();
		}

		function LocateNotDinas(){
			$('#container-dinas').hide();
			$('#container-region').show();
		}

		function LocateHide(){
			$('#container-dinas').hide();
			$('#container-region').hide();
		}

		$('#locate').on('change', function() {
			LoadingOn();
			var value = this.value;
			$('#location_city').val(value);
			
			if(value == 'Dinas'){
				LocateDinas();
				LoadingOff();
			} else if(value == 'Jakarta Utara' || value == 'Jakarta Selatan' || value == 'Jakarta Barat' || value == 'Jakarta Timur' || value == 'Jakarta Pusat' || value == 'Kepulauan Seribu') {
				fetchWilayah(value);
				LocateNotDinas();
			} else {
				LocateHide();
				LoadingOff();
			}
		});


		function fetchWilayah(value, LocateUnit){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = '/fetch/wilayah/'+value;

            $.ajax({
              type:'GET',
              url: url,
              dataType: "json",
              success:function(data){
                $('#location_unit').attr('disabled', true);
                $('#location_unit').empty();

                html = '<option value="">- Choice Unit -</option>';

                $.each(data.data, function () {
					if(this.name==LocateUnit){ 
						var selectUnit = "selected";
					}

                  	html += '<option value="'+ this.name +'" '+selectUnit+'>'+ this.name +'</option>';
                });

                $('#location_unit').append(html);
                $('#location_unit').attr('disabled', false);
                LoadingOff();
              }
            });
		}

		//Load All

		var TypeSelect = $('#type').val();
		var LocateSelect = $('#locate').val();
		var LocateUnit = $('#valueUnit').val();

		function LoadType(value){
			LoadingOn();
              
			if(value == 'troubleshooting'){
			hideAll();
			ContainerTroubleshooting();
			} else if(value == 'monitoring'){
			hideAll();
			ContainerMonitoring();
			} else if(value == 'server'){
			hideAll();
			ContainerServer();
			} else {
			hideAll();
			ContainerHide();
			}

			LoadingOff();
		}

		function LoadLocate(value, LocateUnit){
			LoadingOn();
			$('#location_city').val(value);
			
			if(value == 'Dinas'){
				LocateDinas();
				LoadingOff();
			} else if(value == 'Jakarta Utara' || value == 'Jakarta Selatan' || value == 'Jakarta Barat' || value == 'Jakarta Timur' || value == 'Jakarta Pusat' || value == 'Kepulauan Seribu') {
				fetchWilayah(value, LocateUnit);
				LocateNotDinas();
			} else {
				LocateHide();
				LoadingOff();
			}
		}

		LoadType(TypeSelect);
		LoadLocate(LocateSelect, LocateUnit);

		if(TypeSelect == 'troubleshooting'){
			$('#container-detail').show();
			$('#container-name').show();
		} else if(TypeSelect == 'monitoring') {
			$('#container-detail').hide();
			$('#container-name').show();
		} else if(TypeSelect == 'server') {
			$('#container-detail').show();
			$('#container-name').hide();
		}

	});
</script>

<script>
if ($('#CheckOther').is(':checked')) {
	$('#DivOther').show();
} else {
	$('#DivOther').hide();
}

if ($('#CheckRouter').is(':checked')) {
	$('#DivRouter').show();
} else {
	$('#DivRouter').hide();
}

if ($('#CheckTV').is(':checked')) {
	$('.DivTV').show();
} else {
	$('.DivTV').hide();
}

if ($('#CheckAD').is(':checked')) {
	$('.DivAD').show();
} else {
	$('.DivAD').hide();
}

if ($('#CheckNE').is(':checked')) {
	$('.DivNE').show();
} else {
	$('.DivNE').hide();
}

if ($('#CheckAV').is(':checked')) {
	$('.DivAV').show();
} else {
	$('.DivAV').hide();
}

//----------------------------------------------------



$('#CheckRouter').change(function(){
	if ($(this).is(':checked')) {
		$('#DivRouter').show();
	} else {
		$('#DivRouter').hide();
	}
});

$('#CheckOther').change(function(){
	if ($(this).is(':checked')) {
		$('#DivOther').show();
	} else {
		$('#DivOther').hide();
	}
});

$('#CheckTV').change(function(){
	if ($(this).is(':checked')) {
		$('.DivTV').show();
	} else {
		$('.DivTV').hide();
	}
});

$('#CheckAD').change(function(){
	if ($(this).is(':checked')) {
		$('.DivAD').show();
	} else {
		$('.DivAD').hide();
	}
});

$('#CheckNE').change(function(){
	if ($(this).is(':checked')) {
		$('.DivNE').show();
	} else {
		$('.DivNE').hide();
	}
});

$('#CheckAV').change(function(){
	if ($(this).is(':checked')) {
		$('.DivAV').show();
	} else {
		$('.DivAV').hide();
	}
});
</script>
@endpush
