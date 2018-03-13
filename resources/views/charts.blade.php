@extends('layouts.master')

@section('css')

@parent

{!! Charts::assets() !!}

@endsection

@section('content')

<div class="row">
  <div class="col-xs-4">
     {!! $chart->render() !!}
  </div>
  <div class="col-xs-4">
     {!! $chart2->render() !!}
  </div>
  <div class="col-xs-4">
     {!! $chart3->render() !!}
  </div>
</div>

<div class="row">
  <div class="col-xs-6">
     {!! $chart4->render() !!}
  </div>
  <div class="col-xs-6">
     {!! $chart5->render() !!}
  </div>
</div>
  
<div class="row">
  <div class="col-xs-4">
     {!! $chart6->render() !!}
  </div>
  <div class="col-xs-4">
     {!! $chart7->render() !!}
  </div>
  <div class="col-xs-4">
     {!! $chart8->render() !!}
  </div>
</div>


<div class="row">
  <div class="col-xs-4">
     {!! $chart9->render() !!}
  </div>
  <div class="col-xs-4">
     {!! $chart10->render() !!}
  </div>
  <div class="col-xs-4">
     {!! $chart11->render() !!}
  </div>
</div>

<div class="row"> 
  <div class="col-xs-4">
     {!! $chart12->render() !!}
  </div>
  <div class="col-xs-8">
     {!! $chart13->render() !!}
  </div>
</div>

<div class="row"> 
  <div class="col-xs-8">
     {!! $chart14->render() !!}
  </div>
</div>


@endsection

