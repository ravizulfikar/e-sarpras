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
          <div class="col-md-12 justify-content-center align-items-center">    
            <div class="card">
				<div class="card-header">
				<h5 class="pull-left">History Ticket</h5>
				</div>
				<div class="card-body">
				<div class="tabbed-card">
					<ul class="pull-right nav nav-pills nav-primary" id="pills-clrtab" role="tablist">
					<li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab" data-bs-toggle="pill" href="#pills-clrhome" role="tab" aria-controls="pills-clrhome" aria-selected="true"><i class="icofont icofont-folder-open"></i>Open</a></li>
					<li class="nav-item"><a class="nav-link" id="pills-clrcontact-tab" data-bs-toggle="pill" href="#pills-clrcontact" role="tab" aria-controls="pills-clrcontact" aria-selected="false"><i class="icofont icofont-refresh"></i>Process</a></li>
					<li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab" data-bs-toggle="pill" href="#pills-clrprofile" role="tab" aria-controls="pills-clrprofile" aria-selected="false"><i class="icofont icofont-racing-flag-alt"></i>Finish</a></li>
          <li class="nav-item">
            <a class="nav-link btn btn-warning text-light" href="{{ route('/') }}">
              <i class="icofont icofont-home"></i>Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary text-light" href="{{ route('ticket.createUser') }}">
              <i class="icofont icofont-ticket"></i>Create Ticket
            </a>
          </li>
					</ul>
					<div class="tab-content" id="pills-clrtabContent">
            <div class="tab-pane fade show active" id="pills-clrhome" role="tabpanel" aria-labelledby="pills-clrhome-tab">
            
              <div class="justify-content-center align-items-center">
                @include('layouts.simple.spinner')
                {{-- <div class="table-responsive"> --}}
                  <table class="table table-border-horizontal table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Token</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        {{-- <th scope="col">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody id="htmlOpen"></tbody>
                  </table>
                {{-- </div> --}}
              </div>

            </div>
					<div class="tab-pane fade" id="pills-clrprofile" role="tabpanel" aria-labelledby="pills-clrprofile-tab">
						<div class="tab-pane fade show active" id="pills-clrhome" role="tabpanel" aria-labelledby="pills-clrhome-tab">
            
              <div class="justify-content-center align-items-center">
                @include('layouts.simple.spinner')
                {{-- <div class="table-responsive"> --}}
                  <table class="table table-border-horizontal table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Token</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        {{-- <th scope="col">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody id="htmlFinish"></tbody>
                  </table>
                {{-- </div> --}}
              </div>

            </div>
					</div>
					<div class="tab-pane fade" id="pills-clrcontact" role="tabpanel" aria-labelledby="pills-clrcontact-tab">
						<div class="tab-pane fade show active" id="pills-clrhome" role="tabpanel" aria-labelledby="pills-clrhome-tab">
            
              <div class="justify-content-center align-items-center">
                @include('layouts.simple.spinner')
                {{-- <div class="table-responsive"> --}}
                  <table class="table table-border-horizontal table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Token</th>
                        <th scope="col">Date</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        {{-- <th scope="col">Action</th> --}}
                      </tr>
                    </thead>
                    <tbody id="htmlProcess"></tbody>
                  </table>
                {{-- </div> --}}
              </div>

            </div>
					</div>
					</div>
				</div>
				</div>
			</div>
          </div>
        </div>


        {{-- <div class="row m-0">
          <div class="col-12 p-0">   
            <div class="login-card">
              <div class="wow bounceInDown center"> 
                <h3>History Ticket</h3>
              </div>
            </div>
          </div>
        </div> --}}


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
        $(function() {
          LoadingOn();
          //btnSubmitForm to Localstorage
          var items = JSON.parse(localStorage.getItem("esarpras") || "[]");
          console.log("# of items: " + items.length);

          if(items.length > 0){
            fetchWilayah(items);
          } else {
            htmlOpen += '<tr>\
                      <th scope="row" colspan="5">No Data</th>\
                    </tr>';

            $('#htmlOpen').append(htmlOpen);

            htmlProcess += '<tr>\
                      <th scope="row" colspan="5">No Data</th>\
                    </tr>';

            $('#htmlProcess').append(htmlProcess);

            htmlFinish += '<tr>\
                      <th scope="row" colspan="5">No Data</th>\
                    </tr>';

            $('#htmlFinish').append(htmlFinish);


            LoadingOff();
          }

          items.forEach(function(item, index) {
            console.log("[" + index + "]: " + item);
          });

          // LoadingOff();

          //ajax post data
          function fetchWilayah(items) { 
            $.ajax({
              url: "{{ route('ticket.historyGetUser') }}",
              type: "POST",
              data: {
                "_token": "{{ csrf_token() }}",
                "items": items
              },
              success: function(data) {
                // console.log(data);
                if(data.success == true) {
                  let i = 0;
                  var htmlOpen = '';
                  var OpenTicket = data.data.open;
                  var ProcessTicket = data.data.process;
                  var FinishTicket = data.data.finish;

                  if(OpenTicket.length > 0){
                    OpenTicket.forEach(function(item, index) {
                      htmlOpen += '<tr>\
                        <th scope="row">'+(++i)+'</th>\
                        <td>'+item.token+'</td>\
                        <td>'+moment(item.date).format('LLL')+'</td>\
                        <td>'+TypeBadge(item.type)+'</td>\
                        <td>'+StatusBadge(item.status)+'</td>\
                      </tr>';
                    });
                  } else {
                    htmlOpen += '<tr>\
                      <th scope="row" colspan="5">No Data</th>\
                    </tr>';
                  }

                  $('#htmlOpen').append(htmlOpen);

                  //-Process

                  if(ProcessTicket.length > 0){
                    ProcessTicket.forEach(function(item, index) {
                      htmlProcess += '<tr>\
                        <th scope="row">'+(++i)+'</th>\
                        <td>'+item.token+'</td>\
                        <td>'+item.date+'</td>\
                        <td>'+TypeBadge(item.type)+'</td>\
                        <td>'+StatusBadge(item.status)+'</td>\
                      </tr>';
                    });
                  } else {
                    htmlProcess += '<tr>\
                      <th scope="row" colspan="5">No Data</th>\
                    </tr>';
                  }

                  $('#htmlProcess').append(htmlProcess);

                  //Finish

                  if(FinishTicket.length > 0){
                    FinishTicket.forEach(function(item, index) {
                      htmlFinish += '<tr>\
                        <th scope="row">'+(++i)+'</th>\
                        <td>'+item.token+'</td>\
                        <td>'+item.date+'</td>\
                        <td>'+TypeBadge(item.type)+'</td>\
                        <td>'+StatusBadge(item.status)+'</td>\
                      </tr>';
                    });
                  } else {
                    htmlFinish += '<tr>\
                      <th scope="row" colspan="5">No Data</th>\
                    </tr>';
                  }

                  $('#htmlFinish').append(htmlFinish);

                  
                }
                LoadingOff();
              }
            });
          }


          function TypeBadge(data){
            if(data == 'troubleshooting'){
              return '<span class="badge badge-primary">Troubleshooting</span>';
            } else if(data == 'server'){
              return '<span class="badge badge-success">Server</span>';
            } else if(data == 'monitoring'){
              return '<span class="badge badge-warning">Monitoring</span>';
            } else {
              return '<span class="badge badge-danger">ERROR</span>';
            }
          }

          function StatusBadge(data){
            if(data == 'entry'){
              return '<span class="badge badge-primary">Open</span>';
            } else if(data == 'finish'){
              return '<span class="badge badge-success">Finish</span>';
            } else if(data == 'process'){
              return '<span class="badge badge-warning">Process</span>';
            } else {
              return '<span class="badge badge-danger">ERROR</span>';
            }
          }

        });
      </script>
      
      <script>
        new WOW().init();
      </script>


      {{-- <script>
        $(function() {

          function fetchWilayah(items){
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = '/fetch/wilayah/';

            $.ajax({
              type:'POST',
              url: url,
              dataType: "json",
              success:function(data){
                console.log(data);
                LoadingOff();
              }
            });
          }

        });
      </script> --}}
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
    </div>
  </body>
</html>