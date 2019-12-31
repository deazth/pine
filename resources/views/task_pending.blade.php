@extends('master')

@section('content')

@if(session()->has('feedback'))
<div class="alert alert-{{session()->get('feedback_type')}} alert-dismissible" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('feedback_text')}}
</div>
@endif

<div class="card">
    <div class="card-header">Assigned Task list</div>
        <div class="card-body">
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

                    @foreach($assign as $no=>$single)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$single->reference_no}}</td>
                            <td>{{$single->name}}</td>
                            <td>{{$single->status}}</td>
                            <td>
                                <form action="{{route('task.viewrequest')}}" method="POST" style="display:inline">
                                    <input class="form-control" type="text" hidden name="inputid" value="{{$single->id}}" required>
                                    @csrf
                                    <button type="submit" class="btn btn-success">VIEW</button>
                                </form>
                            </td>
                        </tr>
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
