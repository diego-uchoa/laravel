
@section('exception')
	@if(isset($exception))
		<div style="padding: 50px">
		    <div class="alert alert-danger">
		        Ops! Ocorreu um erro.<br>
		        
		        <div>{{$exception}} - {{$message}}</div>
		    	
		    </div>
		    <a href="{{ URL::previous() }}" class="btn btn-large btn-danger">Voltar</a>
		</div>
	@endif
@endsection