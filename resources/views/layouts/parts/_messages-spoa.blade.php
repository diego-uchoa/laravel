@section('exception')
	@if(isset($exception))
		<div style="padding: 50px">
		    <div class="alert alert-danger">
		        Ops! Ocorreu um erro.<br>
		        
		        <div>
		        	{{$exception}}
					
					@if(isset($message))
				 	 - {{$message}}
					@endif
					
		        </div>
		    	
		    </div>
		    <a href="{{ URL::previous() }}" class="btn btn-large btn-danger">Voltar</a>
		</div>
	@endif
@endsection

{{-- Mensagens de Erro do Sistema --}}


@if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- Mensagens de Exceções do Sistema --}}

@if(Session::has('exception'))
	<div class="alert alert-danger center">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{Session::get('exception') }} - {{Session::get('message_exception') }}
	</div>
@endif


{{-- Mensagens do Sistema --}}

@if(Session::has('status'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{Session::get('status') }}
	</div>
@endif

@if (session('message'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('message') }}
	</div>
@endif


@if (session('warning'))
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('warning') }}
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('error')['mensagem'] }}
		<br><br>
		<b>Erro:</b> {{ session('error')['erro'] }}
	</div>
@endif

@if (session('info'))
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ session('info') }}
	</div>
@endif