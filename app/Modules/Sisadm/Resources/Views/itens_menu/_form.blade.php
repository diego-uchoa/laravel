<div class="control-group">
		        <label class="control-label">Tipo do Menu:</label>
		        <div class="radio">
		            <label>
		                <input name="tipo" type="radio" class="ace" value='raiz'
							@if(isset ($itemMenu))
					            {{ $itemMenu->tipo == 'raiz' ? 'checked="checked"' : '' }}
					    	@endif
		                />
		                <span class="lbl"> Menu Raiz</span>
		            </label>
		        </div>
		        <div class="radio">
		            <label>
		                <input name="tipo" type="radio" class="ace" value='submenu'
							@if(isset ($itemMenu))
					            {{ $itemMenu->tipo == 'submenu' ? 'checked="checked"' : '' }}
					    	@endif
		                />
		                <span class="lbl"> Submenu</span>
		            </label>
		        </div>
		    </div>

<div id="dv_nome" class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('no_item_menu', null, ['class'=>'form-control']) !!}
</div>

<div id="dv_sistema" class="form-group">
	{!! Form::label('sistema', 'Sistema:') !!}
	<select name="id_sistema" class="form-control">
	    @foreach($sistemas as $sistema)
	        <option value="{{$sistema->id_sistema}}"

	        	@if(isset ($itemMenu->sistema->id_sistema))
		            {{ $itemMenu->sistema->id_sistema == $sistema->id_sistema ? 'selected="selected"' : '' }}
		    	@endif

	        >{{$sistema->no_sistema}}</option>
	    @endforeach
	</select>
</div>

<div id="dv_precedente" class="form-group">
	{!! Form::label('itemMenuPrecedente', 'Item de Menu Precedente:') !!}
	
	<select  id="itemMenuPrecedente" name="id_item_menu_precedente">
		
		@foreach($itensMenu as $item)
            @if(!$item->id_item_menu_precedente)
	    		        
				
				@if(isset ($itemMenu))
					
					@if($item->id_item_menu == $itemMenu->id_item_menu_precedente)
						<option value="{{$item->id_item_menu}}" selected="select">{{$item->no_item_menu}}</option>
		            @else
		            	<option value="{{$item->id_item_menu}}">{{$item->no_item_menu}}</option>	
		        	@endif

		        	{!! ItemMenuHelper::montaSelectMenu($item->id_item_menu, $item->itensMenuFilhos,$itemMenu->id_item_menu_precedente) !!}
		        
		        @else
		        	
		        	<option value="{{$item->id_item_menu}}">{{$item->no_item_menu}}</option>
		        	{!! ItemMenuHelper::montaSelectMenu($item->id_item_menu, $item->itensMenuFilhos) !!}    
		    	
		    	@endif		        
				
			
			@endif
			
        @endforeach
	</select>
</div>

<div id="dv_rota" class="form-group">
    {!! Form::label('rota', 'Rota:') !!}
    {!! Form::text('rota', null, ['class'=>'form-control']) !!}
</div>

<div id="dv_ordem" class="form-group">
    {!! Form::label('ordem', 'Ordem:') !!}
    {!! Form::text('ordem', null, ['class'=>'form-control']) !!}
</div>


<div id="dv_icon" class="form-group">
	{!! Form::label('icon', 'Ícone do Menu:') !!}
	<br>
	<select title="Selecione o icon" class="selectpicker" id="icon" name="icon">
         	<option>Selecione</option>
			<option value="menu-icon glyphicon glyphicon-th-large" data-icon="glyphicon glyphicon-th-large"></option>
			<option value="menu-icon glyphicon glyphicon-th" data-icon="glyphicon glyphicon-th"></option>
			<option value="menu-icon glyphicon glyphicon-user" data-icon="glyphicon glyphicon-user"></option>
			<option value="menu-icon glyphicon glyphicon-signal" data-icon="glyphicon glyphicon-signal"></option>
			<option value="menu-icon glyphicon glyphicon-cog" data-icon="glyphicon glyphicon-cog"></option>
			<option value="menu-icon glyphicon glyphicon-file" data-icon="glyphicon glyphicon-file"></option>
			<option value="menu-icon glyphicon glyphicon-download-alt" data-icon="glyphicon glyphicon-download-alt"></option>
			<option value="menu-icon glyphicon glyphicon-inbox" data-icon="glyphicon glyphicon-inbox"></option>
			<option value="menu-icon glyphicon glyphicon-repeat" data-icon="glyphicon glyphicon-repeat"></option>
			<option value="menu-icon glyphicon glyphicon-list-alt" data-icon="glyphicon glyphicon-list-alt"></option>
			<option value="menu-icon glyphicon glyphicon-folder-open" data-icon="glyphicon glyphicon-folder-open"></option>
			<option value="menu-icon glyphicon glyphicon-barcode" data-icon="glyphicon glyphicon-barcode"></option>
			<option value="menu-icon glyphicon glyphicon-tag" data-icon="glyphicon glyphicon-tag"></option>
			<option value="menu-icon glyphicon glyphicon-book" data-icon="glyphicon glyphicon-book"></option>
			<option value="menu-icon glyphicon glyphicon-font" data-icon="glyphicon glyphicon-font"></option>
			<option value="menu-icon glyphicon glyphicon-bold" data-icon="glyphicon glyphicon-bold"></option>
			<option value="menu-icon glyphicon glyphicon-align-justify" data-icon="glyphicon glyphicon-align-justify"></option>
			<option value="menu-icon glyphicon glyphicon-facetime-video" data-icon="glyphicon glyphicon-facetime-video"></option>
			<option value="menu-icon glyphicon glyphicon-map-marker" data-icon="glyphicon glyphicon-map-marker"></option>
			<option value="menu-icon glyphicon glyphicon-share" data-icon="glyphicon glyphicon-share"></option>
			<option value="menu-icon glyphicon glyphicon-check" data-icon="glyphicon glyphicon-check"></option>
			<option value="menu-icon glyphicon glyphicon-screenshot" data-icon="glyphicon glyphicon-screenshot"></option>
			<option value="menu-icon glyphicon glyphicon-leaf" data-icon="glyphicon glyphicon-leaf"></option>
			<option value="menu-icon glyphicon glyphicon-calendar" data-icon="glyphicon glyphicon-calendar"></option>
			<option value="menu-icon glyphicon glyphicon-open" data-icon="glyphicon glyphicon-open"></option>
			<option value="menu-icon glyphicon glyphicon-transfer" data-icon="glyphicon glyphicon-transfer"></option>
			<option value="menu-icon glyphicon glyphicon-stats" data-icon="glyphicon glyphicon-stats"></option>
			<option value="menu-icon glyphicon glyphicon-tree-deciduous" data-icon="glyphicon glyphicon-tree-deciduous"></option>
			<option value="menu-icon glyphicon glyphicon-phone-alt" data-icon="glyphicon glyphicon-phone-alt"></option>
			<option value="menu-icon glyphicon glyphicon-phone" data-icon="glyphicon glyphicon-phone"></option>
        </select>
</div>

<br><br>

<div id="dv_btn" class="form-group">
	{!! Form::submit($submit_text,['class'=>'btn btn-sm btn-primary']) !!}
	<a href="{{ URL::previous() }}" class="btn btn-large btn-sm btn-danger">Voltar</a>
</div>


@section('script-end')

<link rel="stylesheet" href="{{ URL::asset('assets/tree/jquery.bootstrap.treeselect.css') }}" />
<script src="{{ URL::asset('assets/tree/jquery.bootstrap.treeselect.js') }}" ></script>
<link rel="stylesheet" href="{{ URL::asset('assets/tree/jquery.bootstrap.select.css') }}" />
<script src="{{ URL::asset('assets/tree/bootstrap-select.js') }}" ></script>

<script type="text/javascript">		
	$(function(){
		$('#itemMenuPrecedente').treeselect();
        $('#productGroup').treeselect();
    });
</script>

@endsection

	