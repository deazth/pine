@extends('master')

@section('content')
<div class="card-columns">
  <div class="card">
    <div class="card-header">Graf 1</div>
    <div class="card-body">
      {!! $chart1->container() !!}
    </div>
  </div>
  <div class="card">
    <div class="card-header">Graf 2</div>
    <div class="card-body">
      {!! $chart2->container() !!}
    </div>
  </div>
</div>
@stop

@section('after_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  {!! $chart1->script() !!}
  {!! $chart2->script() !!}
@stop
