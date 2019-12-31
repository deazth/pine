@extends('master')

@section('content')

@if(session()->has('feedback'))
<div class="alert alert-{{session()->get('feedback_type')}} alert-dismissible" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('feedback_text')}}
</div>
@endif

<div class="card">
    <div class="card-header">Advertised Task list</div>
        <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Reference No</th>
                        <th>Requestor</th>
                        <th>Title</th>
                        <th>Required Skill</th>
                        <th>Advertise Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($task as $single)
                        <tr>
                            <td>{{$single->reference_no}}</td>
                            <td><a href="{{ route('user.profile', ['staff_no' => $single->user->staff_no]) }}">{{$single->user->name}}</a></td>
                            <td>{{$single->name}}</td>
                            <td>{{$single->skill->name}}</td>
                            <td>{{$single->updated_at}}</td>
                            <td>
                              @if($single->iHaveApplied(backpack_user()->id))
                              <button type="button" class="btn btn-secondary" disabled>Applied</button>
                              @else
                                <form action="{{route('task.apply')}}" method="POST" style="display:inline">
                                    <input class="form-control" type="text" hidden name="inputid" value="{{$single->id}}" required>
                                    @csrf
                                    <button type="submit" class="btn btn-success">Apply</button>
                                </form>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-fixedheader-bs4/css/fixedHeader.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('packages/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">

@endsection

@section('after_scripts')
<script type="text/javascript" src="{{ asset('packages/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            "responsive": "true",
        });
    });
</script>
@stop
