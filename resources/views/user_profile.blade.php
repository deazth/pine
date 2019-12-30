@extends('master')

@section('content')

<div class="card mb-3">
  <div class="card-header">Personal Profile</div>
  <div class="card-body ">
    <div class="row">
      <div class="col-sm-4 text-center">
        <img src="{{ route('user.image')}}" height="200px"/>
      </div>
      <div class="col-sm-8">
        <samp>
          {{ $info->Name }}<br />
          {{ $info->Position }}<br />
          {{ $info->Org_Unit }}
        </samp>
      </div>
    </div>


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

@section('after_styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
@stop

@section('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
  {!! $chart1->script() !!}
  {!! $chart2->script() !!}
@stop
