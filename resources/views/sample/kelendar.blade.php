@extends('master')

@section('after_styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@stop

@section('content')
<div class="card">
    <div class="card-header">kelendar hup seng lumba kuda</div>
    <div class="card-body">
      {!! $cds->calendar() !!}
    </div>
</div>
@stop

@section('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $cds->script() !!}
@stop
