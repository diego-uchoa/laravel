@extends('layouts.template-email', ['corcabecalho' => '#25B394'])

@section('cabecalho')
	<img src="{{ URL::asset('icones/thumbnail_GESCON.png') }}" height="35" style="float:left;">
	
	<h1 style="font-size: 24px; margin-top: 5px">&nbsp; GESCON</h1>

@endsection

@section('texto_introducao')
	Olá {{ $fiscal_nome }},
@endsection

@section('texto_email')
	
	<table>
	    <tr>
            <td bgcolor="#ffffff">
                <table width="700" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin-top:15px">
                    <tbody>
	                    <tr>
	                        <td>
	                        	<table width="700" border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px">
	                            	<tbody>
		                              	<tr>
			                                <td>
			                                    <div style="font-family:Arial;font-size:18px;font-weight:bolder;text-align:center">
			                                        <div>
			                                            <img height="60" width="60" style="height:60px;max-height:60px;min-height:60px" 
														src="{{ URL::asset('modules/gescon/icons/icon_contrato.png') }}">
			                                        </div>
			                                        <span style="font-size:12px;font-weight:100">Contrato Número:</span>
			                                        <br>
			                                        <strong>{{ $contrato_nr_contrato }}</strong>
			                                    </div>
			                                </td>
			                                <td width="70%" valign="top" rowspan="2" style="padding-left:25px">
			                                    <div style="margin-right:auto;display:block;width:90%;font-family:Arial;line-height:1.3">                    
			                                        <h1 style="margin:5px 0;font-size:20px;font-weight:lighter;color:black;text-align:center">
			                                            <strong>Atenção!</strong> Contrato com vencimento próximo!
			                                        </h1>
			                                        <h4 style="margin:5px 0;font-weight:400;font-size:11px;color:gray;text-align:center"> Em caso de dúvidas entre em contato com a CONTRATOS/SAMF.</h4>
			                                    </div>
			                                    <div style="border:solid #e1e1e1;border-width:2px">
			                                        
			                                        <div style="margin:0 auto 0 auto;background-color:#f2f3f3;width:100%;padding-bottom:1px">
			                                            <p style="font-family:Arial;font-size:18px;color:#cf0022;text-align:center;margin:0px 0 5px 0!important;padding-top:5px">
			                                                <b>Data de Cessação: <span>{{ $contrato_dt_cessacao }}</span></b>
			                                            </p>
			                                            <p style="font-family:Arial;font-size:13px;color:#333;text-align:center;margin:3px!important">
			                                                Prazo para vencimento: <b>{{ $contrato_prazo_vencimento }} dias</b>.
			                                            </p>
			                                            <p style="font-family:Arial;font-size:13px;color:#333;text-align:center;margin:5px 0 4px 0!important">
			                                                {{ $contratada_no_razao_social }}
			                                            </p>
			                                        </div>
			                                        
			                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px;line-height:2">
			                                                
			                                            <tbody>

			                                                <tr>
			                                                    <td width="100%" height="20">
			                                                        <p style="font-family:Arial;font-size:13px;color:#575757;text-align:justify;margin:3px!important">
			                                                            <b>Objeto:</b><br>
			                                                            {{ $contrato_objeto }}
			                                                        </p> 
			                                                    </td>
			                                                    
			                                                </tr>

			                                                <tr>
			                                                    <td width="75%" valign="top" style="text-align:left;padding-top:10px;border-top:1px solid #c7dada">
			                                                        <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                            Modalidade: {{ $contrato_modalidade }}<br>
			                                                        </span>

			                                                        <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                            Valor Anual: R$ {{ $contrato_vl_anual }}<br>
			                                                        </span>

			                                                        <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                            Valor Global: R$ {{ $contrato_vl_global }}
			                                                        </span>
			                                                    </td>
			                                                    
			                                                </tr>
			                                                    
			                                            </tbody>
			                                        </table>
			                                        
			                                        <table style="font-family:Arial;font-size:13px;padding:12px;color:#575757;line-height:1.6em;width:100%;background-color:#f2f3f3">
			                                            <tbody>
			                                                <tr>
			                                                    <td>
			                                                        <span style="font-family:Arial">* Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas accumsan nisl et commodo tincidunt. Morbi id lorem pretium, gravida massa ut, volutpat ligula</span>
			                                                        <br>
			                                                        <span style="font-family:Arial">* Fusce eget accumsan quam. Aliquam purus sapien, posuere id efficitur id, hendrerit sed elit. Pellentesque a ante sem.</span>
			                                                        <br>
			                                                        <span style="font-family:Arial">* Nullam elit erat, semper eu enim sit amet, pretium scelerisque tortor.</span>
			                                                        <br>
			                                                        <span style="font-family:Arial">* Praesent scelerisque dictum lectus, at dictum neque egestas sed.</span>
			                                                    </td>
			                                                </tr>
			                                            </tbody>
			                                        </table>
			                                    </div>
			                                </td>
			                            </tr>
		                            	<tr>
		                                	<td width="144" height="400" valign="top" style="text-align:center"></td>
			                            </tr>
	                        		</tbody>
	                    		</table>
	                        </td>
	                    </tr>
                    </tbody>
                </table>
            </td>
	    </tr>
	</table>

@endsection

@section('texto_assinatura')
	Atenciosamente,<br>
	CONTRATOS/SAMF
@endsection