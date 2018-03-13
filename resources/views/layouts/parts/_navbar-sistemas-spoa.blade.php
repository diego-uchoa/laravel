<?php $helper = app('App\Helpers\UtilHelper'); ?>
<li class="transparent">

	<a data-toggle="dropdown" class="dropdown-toggle" href="#" data-rel="tooltip" data-placement="bottom" data-original-title="Sistemas">
		<i class="ace-icon fa fa-tasks"></i><span class="badge badge-danger"></span>
	</a>
		
	<div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">

		<div class="tabbable">
			
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#navbar-messages">
						Sistemas
						<span class="badge badge-danger"></span>
					</a>
				</li>
			</ul><!-- .nav-tabs -->

			<div class="tab-content">
				<div id="navbar-messages" class="tab-pane active">
					<ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
						<li class="dropdown-content">
							<ul class="dropdown-menu dropdown-navbar">

								@php 
									
									$username = $helper->getUsername();
									$sistemas = @cache('menu-sistemas-'.$username);

								@endphp

								@if ($sistemas)
										
									@foreach($sistemas as $sistema)
								    
										<li>
											<a href="{{ url('/' . $helper->getSistemaModulo($sistema->no_sistema) ) }}">
													<span class="msg-title">
														<i>{{ Html::image('icones/icone_' . $sistema->no_sistema . '.png', $sistema->no_sistema,array( 'width' => 20, 'height' => 20 )) }}</i>
														<span style = 'vertical-align: middle' class="blue">{{ $sistema->no_sistema }}</span>
													</span>
												</span>
											</a>
										</li>

								    @endforeach

								@endif

							</ul>
						</li>
					</ul>
				</div><!-- /.tab-pane -->
			</div><!-- /.tab-content -->
		
		</div><!-- /.tabbable -->
		
	</div><!-- /.dropdown-menu -->

</li>