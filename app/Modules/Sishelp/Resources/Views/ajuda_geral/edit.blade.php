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

	{!! Breadcrumbs::render('sishelp::ajuda_geral.edit', $geral) !!}

@endsection


@section('page-header')
	Editar - Ajuda FAQ 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$geral->sistema->no_sistema}}
    </small>
@endsection


@section('content')

    {!! Form::model($geral, ['route'=>['sishelp::ajuda_geral.update', $geral->id_ajuda_geral], 'method'=>'put']) !!}
        
        {{ Form::hidden('id_ajuda_geral', $geral->id_ajuda_geral) }}
        @include('sishelp::ajuda_geral._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection