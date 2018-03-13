<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>@yield('nome_sistema')</title>

		<meta name="description" content="User login page" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/4.6.3/css/font-awesome.min.css') }}"/>

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ URL::asset('assets/fonts/fonts.googleapis.com.css') }}" />

		<!-- chosen styles -->		
		<link rel="stylesheet" href="{{ URL::asset('assets/css/chosen.min.css') }}" />

		<!-- select2 styles -->		
		<link rel="stylesheet" href="{{ URL::asset('assets/css/select2-4.0.3.css') }}" />

		<!-- datapicker styles -->		
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-datepicker3.min.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/ace.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="{{ URL::asset('assets/css/ace-part2.min.css') }}" />
		<![endif]-->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/ace-rtl.min.css') }}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="{{ URL::asset('assets/css/ace-ie.min.css') }}" />
		<![endif]-->

		@yield('css')

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="{{ URL::asset('assets/js/html5shiv.min.js') }}" ></script>
		<script src="{{ URL::asset('assets/js/respond.min.js') }}" ></script>
		<![endif]-->
	
		<script src="{{ URL::asset('assets/js/jquery.2.1.1.min.js') }}"></script>
		@yield('script-head')
	</head>

	<body class="no-skin">
		
		@include('layouts.parts._navbar-spoa')

		<div class="main-content">
			<div class="main-content-inner">				
				
				@include('layouts.parts._messages-spoa')

				<div class="page-content">

					<div class="page-header">
						<h1>@yield('page-header')</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							@yield('content')
						</div><!-- /.col -->
					</div><!-- /.row -->

				</div><!-- /.page-content -->

			</div>

		</div><!-- /.main-content -->


		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>


		<!-- basic scripts -->
		<!--[if !IE]> -->
		<script src="{{ URL::asset('assets/js/jquery.2.1.1.min.js') }}"></script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script src="{{ URL::asset('assets/js/jquery.1.11.1.min.js') }}"></script>
		<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='{{ URL::asset('assets/js/jquery.min.js') }}'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 window.jQuery || document.write("<script src='{{ URL::asset('assets/js/jquery1x.min.js') }}'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{ URL::asset('assets/js/jquery.mobile.custom.min.js') }}'>"+"<"+"/script>");
		</script>
		<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- ace scripts -->
		<script src="{{ URL::asset('assets/js/ace-elements.min.js') }}" ></script>
		<script src="{{ URL::asset('assets/js/ace.min.js') }}" ></script>

		<!-- scripts gerais -->
		<script src="{{ asset('assets/js/bootbox.min.js') }}"></script>

		<script type="text/javascript">
			$('.main-content .active').toggleClass('changed');
		</script>

		<style>
			#preloader {
			    position: absolute;
			    left: 0px;
			    right: 0px;
			    bottom: 0px;
			    top: 0px;
			    background: #ccc;
			}

			.page-header {
				margin-top: 70px;
			}
		</style>



		<script type="application/javascript">
		  	$(function () {
		  	
		  		$(document).ready(function(){
		  		    
		  		    //código para mostrar a tela de carregamento ao selecionar "Alterar meus dados"
		  		    $("#profile_link").click(function (){
		  		    	$('.page-content').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-3x fa-fw blue" style="position: absolute; left:50%;	top:50%"></i></div>');
		  		    });

		  		    //código para mostrar a tela de carregamento ao selecionar a Logo da SPOA
		  		    $("#inicio_link").click(function (){
		  		    	$('.page-content').append('<div class="message-loading-overlay"><i class="fa-spin ace-icon fa fa-cog fa-spin fa-3x fa-fw blue" style="position: absolute; left:50%;	top:50%"></i></div>');
		  		    });

		  		    $('[data-rel=tooltip]').tooltip({container:'body'});
		  		    
		  		});

			});

		</script>

	
		@yield('script-end')

		@include('layouts.parts._ga')

	</body>
</html>