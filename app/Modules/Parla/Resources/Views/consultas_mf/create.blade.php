@extends('parla::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('parla::consultasMf.create') !!}

@endsection

@section('page-header')
    Adicionar Consulta ao MF
@endsection

@section('content')

    {!! Form::open(['route'=>'parla::consultasMf.store']) !!}

        @include('parla::consultas_mf._form',['submit_text' => 'Salvar'])

    {!! Form::close() !!}

@endsection