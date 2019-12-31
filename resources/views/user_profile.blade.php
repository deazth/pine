@extends('master')

@section('content')

<div class="card mb-3">
  <div class="card-header">Personal Profile</div>
  <div class="card-body ">
    <div class="row">
      <div class="col-sm-4 text-center">
        <img src="{{ route('user.image', ['staff_no' => $staff_no ])}}" height="200px"/>
      </div>
      <div class="col-sm-8">
        <samp>
          @if(isset($info))
          {{ $info->Name }}<br />
          {{ $info->Position }}<br />
          {{ $info->Org_Unit }}
          @else
          User 404
          @endif
        </samp>
      </div>
    </div>


  </div>
</div>

<div class="card mb-3">
  <div class="card-header">Something about me</div>
  <div class="card-body">
    <div class="card-columns">
      @if(isset($chart1))
      <div class="card">
        <div class="card-header">As a Requestor</div>
        <div class="card-body">
          {!! $chart1->container() !!}
        </div>
      </div>
      @endif
      @if(isset($chart2))
      <div class="card">
        <div class="card-header">As a Requestee</div>
        <div class="card-body">
          {!! $chart2->container() !!}
        </div>
      </div>
      @endif
      @if(isset($chart3))
      <div class="card">
        <div class="card-header">Some Statistic</div>
        <div class="card-body">
          {!! $chart3->container() !!}
        </div>
      </div>
      @endif
      @if(isset($chart4))
      <div class="card">
        <div class="card-header">Stat on SUCCESS as Assignee</div>
        <div class="card-body">
          {!! $chart4->container() !!}
        </div>
      </div>
      @endif
      <a href="{{route('profile.cal', ['staff_no' => $staff_no])}}">
      <div class="card text-white bg-success">
        <div class="card-header">All My Completed Tasks</div>
        <div class="card-body">
          <p>Task count: {{ $task_count }}. Click Me</p>
        </div>
      </div></a>
    </div>
  </div>
</div>

@stop

@section('after_styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
@stop

@section('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@if(isset($chart1))
  {!! $chart1->script() !!}
@endif
@if(isset($chart2))
  {!! $chart2->script() !!}
@endif
@if(isset($chart3))
  {!! $chart3->script() !!}
@endif
@if(isset($chart4))
  {!! $chart4->script() !!}
@endif
@stop
