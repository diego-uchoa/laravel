@extends('sishelp::layouts.master')

@section('script-head')

	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
       tinymce.init({
           selector: 'textarea',
           plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table contextmenu directionality emoticons template paste textcolor'
           ],
           toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons'           
       });
   </script>

@endsection


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sishelp::ajuda_geral.create') !!}

@endsection

@section('page-header')
	Criar Novo - Ajuda Geral
@endsection

@section('content')

    {!! Form::open(['route'=>'sishelp::ajuda_geral.store']) !!}

        @include('sishelp::ajuda_geral._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection

@section('script-end')

	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

	<script>
		tinymce.init({
			selector: 'textarea',
			plugins: 'link code',
			menubar: false
		});
	</script>

@endsection