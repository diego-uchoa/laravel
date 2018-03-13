@extends('layouts.master')

@section('breadcrumbs-page')
    <li>
        <a href="#" class="active">Profile</a>
    </li>
@endsection

@section('content')

	@section('page-header')
	    Profile - {{ Auth::user()->no_usuario }}
	@endsection

		<div class="row">
			<div class="col-xs-12">
				
				<div>
					<div id="user-profile" class="user-profile">
						<div class="tabbable">
							<ul class="nav nav-tabs padding-18">
								<li class="active">
									<a data-toggle="tab" href="#home">
										<i class="green ace-icon fa fa-user bigger-120"></i>
										Dados Pessoais
									</a>
								</li>

								<li>
									<a data-toggle="tab" href="#feed">
										<i class="orange ace-icon fa fa-industry bigger-120"></i>
										Dados Funcionais
									</a>
								</li>
							</ul>

							<div class="tab-content no-border padding-24">
								<div id="home" class="tab-pane in active">
									<div class="row">
										<div class="col-xs-12 col-sm-3 center">
											<span class="profile-picture">
												<img class="editable img-responsive" id="foto" 
													src="{{ $dadosPessoais->ds_foto ? URL::asset('uploads/Sisadm/avatar/'.$dadosPessoais->ds_foto) : URL::asset('assets/avatars/default.png') }}"/>
											</span>

											<div class="space space-4"></div>

											<a href="#" class="btn btn-sm btn-block btn-primary">
												<i class="ace-icon fa fa-picture-o bigger-120"></i>
												<span class="bigger-110" id="avatar2" id="botao2">Alterar Foto</span>
											</a>

											<a href="{{ URL::previous() }}" class="btn btn-sm btn-block btn-warning">
												<i class="ace-icon fa fa-reply bigger-110"></i>
												<span class="bigger-110">Voltar</span>
											</a>
										</div><!-- /.col -->

										<div class="col-xs-12 col-sm-9">
											<h4 class="blue">
												<span class="middle">{{ $dadosPessoais->no_pessoa }}</span>
											</h4>

											<div class="profile-user-info">
												<div class="profile-info-row">
													<div class="profile-info-name"> CPF </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->nr_cpf }}</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Dt. de Nasc. </div>

													<div class="profile-info-value">
														<span>{{ Carbon\Carbon::parse($dadosPessoais->dt_nascimento)->format('d/m/Y') }}</span>
													</div>
												</div>	

												<div class="profile-info-row">
													<div class="profile-info-name"> Est. Civil </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->in_estado_civil }}</span>
													</div>
												</div>	

												<div class="profile-info-row">
													<div class="profile-info-name"> Mãe </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->no_mae }}</span>
													</div>
												</div>		

												<div class="profile-info-row">
													<div class="profile-info-name"> Pai </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->no_pai }}</span>
													</div>
												</div>		

												<div class="profile-info-row">
													<div class="profile-info-name"> Sexo </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->in_sexo }}</span>
													</div>
												</div>		

												<div class="profile-info-row">
													<div class="profile-info-name"> Naturalidade </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->sg_uf_nascimento . ' - ' . $dadosPessoais->no_municipio_nascimento }}</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Nr. PIS/PASEP </div>

													<div class="profile-info-value">
														<span>{{ $dadosPessoais->nr_pis_pasep }}</span>
													</div>
												</div>

											</div>

										</div><!-- /.col -->
									</div><!-- /.row -->
								</div><!-- /#home -->

								<div id="feed" class="tab-pane">
									<div class="profile-feed row">
										
										
										@foreach ($dadosFuncionais as $dadosFuncional)	
											@if ($dadosFuncional->dt_ocorrencia_exclusao == "")
												<div class="profile-user-info profile-user-info-striped">
													<div class="profile-info-row">
														<div class="profile-info-name"> Exercício </div>

														<div class="profile-info-value">
															<i class="fa fa-map-marker light-orange bigger-110"></i>
															<span class="editable" id="username">{{ $dadosFuncional->uorgExercicio ? $dadosFuncional->uorgExercicio->sg_orgao . " - " . $dadosFuncional->uorgExercicio->no_orgao : "NÃO INFORMADO." }}</span>
														</div>

														<div class="profile-info-name"> Lotação </div>

														<div class="profile-info-value">
															<i class="fa fa-map-marker light-orange bigger-110"></i>
															<span class="editable" id="username">{{ $dadosFuncional->uorgLotacao != "" ? $dadosFuncional->uorgLotacao->sg_orgao . " - " . $dadosFuncional->uorgLotacao->no_orgao : "NÃO INFORMADO." }}</span>
														</div>
													</div>

													<div class="profile-info-row">
														<div class="profile-info-name"> Upag </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->upag != "" ? $dadosFuncional->upag->sg_orgao . " - " . $dadosFuncional->upag->no_orgao : "NÃO INFORMADO." }}</span>
														</div>
														<div class="profile-info-name"> Matr. SIAPE </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->nr_siape }}</span>
														</div>
													</div>

													<div class="profile-info-row">
														<div class="profile-info-name"> Chefia </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->chefia ? $dadosFuncional->chefia->no_pessoa : "NÃO INFORMADO." }}</span>
														</div>
														<div class="profile-info-value"></div>
														<div class="profile-info-value">
															<span class="editable" id="username"></span>
														</div>
													</div>

													<div class="profile-info-row">
														<div class="profile-info-name"> Dt. Ingr. Função </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->dt_ingresso_funcao != "" ? Carbon\Carbon::parse($dadosFuncional->dt_ingresso_funcao)->format('d/m/Y') : "NÃO INFORMADO." }}</span>
														</div>
														<div class="profile-info-name"> Função </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->co_funcao != "" ? $dadosFuncional->co_funcao : "NÃO INFORMADO." }}</span>
														</div>
													</div>												
															
													<div class="profile-info-row">
														<div class="profile-info-name"> Cargo </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->co_cargo != "" ? $dadosFuncional->cargo->no_cargo : "NÃO INFORMADO." }}</span>
														</div>
														<div class="profile-info-name"> Sit. Funcional </div>

														<div class="profile-info-value">
															<span class="editable" id="username">{{ $dadosFuncional->co_situacao_funcional != "" ? $dadosFuncional->situacaoFuncional->no_situacao_funcional : "NÃO INFORMADO." }}</span>
														</div>
													</div>										

												</div>
											
												<div class="space-20"></div>

												<div class="widget-box">
													<div class="widget-header">
														<h4 class="widget-title lighter smaller">
															<i class="ace-icon fa fa-history blue"></i>
															Histórico de atualização
														</h4>
													</div>

													<div class="widget-body">
														<div class="widget-main no-padding">
															<div class="dialogs ace-scroll">
													
											@endif
										@endforeach
																
																@foreach ($dadosFuncionais as $dadosFuncional)	
																	@if ($dadosFuncional->dt_ocorrencia_exclusao != "")

																		<div class="itemdiv dialogdiv">
																			
																			<div class="user">
																				<img src="{{ URL::asset('assets/img/siape_update_funcional.png') }}" />
																			</div>

																			<div class="body">

																				<div class="name">
																					<div class="row">
																						<div class="col-sm-6">
																							<b> Exercício </b>
																							{{ $dadosFuncional->uorgExercicio != "" ? $dadosFuncional->uorgExercicio->sg_orgao . " - " . $dadosFuncional->uorgExercicio->no_orgao : "NÃO INFORMADO." }}
																						</div>
																						<div class="col-sm-6">
																							<b> Lotação </b>
																							{{ $dadosFuncional->uorgLotacao != "" ? $dadosFuncional->uorgLotacao->sg_orgao . " - " . $dadosFuncional->uorgLotacao->no_orgao : "NÃO INFORMADO." }}
																						</div>
																					</div>
																					<div class="row">	
																						<div class="col-sm-6">
																							<b> Upag </b>
																							{{ $dadosFuncional->upag != "" ? $dadosFuncional->upag->sg_orgao . " - " . $dadosFuncional->upag->no_orgao : "NÃO INFORMADO." }}
																						</div>
																						<div class="col-sm-6">
																							<b> Matr. SIAPE </b>
																							{{ $dadosFuncional->nr_siape }}
																						</div>
																					</div>
																					<div class="row">	
																						<div class="col-sm-12">
																							<b> Chefia </b>
																							{{ $dadosFuncional->chefia ? $dadosFuncional->chefia->no_pessoa : "NÃO INFORMADO." }}
																						</div>
																					</div>
																					<div class="row">	
																						<div class="col-sm-6">
																							<b> Dt. Ingr. Função </b>
																							{{ $dadosFuncional->dt_ingresso_funcao != "" ? Carbon\Carbon::parse($dadosFuncional->dt_ingresso_funcao)->format('d/m/Y') : "NÃO INFORMADO." }}
																						</div>
																						<div class="col-sm-6">
																							<b> Função </b>
																							{{ $dadosFuncional->co_funcao != "" ? $dadosFuncional->co_funcao : "NÃO INFORMADO." }}
																						</div>
																					</div>
																					<div class="row">	
																						<div class="col-sm-6">
																							<b> Cargo </b>
																							{{ $dadosFuncional->co_cargo != "" ? $dadosFuncional->cargo->no_cargo : "NÃO INFORMADO." }}
																						</div>
																						<div class="col-sm-6">
																							<b> Sit. Funcional </b>
																							{{ $dadosFuncional->co_situacao_funcional != "" ? $dadosFuncional->situacaoFuncional->no_situacao_funcional : "NÃO INFORMADO." }}
																						</div>
																					</div>
																					<div class="row">	
																						<div class="col-sm-6">
																							<b> Dt. Ocorrência Exclusão </b>
																							{{ $dadosFuncional->dt_ocorrencia_exclusao != "" ? Carbon\Carbon::parse($dadosFuncional->dt_ocorrencia_exclusao)->format('d/m/Y') : "NÃO INFORMADO." }}
																						</div>
																						<div class="col-sm-6">
																							<b> Ocorrência Exclusão </b>
																							{{ $dadosFuncional->ds_ocorrencia_exclusao != "" ? $dadosFuncional->ds_ocorrencia_exclusao : "NÃO INFORMADO." }}
																						</div>
																					</div>
																				</div>

																			</div>

																		</div>

																	@endif
																@endforeach

															</div>
														</div><!-- /.widget-main -->
													</div><!-- /.widget-body -->
												</div><!-- /.widget-box -->		

									</div><!-- /.row -->
								</div><!-- /#feed -->

							</div>
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

@endsection

	
@section('script-end')
	<!--[if lte IE 8]>
	  <script src="assets/js/excanvas.min.js"></script>
	<![endif]-->
	<script src="{{ URL::asset('assets/js/jquery-ui.custom.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/jquery.gritter.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootbox.min.js') }}"></script>

	<script src="{{ URL::asset('assets/js/bootstrap-editable.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/ace-editable.min.js') }}"></script>

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {

			$('#avatar2').on('click', function(){
				var modal = 
				'<div class="modal fade">\
				  <div class="modal-dialog">\
				   <div class="modal-content">\
					<div class="modal-header">\
						<button type="button" class="close" data-dismiss="modal">&times;</button>\
						<h4 class="blue">Alterar Foto</h4>\
					</div>\
					\
					<form class="no-margin" id="formulario">\
					 <div class="modal-body">\
						<div class="space-4"></div>\
						<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" id="file-input" /></div>\
					 </div>\
					\
					 <div class="modal-footer center">\
						<button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> Enviar</button>\
						<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancelar</button>\
					 </div>\
					</form>\
				  </div>\
				 </div>\
				</div>';
				
				
				var modal = $(modal);
				modal.modal("show").on("hidden", function(){
					modal.remove();
				});
		
				var working = false;

				var form = modal.find('form:eq(0)');
				var file = form.find('input[type=file]').eq(0);
				
				file.ace_file_input({
					style:'well',
					btn_choose:'Clique para escolher uma nova foto.',
					btn_change:null,
					no_icon:'ace-icon fa fa-picture-o',
					thumbnail:'fit',
					before_remove: function() {
						return !working;
					},					
					allowExt: ['jpg', 'jpeg', 'png', 'gif'],
					allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
				});
		
				form.on('submit', function(){

					if(!file.data('ace_input_files')) return false;

					var formulario = $('#formulario');
					var formData = new FormData(formulario.get(0));

					var formData2 = {
		                   ds_foto: file.next().find('img').data('thumb')
					};

					file.ace_file_input('disable');
					form.find('button').attr('disabled', 'disabled');
					form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");
					
					$.ajaxSetup({
					    headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        }
					});

					var deferred = $.ajax({
					         url: 'profile/photo',
					         type: 'POST',
					         data: formData2,
			         		 dataType: 'json'
					})
	

					var deferred = new $.Deferred;
					working = true;
					deferred.done(function() {
						form.find('button').removeAttr('disabled');
						form.find('input[type=file]').ace_file_input('enable');
						form.find('.modal-body > :last-child').remove();
						
						modal.modal("hide");
		
						var thumb = file.next().find('img').data('thumb');
						if(thumb) $('#foto').get(0).src = thumb;
						
						working = false;
					});
					
					
					setTimeout(function(){
						deferred.resolve();
					} , parseInt(Math.random() * 800 + 800));
					
					return false;
				});
						
			});
			
		});
	</script>

@endsection