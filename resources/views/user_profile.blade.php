@extends('master')

@section('content')

<div class="card mb-3">
  <div class="card-header">Personal Profile</div>
  <div class="card-body">
    
  </div>
</div>

<div class="card mb-3">
  <div class="card-header">Something about me</div>
  <div class="card-body">
    <div class="card-columns">
      <div class="card">
        <div class="card-header">Lifetime Stat</div>
        <div class="card-body">
          {!! $chart1->container() !!}
        </div>
      </div>
      <div class="card">
        <div class="card-header">This Month's Stat</div>
        <div class="card-body">
          {!! $chart2->container() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('after_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  {!! $chart1->script() !!}
  {!! $chart2->script() !!}
@stop
