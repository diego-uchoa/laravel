@extends('sishelp::layouts.master')


@section('breadcrumbs-page')

	{!! Breadcrumbs::render('sishelp::ajuda_faq.create') !!}

@endsection


@section('page-header')
	Criar Novo - Ajuda FAQ
@endsection

@section('content')

    {!! Form::open(['route'=>'sishelp::ajuda_faq.store']) !!}

        @include('sishelp::ajuda_faq._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection