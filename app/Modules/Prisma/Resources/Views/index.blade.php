@extends('prisma::layouts.master')

@section('breadcrumbs-page')

    {!! Breadcrumbs::render('prisma::inicio') !!}

@endsection

@section('content')
	@permission('prisma::perfil.gestores')
		@include('prisma::inicio._gestores')
	@endpermission

	@permission('prisma::perfil.instituicoes')
		@include('prisma::inicio._instituicoes')
	@endpermission
@endsection 

@section('script-end')

@endsection