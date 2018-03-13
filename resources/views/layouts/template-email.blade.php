<!DOCTYPE html>
<html lang="en">
	<body>

		<div class="container">
		  <center>
		  <table style="border-spacing: 0; border-collapse: collapse;  width:80%; border: 2px solid #ddd; text-align:left; margin-bottom: 20px; font-family: sans-serif;">
		    <thead>
		      <tr   @if(isset($corcabecalho))
		      			style="background-color: {{ $corcabecalho }};"
		      		@else
		      			style="background-color: #3459B8;"
		      		@endif 
		      		height="50">
		      		
		      	<th style="padding-left: 2em; color: #ffffff; position: static; float: none; border-bottom-width: 2px">
		      		@yield('cabecalho')
					

		      	</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td style="padding: 0"><br></td>
		      </tr>      
		      <tr class="success">
		        <td style="padding-left: 1em">@yield('texto_introducao')</td>
		      </tr>
		      <tr class="danger">
		        <td><br></td>
		      </tr>
		      <tr class="info">
		        <td style="padding-left: 1em">
		        	
		        	@yield('texto_email')
		        	
		       	</td>
		      </tr>
		      <tr class="danger">
		        <td><br><br><br></td>
		      </tr>
		      <tr class="info">
		        <td style="padding-left: 1em">
		        	@yield('texto_assinatura')
		       	</td>
		      </tr>
		    </tbody>
		    <tfoot>
		    	<tr style="font-family: sans-serif; font-size: 8px; color: #808080; text-align:center">	
		    		<td><br>Este email é um serviço do Portal de Sistemas. Desenvolvido pela COGTI/SPOA</td>	
		    	</tr>
		    </tfoot>
		  </table>
		</center>
		</div>

	</body>
</html>