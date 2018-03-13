<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Portal de Sistemas</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />


		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/4.6.3/css/font-awesome.min.css') }}"/>

		<!-- text fonts -->

		<link rel="stylesheet" href="{{ URL::asset('assets/fonts/fonts.googleapis.com.css') }}" />

		<!-- chosen styles -->		
		<link rel="stylesheet" href="{{ URL::asset('assets/css/chosen.min.css') }}" />

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
		
		<div class="main-content">
			<div class="main-content-inner">

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


		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="blue bolder">Central de Atendimento do Portal de Sistemas - </span>portal.df.spoa@fazenda.gov.br | (61) 2021-5379
				</div>
			</div>
		</div>

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

		<script type="text/javascript">
			$('.main-content .active').toggleClass('changed');
		</script>

	
		@yield('script-end')
	</body>
</html>
