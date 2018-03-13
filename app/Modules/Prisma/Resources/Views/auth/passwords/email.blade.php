<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Portal de Sistemas - Reconfigurar Senha</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.6.3/css/font-awesome.min.css') }}" />

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ asset('assets/fonts/fonts.googleapis.com.css') }}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" />
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('assets/js/respond.min.js') }}"></script>
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
                            <img src="{{ asset('assets/img/logo.png') }}" height="25"> | Portal de Sistemas
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
                                                    Reconfigurar senha
                                                </h4>

                                                <div class="space-6"></div>
                                                @if (session('status'))
                                                    <div class="alert alert-success">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif

                                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                                    
                                                    {{ csrf_field() }}
                                                    
                                                    <fieldset>
                                                        <label class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                                                @if ($errors->has('email'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                @endif
                                                                
                                                                <i class="ace-icon fa fa-user"></i>
                                                            </span>
                                                        </label>

                                                        <div class="space"></div>

                                                        <div class="clearfix center">
                                                            
                                                            <button type="submit" class="btn btn-primary">
                                                                Enviar link de reconfiguração
                                                            </button>

                                                        </div>

                                                        <div class="space-4"></div>
                                                    </fieldset>
                                                </form>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>        


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
            <script src="{{ asset('assets/js/jquery.2.1.1.min.js') }}"></script>
        <!-- <![endif]-->

        <!--[if IE]>
            <script src="../assets/js/jquery.1.11.1.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->
            <script type="text/javascript">
                window.jQuery || document.write("<script src='{{ asset('assets/js/jquery.min.js') }}>"+"<"+"/script>");
            </script>
        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
                window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->
        
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}>"+"<"+"/script>");
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
        <script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
        <script>
            $('.input-mask-cpf').mask('999.999.999-99');
            
        </script>
    </body>
</html>