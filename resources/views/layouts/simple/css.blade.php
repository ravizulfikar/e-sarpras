<link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.css')}}">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/icofont.css')}}">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/themify.css')}}">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/flag-icon.css')}}">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/feather-icon.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<!-- Plugins css start-->
@stack('css')

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/animate.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugin/izitoast/dist/css/iziToast.min.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/scrollbar.css')}}">
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/bootstrap.css')}}">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
<link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

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

