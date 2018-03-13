<!-- Tx Analise Field -->
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			{!! Form::hidden('id_solicitacao_cadastro', $solicitacaoCadastro->id_solicitacao_cadastro, ['id' => 'id_solicitacao_cadastro']) !!}
		    {!! Form::label('tx_analise', 'Análise ') !!}
		    {!! Form::textarea('tx_analise', null, ['class' => 'form-control', 'rows' => '3']) !!}
		</div>
	</div>
</div>
<!-- Submit Field -->
<div>
{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary', 'id' => 'bt_salvar', 'data-rel' => 'tooltip', 'data-original-title' => 'Salva os dados para continuar a análise posteriormente. A solicitação terá situação "Em análise".']) !!}
{!! Form::button('Aprovar',['class'=>'btn btn-sm btn-success', 'id' => 'bt_aprovar', 'data-rel' => 'tooltip', 'data-original-title' => 'Realiza os cadastros da instituição, responsável e editores no Prisma. A solicitação terá situação "Aprovada" e não poderá mais ser alterada.']) !!}
{!! Form::button('Rejeitar',['class'=>'btn btn-sm btn-danger', 'id' => 'bt_rejeitar', 'data-rel' => 'tooltip', 'data-original-title' => 'Rejeita a solicitação e envia para o responsável o motivo. A solicitação terá situação "Rejeitada" e não poderá mais ser alterada.']) !!}