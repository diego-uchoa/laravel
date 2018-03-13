@extends('layouts.template-email', ['corcabecalho' => '#0E3455'])

@section('cabecalho')
	<img src="{{ URL::asset('icones/thumbnail_PRISMA.png') }}" height="35" style="float:left;">
	
	<h1 style="font-size: 24px; margin-top: 5px">&nbsp; PRISMA FISCAL</h1>

@endsection


@section('texto_email')
	
	<table>
	    <tr>
            <td bgcolor="#ffffff">
                <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="margin-top:0px">
                    <tbody>
	                    <tr>
	                        <td>
	                        	<table width="600" border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px">
	                            	<tbody>
		                              	<tr>
			                                <td valign="top" >
			                                    <div style="font-family:Arial;font-size:18px;font-weight:bolder;text-align:center;">
			                                        <div>
			                                            <img height="60" width="60" style="height:60px;max-height:60px;min-height:60px;" 
														src="{{ URL::asset('modules/prisma/icons/icon-ok.ico') }}">
			                                        </div>
			                                        
			                                    </div>
			                                </td>
			                                <td width="90%" valign="top" rowspan="2" style="padding-left:25px">
			                                    <div style="margin-right:auto;display:block;width:120%;font-family:Arial;line-height:1.3">                    
			                                        <h3 style="margin:5px 0;font-weight:400;font-size:14px;color:gray;">
													Prezado(a) {{ $nome_responsavel }},<br><br>
			                                        a solicitação de cadastro de instituição <b>foi aprovada</b> pelos gestores do Prisma Fiscal. Um e-mail com os dados de acesso foi enviado para todos os usuários (responsável e editores) informados na solicitação.</h3>
			                                    </div>
			                                    <br>
			                                    <div style="border:solid #e1e1e1;border-width:2px">
			                                        
			                                        <div style="margin:0 auto 0 auto;background-color:#f2f3f3;width:100%;padding-bottom:1px">
			                                            <p style="font-family:Arial;font-size:14px;color:#cf0022;text-align:center;margin:0px 0 5px 0!important;padding-top:5px">
			                                                <b><span> Dados da Instituição Cadastrada</span></b>
			                                            </p>
			                                        </div>
			                                        
			                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding:10px;line-height:2">
			                                                
			                                            <tbody>

			                                                <tr>
			                                                    <td width="100%" height="20">
			                                                        <p style="font-family:Arial;font-size:13px;color:#575757;text-align:justify;margin:3px!important">
			                                                            
			                                                            <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                                CNPJ:  {{ $cnpj }}<br>
			                                                            </span>

			                                                            <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                                Instituição:  {{ $instituicao }}<br>
			                                                            </span>

			                                                            <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                                Nome Relatório:  {{ $nome_relatorio }}<br>
			                                                            </span>
			                                                            			                                                            
			                                                        </p> 
			                                                    </td>
			                                                    
			                                                </tr>

			                                                <tr>
			                                                    <td width="75%" valign="top" style="text-align:left;padding-top:10px;border-top:1px solid #c7dada">
			                                                        <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                            Responsável:  {{ $nome_responsavel }}<br>
			                                                        </span>

			                                                        <span style="font-family:Arial;font-size:12px;color:#575757;line-height:1.6em">
			                                                            CPF: {{ $cpf }}<br>
			                                                        </span>

			                                                    </td>
			                                                    
			                                                </tr>
			                                                    
			                                            </tbody>
			                                        </table>

			                                        <!-- <table style="font-family:Arial;font-size:13px;padding:12px;color:#575757;line-height:1.6em;width:100%;background-color:#f2f3f3">
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
			                                        </table> -->
			                                        
			                                        
			                                    </div>
			                                </td>
			                            </tr>
		                            	<tr>
		                                	<td width="144" height="200" valign="top" style="text-align:center"></td>
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
