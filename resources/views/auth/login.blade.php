<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Portal de Sistemas - Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.6.3/css/font-awesome.min.css') }}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/fonts/fonts.googleapis.com.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/navbar.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/hover.css') }}" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		
	</head>

	<body class="login-layout light-login">
		<noscript>
			<span id="js-error">
				<div class="overlay noscript-overlay" style="display: block;"></div>
				<div class="modal modal-message group modal-warning">
					<h2 class="text-center blue">O sistema não funciona corretamente com Javascript desativado.</h2>
					<br>
					<br>
					<p>
						Foi identificado que o script do seu navegador está desativado. Com isso, algumas funcionalidades do sistema não funcionarão
						corretamente. Existem duas possíveis formas de resolver o problema:
					</p>
					<p>
						<b>1.</b> Utilize outro navegador para acessar (em geral, Google Chrome e Mozilla Firefox não apresentam esse problema).
					</p>
					<p>
						<b>2.</b> Ative o script do seu navegador e atualize essa página. <a href="http://www.processosseletivos.com.br/site/noscript/tutorial/" target="_blank">
						Esse site te ensinará a fazer isso.</a>
					</p>
					<br>
					<br>
					<p>
						Caso o problema persista, entre em contato pelo e-mail portal.df.spoa@fazenda.gov.br ou telefone (61) 2021-5379.
					</p>
				</div>	
			</span>	 
		</noscript>
		<div id="navbar" class="navbar navbar-default navbar-collapse navbar-fixed-top">
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="{{ url('/') }}" class="navbar-brand">
						<small>
							{{ Html::image('icones/thumbnail_PORTAL.png', 'Portal de Sistemas',array('height' => 25, 'style' => 'padding-right:10px' )) }}
							<!-- <img src="{{ asset('assets/img/logo.png') }}" height="25"> | Portal de Sistemas -->
							Portal de Sistemas
						</small>
					</a>
				</div>
			</div>
		</div>

					
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							
							@include('layouts.parts._messages-spoa')
							
							<div class="center">
								<h1>
								</h1>
								<h4 class="blue" id="id-company-text"></h4>
							</div>

							<div class="space-6"></div>
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
											
												<h4 class="header blue lighter bigger">
													Informe seus dados
												</h4>

												<div class="space-6"></div>

												<form role="form" method="POST" action="{{ url('/login') }}">
													
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													
													<fieldset>
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input name="nr_cpf" type="text" value="{{ old('nr_cpf') }}" class="form-control input-mask-cpf" placeholder="CPF"/>
																<i class="ace-icon fa fa-user"></i>
															</span>
														</label>

														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input name="password" type="password" class="form-control" placeholder="Senha" />
																<i class="ace-icon fa fa-lock"></i>
															</span>
														</label>

														<div class="space"></div>

														<div class="clearfix">
															<label class="inline">
																<input type="checkbox" class="ace" />
																<span class="lbl"> Mantenha-me conectado</span>
															</label>

															<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
																<i class="ace-icon fa fa-key"></i>
																<span class="bigger-110">Entrar</span>
															</button>
														</div>

														<div class="space-4"></div>
													</fieldset>
												</form>
													
											</div><!-- /.widget-main -->

											<div class="toolbar clearfix">
												<div>
													<a href="#" data-target="#forgot-box" class="forgot-password-link" >
														<i class="ace-icon fa fa-question"></i>
														Esqueci minha senha
													</a>
												</div>
											</div>
										</div><!-- /.widget-body -->
									</div><!-- /.login-box -->

									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="ace-icon fa fa-key"></i>
													Recuperar senha
												</h4>

												<div class="space-6"></div>
												<p>
													Informe seu CPF. Você receberá a nova senha no e-mail cadastrado.
												</p>

												<form role="form" method="POST" action="{{ url('/password/email') }}">
													
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
													
													<fieldset>
														<label class="block clearfix">
															<span class="block input-icon input-icon-right">
																<input name="nr_cpf" type="text" value="{{ old('nr_cpf') }}" class="form-control input-mask-cpf" placeholder="CPF"/>
																<i class="ace-icon fa fa-user"></i>
															</span>
														</label>

														<div class="clearfix">
															<button type="submit" class="pull-right btn btn-primary">
															    <i class="ace-icon fa fa-envelope-o"></i>
															    Enviar link de reconfiguração
															</button>
														</div>
													</fieldset>
												</form>
											</div><!-- /.widget-main -->

											<div class="toolbar center">
												<a href="#" data-target="#login-box" class="back-to-login-link">
													Voltar para tela de login
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div><!-- /.widget-body -->
									</div><!-- /.forgot-box -->

								</div><!-- /.position-relative -->
							</div><!-- /.space-6 -->
						</div><!-- /.login-container -->
					</div><!-- /.col-sm-10 col-sm-offset-1 -->
					<div class="footer">
						<div class="footer-inner">
							<div class="footer-content">
								<span class="blue bolder">Central de Atendimento do Portal de Sistemas - </span>portal.df.spoa@fazenda.gov.br | (61) 2021-5379
							</div>
						</div>
					</div>
				</div><!-- /.row -->	
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->
		<!--[if !IE]> -->
			<script src="{{ URL::asset('assets/js/jquery.2.1.1.min.js') }}"></script>
		<!-- <![endif]-->

		<!--[if IE]>
			<script src="assets/js/jquery.1.11.1.min.js"></script>
		<![endif]-->

		<!--[if !IE]> -->
			<script type="text/javascript">
				window.jQuery || document.write("<script src='{{ URL::asset('assets/js/jquery.min.js') }}'>"+"<"+"/script>");
			</script>
		<!-- <![endif]-->

		<!--[if IE]>
			<script type="text/javascript">
				window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
		</script>

		<script src="{{ URL::asset('assets/js/jquery.maskedinput.min.js') }}" ></script>

		<script>
		    $('.input-mask-cpf').mask('999.999.999-99');
		</script>
	</body>
</html>
