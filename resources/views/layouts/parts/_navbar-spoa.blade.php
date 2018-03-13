<?php $helper = app('App\Helpers\UtilHelper'); ?>

<div id="navbar" class="navbar navbar-default navbar-collapse navbar-fixed-top">
	<div class="navbar-container" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<!-- <a id="inicio_link" href="{{route('portal.inicio')}}" class="navbar-brand">
				<small>
					<img src="{{ URL::asset('assets/img/logo.png') }}" height="25">
					| @yield('nome_sistema')
				</small>
			</a> -->
			<a id="inicio_link" href="{{url($helper->getSistemaRoute())}}" class="navbar-brand">
				<small>
					{{Html::image('icones/thumbnail_'.$helper->getSistema().'.png',$helper->getSistema(),array('height' => 25, 'style' => 'padding-right:10px'))}}
					 @yield('nome_sistema') 
				</small>
			</a>

			<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons">
				<span class="sr-only">Toggle user menu</span>

				<!--<img src="{{ URL::asset('assets/avatars/default.png') }}" alt="Jason's Photo" />-->

				<!--Gravatar -->
				@include('layouts.parts._gravatar', ['user' => Auth::user()])

			</button>
		</div>
		
		@if (!Auth::guest())

				@if(Auth::user()->sn_externo)
						<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
							<ul class="nav ace-nav">
								<li>
									<a href="{{ url('/logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
									<i class="ace-icon fa fa-power-off"></i>
									Sair
								</a>

								<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
		                         </li>
							</ul>
						</div>

				@else

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">

						<!-- Esses estão presentes apenas nos sistemas -->
						@yield('acesso_portal')

						@yield('ajuda_sistema')

						@yield('lista_sistemas')

						@yield('aviso_sistema')

						@yield('aviso_usuario')				

						<li class="transparent">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">

								<!--<img class="nav-user-photo" src="{{ URL::asset('assets/avatars/default.png') }}" alt="Jason's Photo" />-->

								<!--Gravatar -->
								@include('layouts.parts._gravatar', ['user' => Auth::user()])
						
								<span class="user-info">
									<small>Olá,</small>
									{{ Auth::user()->no_usuario }}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a id="profile_link" href="{{ url('portal/profile') }}">
										<i class="ace-icon fa fa-user"></i>
										Visualizar meus dados
									</a>
								</li>

								<li class="divider"></li>

								<li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Sair
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>

							</ul>
						</li>
					</ul>
					
				</div>

				@endif

			</div><!-- /.navbar-container -->
		</div>
		
		@endif

	</div>
</div>		
		