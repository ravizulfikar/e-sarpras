<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>

<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script> --}}

<!-- Bootstrap js-->
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<!-- feather icon js-->
<script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
<!-- scrollbar js-->
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
<!-- Sidebar jquery-->
<script src="{{asset('assets/js/config.js')}}"></script>
<!-- Plugins JS start-->
<script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>

<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/sweet-alert/app.js')}}"></script> --}}
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{asset('assets/js/notify/notify-script.js')}}"></script>
<script src="{{ asset('assets/plugin/izitoast/dist/js/iziToast.min.js')}}"></script>

@stack('script')

@if(Route::current()->getName() != 'popover') 
	<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
@endif

<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{asset('assets/js/script.js')}}"></script>
{{-- <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script> --}}


{{-- @if(Route::current()->getName() == 'index') 
	<script src="{{asset('assets/js/layout-change.js')}}"></script>
@endif --}}
<script>
	var themeClass = '{{ (!empty(Auth::user()->theme->class)) ? Auth::user()->theme->class : "" }}';
	
	if(themeClass == 'dark-only'){
		document.getElementById("modeTheme").classList.remove('fa-moon-o');
		document.getElementById("modeTheme").classList.add('fa-lightbulb-o');
	} else {
		document.getElementById("modeTheme").classList.remove('fa-lightbulb-o');
		document.getElementById("modeTheme").classList.add('fa-moon-o');
	}

	$(".mode").on("click", function () {
        var theme = $('#modeTheme');

		var notify = $.notify('<i class="fa fa-bell-o"></i><strong>Loading...</strong>', {
			type: 'theme',
			allow_dismiss: true,
			delay: 2000,
			showProgressbar: true,
			timer: 300,
			animate:{
				enter:'animated fadeInDown',
				exit:'animated fadeOutUp'
			}
		});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        if(theme[0].className == 'fa fa-lightbulb-o'){
            $.ajax({

                url: "{{ route('changeTheme') }}",
                type: "POST",
                data: {
                    "user_id"   : "{{ \Auth::user()->id }}",
                    "class"     : '',
                },

                success:function(response){
					notify.update('message', '<i class="fa fa-check"></i><strong>Success</strong> Theme to Light!');
                },
                error:function(response){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });
                }

            });
        }

        if(theme[0].className == 'fa fa-moon-o'){
            $.ajax({

                url: "{{ route('changeTheme') }}",
                type: "POST",
                data: {
                    "user_id"   : "{{ \Auth::user()->id }}",
                    "class"     : 'dark-only',
                },

                success:function(response){
                    notify.update('message', '<i class="fa fa-check"></i><strong>Success</strong> Theme to Dark!');
                },
                error:function(response){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });
                }

            });
        }
        
        $('.mode i').toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
		$('body').toggleClass("dark-only");
        var color = $(this).attr("data-attr");
    });
</script>

<script>
	$("body").on("click",".remove",function(){
		var current_object = $(this);
		var action = current_object.attr('data-action');
        var dataID = current_object.attr('data-id');

		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			buttons: true,
			dangerMode: true,
			})
		.then((willDelete) => {
            

			if (willDelete) {
                actionDelete(action,dataID,current_object);
			} 
		});

		
	});

    function actionDelete(action,dataID,current_object){
        LoadingOn();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url: action,
            type: 'DELETE',
            data: {
                "id": dataID,
            },
            success: function(response){
                console.log(response);
                current_object.closest('tr').remove();
                swal("Data has been deleted!", {
                    icon: "success",
                });

                LoadingOff();
                location.reload();
            },
            error: function(response){
                swal("Server Error Detected !!", {
                    icon: "error",
                });

                LoadingOff();
            }
        });

        
    }

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


<script>
	$("body").on("click",".update",function(){
		var current_object = $(this);
		var action = current_object.attr('data-action');
        var dataID = current_object.attr('data-id');
        var dataMethod = current_object.attr('data-method');

		swal({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			buttons: true,
			dangerMode: true,
			})
		.then((willDelete) => {
            

			if (willDelete) {
                actionUpdateDelete(action,dataID,current_object, dataMethod);
			} 
		});

		
	});

    function actionUpdateDelete(action,dataID,current_object, dataMethod){
        LoadingOn();


        $.ajax({
            url: action,
            type: 'POST',
            data: {
                _method: dataMethod,
                _token: "{{ csrf_token() }}",
                id: dataID,
            },
            success: function(response){
                console.log(response);
                current_object.closest('tr').remove();
                swal("Data has been deleted!", {
                    icon: "success",
                });

                LoadingOff();
                location.reload();
            },
            error: function(response){
                swal("Server Error Detected !!", {
                    icon: "error",
                });

                LoadingOff();
            }
        });

        
    }

</script>