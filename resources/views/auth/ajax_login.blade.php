<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta Tags --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
    function callbackThen(response) {
        // read Promise object
        response.json().then(function(data) {
            // console.log(data);
            if(data.success && data.score > 0.5) {
                console.log('Recaptcha V3 Valid - E-SarprasTI Pusdatin PMPTSP');
            } else {
                document.getElementById('registerForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    alert('Recaptcha is Error !!');
                });
            }
        });
    }
    
    function callbackCatch(error){
        console.error('Error:', error)
    }
    </script>
        
    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
        'callback_catch' => 'callbackCatch',
    ]) !!}

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('page_description', $page['description'] ?? 'E-SarprasTI adalah Website Aplikasi Kinerja di Bagian Sarana dan Prasarana Teknologi Informasi PMPTSP Pusdatin PMPTSP')">
    <meta name="keywords" content="e-sarpras, pusdatin, jakevo, ptsp, dpmptsp, jakarta">
    <meta name="author" content="Ravi Zulfikar">
    {{-- Meta Tags --}}

    {{-- Title --}}
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Login</title>
    {{-- Title --}}

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
        rel="stylesheet">
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('assets/plugin/izitoast/dist/css/iziToast.min.css')}}">
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid">

        <div class="row">
            
            <div class="col-xl-7 order-1"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/1.jpg') }}" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/login.png') }}" alt="looginpage"><img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"  alt="looginpage"></a></div>
                        <div class="login-main">

                            <div class="theme-form">
                                {{-- @csrf --}}

                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group">
                                    <label class="col-form-label">{{ __('Email Address') }}</label>
                                    <input class="form-control" type="email" name="email" id="email" required="" value="{{ old('email') }}" placeholder="ravi@gmail.com" autocomplete="email" autofocus>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input id="password" class="form-control" type="password" name="password" required="" placeholder="*********" >
                                        <div class="show-hide"><span class="show"> </span></div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input name="remember" id="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="text-muted" for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                    
                                    @if (Route::has('password.request'))
                                        <a class="link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif

                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit" id="LoginSubmit">{{ __('Sign In') }}</button>
                                    </div>

                                        
                                </div>

                                <h6 class="text-muted mt-4 or">Or Sign in with</h6>
                                <div class="social mt-4">
                                    <div class="btn-showcase">
                                        <a class="btn btn-light" ref="https://www.linkedin.com/login" target="_blank">
                                            <i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn 
                                        </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank">
                                            <i class="txt-twitter" data-feather="twitter"></i>twitter
                                        </a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank">
                                            <i class="txt-fb" data-feather="facebook"></i>facebook
                                        </a>
                                    </div>
                                </div>
                                <p class="mt-4 mb-0 text-center">Don't have account?
                                    <a class="ms-2" href="{{ route('register') }}">{{ __('Create Account') }}</a>
                                </p>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <!-- Plugins JS Ends-->
        <!-- Theme js-->
        <script src="{{ asset('assets/js/script.js') }}"></script>
        <!-- login js-->
        <!-- Plugin used-->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('assets/plugin/izitoast/dist/js/iziToast.min.js')}}"></script>

        <script>
            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        </script>

        <script>
            $(document).ready(function() {

                $("#LoginSubmit").click( function() {

                    var email       = $("#email").val();
                    var password    = $("#password").val();

                    if(email.length == "") {

                        iziToast.warning({
                            message: "Email Wajib diisi !",
                            position: 'topRight'
                        });

                    } else if(password.length == "") {

                        iziToast.warning({
                            message: "Password Wajib diisi !",
                            position: 'topRight'
                        });

                    } else {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
                            }
                        });

                        $.ajax({

                            url: "{{ route('login') }}",
                            type: "POST",
                            data: {
                                "email": email,
                                "password": password,
                            },

                            success:function(response){

                                // if (response.success) {

                                //     Swal.fire({
                                //         type: 'success',
                                //         title: 'Login Berhasil!',
                                //         text: 'Anda akan di arahkan dalam 3 Detik',
                                //         timer: 3000,
                                //         showCancelButton: false,
                                //         showConfirmButton: false
                                //     })
                                //         .then (function() {
                                //             window.location.href = "{{ route('dashboard') }}";
                                //         });

                                // } else {

                                //     console.log(response.success);

                                //     Swal.fire({
                                //         type: 'error',
                                //         title: 'Login Gagal!',
                                //         text: 'silahkan coba lagi!'
                                //     });

                                // }

                                console.log(response);

                            },

                            error:function(response){

                                // Swal.fire({
                                //     type: 'error',
                                //     title: 'Opps!',
                                //     text: 'server error!'
                                // });

                                console.log(response);

                            }

                        });

                    }

                });

            });
        </script>

        <script>
            
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

            @if($errors->any())
                var times = {{ $int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT); }};
                var timeOut = times*1000;
                let timerInterval;
                // console.log({{ $errors->first() }});

                Swal.fire({
                    icon: 'error',
                    title: 'Too many login attempts!',
                    html: 'Please try again in <b></b> seconds.',
                    timer: timeOut,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Math.round(Swal.getTimerLeft()/1000)
                        }, 1000)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                })
            @endif

        </script>
        
    </div>
</body>

</html>
