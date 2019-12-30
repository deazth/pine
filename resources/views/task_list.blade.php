@extends('master')

@section('content')
<div class="card">
    <div class="card-header">Task list</div>
        <div class="card-body">
        <div class="text-right" style="margin-bottom: 15px">
            <form action="{{route('task.newrequest')}}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-success">REQUEST NEW TASK</button>
            </form>
        </div>
        @if(session()->has('feedback'))
        <div class="alert alert-{{session()->get('feedback_type')}} alert-dismissible" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{session()->get('feedback_text')}}
        </div>
        @endif
        <div class="table-responsive">
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Reference No</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                <tbody>
                    @foreach($task as $no=>$single)
                        <tr>{{++$no}}</tr>
                        <tr>{{$single->reference_no</tr>
                        <tr>{{$single->name</tr>
                        <tr>{{$single->status</tr>
                        <tr></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('after_scripts')
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#table').DataTable({
            "responsive": "true",
            // "order" : [[1, "asc"]],
            "searching": false,
            "bSort": false
        });
    });
</script> -->
@stop
