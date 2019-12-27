@extends('master')

@section('content')
<div class="card-column">
  <div class="card">
    <div class="card-header">Graf 1</div>
    <div class="card-body">
      {!! $chart1->container() !!}
    </div>
  </div>
</div>
@endsection
