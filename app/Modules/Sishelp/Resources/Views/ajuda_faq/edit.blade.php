@extends('sishelp::layouts.master')

@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sishelp::ajuda_faq.edit', $faq) !!}

@endsection


@section('page-header')
	Editar - Ajuda FAQ 
	<small>
        <i class="ace-icon fa fa-angle-double-right"></i>
        {{$faq->no_ajuda_faq}}
    </small>
@endsection


@section('content')

    {!! Form::model($faq, ['route'=>['sishelp::ajuda_faq.update', $faq->id_ajuda_faq], 'method'=>'put']) !!}

        @include('sishelp::ajuda_faq._form',['submit_text' => 'Editar'])

    {!! Form::close() !!}

@endsection