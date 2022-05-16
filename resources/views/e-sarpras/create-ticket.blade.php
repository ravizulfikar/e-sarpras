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
    <title>ESarpras TI | Create Ticket</title>
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

    <div class="container-fluid p-0"> 
      <div class="justify-content-center align-items-center">
        @include('layouts.simple.spinner')
        
        <div class="row m-0">
          <div class="col-12 p-0">    
            <div class="login-card">
              <div class="wow bounceInDown center">
                <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/login.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>

                <div class="login-main"> 
                  <form id="formSubmit" class="theme-form grid" novalidate="" method="POST" action="{{ route($pages['createUser']['store']) }}" autocomplete="off">

                    @csrf

                    <input class="form-control" type="hidden" name="token" id="token" required="" value="{{ $token }}">

                    <h4>{{ $pages["createUser"]["title"] }}</h4>
                    <p>{{ $pages["createUser"]["description"] }}</p>
                    
                    <div id="step-1" class="wow lightSpeedIn" data-wow-duration="0.15s">
                      {{-- <div class="form-group mb-3">
                        <label class="col-form-label pt-0">Ticket Token</label><br>
                        <h5><b>{{ $token }}</b></h5>
                      </div> --}}

                      <div class="form-group row mb-3">
                        <div class="col-sm-12">
                          <label>Type</label>
                          <select class="form-select" name="type" id="type">
                            <option value="">- Choice Type -</option>
                            @foreach ($typeTicket as $key => $value)
                              <option value="{{ $value }}" @if(old('type')==$value) selected @endif>{{ ucfirst($value) }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>


                      <div class="form-group mb-3 grid-item wow lightSpeedIn" data-wow-duration="0.15s" id="container-locate">
                          <label>Location</label>
                          <select class="form-select" name="locate" id="locate">
                            <option value="">- Choice Location -</option>
                            @foreach ($location as $key => $value)
                              <option value="{{ $value }}" @if(old('locate')==$value) selected @endif>{{ ucfirst($value) }}</option>
                            @endforeach
                          </select>
                      </div>


                      <div class="form-group mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-locate-server">
                          <label class="col-form-label">Location</label>
                          <input class="form-control" type="text" required="" id="location.location" name="location[location]">
                      </div>



                      <div class="form-group row mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-dinas">
                        <div class="col-sm-5">
                          <label class="col-form-label">Floor</label>
                          <select class="form-select" name="location[floor]" id="location.floor">
                            <option value="">- Floor -</option>
                            @foreach ($floorUnit as $key => $value)
                              <option value="{{ $value }}" @if(old('type')==$value) selected @endif>{{ ucfirst($value) }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-sm-7">
                          <label class="col-form-label">Department</label>
                          <input class="form-control" type="text" required="" placeholder="Department" name="location[department]" id="location.department">
                        </div>
                      </div>


                      <div class="form-group mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-region">
                          <label class="col-form-label">Unit</label>
                          <input class="form-control" type="hidden" name="location[city]" id="location_city" required="">
                          <select class="form-select" name="location[unit]" id="location_unit"></select>
                      </div>

                      <div class="form-group mb-3">
                        <button class="btn btn-primary btn-block w-100" type="button" id="btn-step-1"><i class="fa fa-right"></i> Next</button>
                      </div>
                    </div>


                    <div id="step-2" class="wow lightSpeedIn" data-wow-duration="0.15s">
                      <div class="form-group mb-3" id="container-locate-server">
                          <label class="col-form-label">Category</label>
                          {{-- <input class="form-control" type="text" required="" id="category" name="category"> --}}
                          <input class="form-control" list="categorys" required="" id="category" name="category">
                          <datalist id="categorys">
                            @foreach($categorys as $category)
                              <option value="{{ ucfirst($category->name) }}"> {{ ucfirst($category->name) }} </option>
                            @endforeach
                          </datalist>
                      </div>

                      <div class="form-group mb-3" id="container-detail">
                          <label class="col-form-label">Detail Trouble</label>
                          <textarea class="form-control" name="detail[trouble]" id="detail.trouble" rows="3" placeholder="Enter your detail"></textarea>
                      </div>

                      <div id="container-name">
                        <div class="form-group mb-3">
                            <label class="col-form-label">Your Name</label>
                            <input class="form-control" type="text" required="" id="signer" name="signer">
                        </div>

                        <div class="form-group row mb-3 wow lightSpeedIn" data-wow-duration="0.15s" id="container-dinas">
                          <div class="col-sm-4">
                            <label class="col-form-label">Idenity</label>
                            <select class="form-select" name="type_identity" id="type_identity">
                              <option value="">- Type -</option>
                              @foreach ($identityType as $key => $value)
                                <option value="{{ $value }}" @if(old('type_identity')==$value) selected @endif>{{ ucfirst($value) }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="col-sm-8">
                            <label class="col-form-label">Number</label>
                            <input class="form-control" type="text" required="" placeholder="Your Identity Number" name="number_identity" id="number_identity">
                          </div>
                        </div>
                      </div>
                      

                      
                      <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-20" type="button" id="btn-step-2"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-primary btn-block w-90" type="submit" id="btnSubmitForm">Create Ticket Now</button>
                      </div>
                    </div>
                    
                    
                    <h6 class="text-muted mt-4">Or Create in AitiHelpdes</h6>
                    <div class="social mt-4">
                      <div class="btn-showcase">
                        <a class="btn btn-light btn-block w-100" href="#" target="_blank">
                          <i data-feather="settings"></i> AitiHelpdesk 
                        </a>
                      </div>
                    </div>
                    
                  </form>
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
      <!-- Theme js-->
      <script src="{{ asset('assets/js/script.js') }}"></script>
      <!-- login js-->
      <!-- Plugin used-->
      <script>
        $(function() {
          //btnSubmitForm to Localstorage
          $('#btnSubmitForm').click(function(e){
            e.preventDefault();

            var items = JSON.parse(localStorage.getItem("esarpras") || "[]");
            // console.log("# of users: " + users.length);
            items.forEach(function(item, index) {
              console.log("[" + index + "]: " + item);
            });
            
            var item = $('#token').val();

            items.push(item);

            // Saving
            localStorage.setItem("esarpras", JSON.stringify(items));
            
            $("#formSubmit").submit();
          });

        });
      </script>
      
        
      <script>
        new WOW().init();
      </script>

      <script>
        document.getElementById("step-2").style.display = "none";

        //button click to show step-2
        $('#btn-step-1').click(function(){
          document.getElementById("step-1").style.display = "none";
          document.getElementById("step-2").style.display = "block";
        });

        $('#btn-step-2').click(function(){
          document.getElementById("step-2").style.display = "none";
          document.getElementById("step-1").style.display = "block";
        });

      </script>

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
          $("#location_unit").select2();

          function hideAll(){
            $('#container-locate').hide();
            $('#container-locate-server').hide();
            $('#container-dinas').hide();
            $('#container-region').hide();
          }

          hideAll();

          $('#type').on('change', function() {

              LoadingOn();

              var value = this.value;
              
              if(value == 'troubleshooting'){
                hideAll();
                $('#container-locate').show();
                $('#container-locate-server').hide();
                $('#container-detail').show();
                $('#container-name').show();
              } else if(value == 'monitoring'){
                hideAll();
                $('#container-locate').show();
                $('#container-locate-server').hide();
                $('#container-detail').hide();
                $('#container-name').show();
              } else if(value == 'server'){
                hideAll();
                $('#container-locate').hide();
                $('#container-locate-server').show();
                $('#container-detail').show();
                $('#container-name').hide();
              } else {
                hideAll();
                $('#container-locate').hide();
                $('#container-locate-server').hide();
                $('#container-detail').hide();
                $('#container-name').hide();
              }

              LoadingOff();
          });



          $('#locate').on('change', function() {
              LoadingOn();
              var value = this.value;
              $('#location_city').val(value);
              
              if(value == 'Dinas'){
                $('#container-dinas').show();
                $('#container-region').hide();
                LoadingOff();
              } else if(value == 'Jakarta Utara' || value == 'Jakarta Selatan' || value == 'Jakarta Barat' || value == 'Jakarta Timur' || value == 'Jakarta Pusat' || value == 'Kepulauan Seribu') {
                fetchWilayah(value);
                $('#container-dinas').hide();
                $('#container-region').show();
                // LoadingOff();
              } else {
                $('#container-dinas').hide();
                $('#container-region').hide();
                LoadingOff();
              }
          });


          

          function fetchWilayah(value){
            

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
                  html += '<option value="'+ this.name +'">'+ this.name +'</option>';
                });

                $('#location_unit').append(html);
                $('#location_unit').attr('disabled', false);
                LoadingOff();
              }
            });
          }

        });
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
    </div>
  </body>
</html>