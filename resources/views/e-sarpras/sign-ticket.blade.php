<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>ESarpras TI | History Ticket</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" href="{{ asset('assets/plugin/izitoast/dist/css/iziToast.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

    <style>
      .spinner {
      height: 60px;
      width: 60px;
      margin: auto;
      display: flex;
      position: absolute;
      -webkit-animation: rotation .6s infinite linear;
      -moz-animation: rotation .6s infinite linear;
      -o-animation: rotation .6s infinite linear;
      animation: rotation .6s infinite linear;
      border-left: 6px solid rgba(0, 174, 239, .15);
      border-right: 6px solid rgba(0, 174, 239, .15);
      border-bottom: 6px solid rgba(0, 174, 239, .15);
      border-top: 6px solid rgba(0, 174, 239, .8);
      border-radius: 100%;
      }

      @-webkit-keyframes rotation {
      from {
        -webkit-transform: rotate(0deg);
      }
      to {
        -webkit-transform: rotate(359deg);
      }
      }

      @-moz-keyframes rotation {
      from {
        -moz-transform: rotate(0deg);
      }
      to {
        -moz-transform: rotate(359deg);
      }
      }

      @-o-keyframes rotation {
      from {
        -o-transform: rotate(0deg);
      }
      to {
        -o-transform: rotate(359deg);
      }
      }

      @keyframes rotation {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(359deg);
      }
      }

      #overlay {
        position: absolute;
        display: none;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255,255,255,0.5);
        z-index: 2;
        cursor: pointer;
        border-radius: 25px;
      }
    </style>

  </head>
  <body>
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"><span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->

    <div class="container-fluid"> 
      <div class="justify-content-center align-items-center">
        @include('layouts.simple.spinner')
        
        <div class="row p-20 m-20">
          <div class="col-12">
		  	{{-- {{ dd(json_encode($data->detail)) }} --}}
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
				<div id="container-name">
					<div class="row">
						<div class="col-sm-9">
							Signer
						</div>
					</div>
				

					<div class="row mb-3">
						<div class="col-sm-9">
							<button class="btn btn-danger signBtnBefore" type="button" data-bs-toggle="modal" data-bs-target="#SignTicket">Click to Sign this Ticket</button>
						</div>
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
		@endif

      </div>
      <!-- latest jquery-->
      <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
      <!-- Bootstrap js-->
      <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
      <!-- feather icon js-->
      <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
      <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="{{ asset('assets/js/config.js') }}"></script>
      <!-- Plugins JS start-->
      <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
      <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
      <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
      {{-- <script src="{{ asset('assets/js/animation/wow/wow-init.js') }}"></script> --}}
      <!-- Plugins JS Ends-->
      <script src="{{ asset('assets/plugin/moment/moment.js') }}"></script>
      <script src="{{ asset('assets/plugin/moment/moment-with-locales.js') }}"></script>
      <!-- Theme js-->
      <script src="{{ asset('assets/js/script.js') }}"></script>
      <!-- login js-->
      <!-- Plugin used-->
      <script>
        function LoadingOn() {
          document.getElementById("overlay").style.display = "flex";
        }

        function LoadingOff() {
          document.getElementById("overlay").style.display = "none";
        }
      </script>
      
      <script>
        new WOW().init();
      </script>


      <script src="{{ asset('assets/plugin/izitoast/dist/js/iziToast.min.js')}}"></script>
    
      <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                iziToast.error({
                    message: "{{ $error }}",
                    position: 'bottomRight'
                });
            @endforeach
        @endif

        @if(Session::has('success'))
            iziToast.success({
                message: "{{ session('success') }}",
                position: 'topRight'
            });
        @endif
        
        @if(Session::has('error'))
            iziToast.error({
                message: "{{ session('error') }}",
                position: 'topRight'
            });
        @endif
        
        @if(Session::has('info'))
            iziToast.info({
                message: "{{ session('info') }}",
                position: 'topRight'
            });
        @endif
        
        @if(Session::has('warning'))
            iziToast.warning({
                message: "{{ session('warning') }}",
                position: 'topRight'
            });
        @endif

    </script>

	<script src="{{ asset('assets/plugin/spad/docs/js/signature_pad.umd.js') }}"></script>
	<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>

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
							swal(response.message, {
								icon: "success",
							});

							window.location = '/';
						} else {
							swal("server error!", {
								icon: "error",
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
    </div>
  </body>
</html>