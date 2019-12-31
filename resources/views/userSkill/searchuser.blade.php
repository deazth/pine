@extends('master')

@section('content')
@if(session()->has('feedback'))
<div class="alert alert-{{session()->get('feedback_type')}} alert-dismissible" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('feedback_text')}}
</div>
@endif
<div class="card">
    <div class="card-header">Find Staff with Skill</div>
        <div class="card-body">
            <div class="container">
<form action="{{route('userskill.find')}}" method="get">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="container">
                            <div class="row">
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Skill Category:</div>
                                <div class="col-lg-6">
                                    <select class="form-control" id="inputskillcat" name="inputskillcat">
                                        <option hidden disabled value="" >
                                          Select Skill Category
                                        </option>
                                        @foreach($skillcat as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Skill:</div>
                                <div class="col-lg-6">
                                    <select class="form-control" id="inputskill" name="inputskill" required    >                                    </select>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
<div class="mt-2 col-lg-12"></div>

                            <div class="text-left">
                                <button type="submit" class="btn btn-success">Find</button>
                            </div>


                        </div>
                    </div>
                </div>
              </form>

            </div>
        </div>
    </div>
    @if(isset($sresult))
    <div class="card">
      <div class="card-header">Staff with skill {{ $skillname }}</div>
      <div class="card-body">
        <div class="table-responsive">
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Accepted Task</th>
                        <th>Completed Task</th>
                        <th>Completion %</th>
                        <th>Overall Rating</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($sresult as $single)
                    <tr>
                        <td><a href="{{ route('user.profile', ['staff_no' => $single->user->staff_no]) }}">{{$single->user->name}}</a></td>
                        <td>{{$single->user->task_accept}}</td>
                        <td>{{$single->user->task_complete}}</td>
                        <td>{{$single->user->task_accept == 0 ? 0 : $single->user->task_complete / $single->user->task_accept * 100}}</td>
                        <td>{{$single->user->total_do_count == 0 ? 0 : $single->user->total_do_rating / $single->user->total_do_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
    @endif
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

        loadSkillList();
    });

    $("#inputskillcat").on('change', loadSkillList());

    function loadSkillList(){
      const url='{{ route("task.getskill", [], false)}}';

      $.ajax({
      url: url+"?inputskillcat="+$("#inputskillcat").val(),
      type: "GET",
      success: function(resp) {
          $( "#inputskill" ).html("");
          $( "#inputskill" ).attr("disabled", false);
          $( "#inputskill" ).append('<option hidden disabled selected value="">Select Skill</option>');
          resp.forEach(updateResp);
      },
          error: function(err) {
              // respjson.forEach(myFunction);
              alert("failed");
          }
      });
    }

    function updateResp(item, index){
        $( "#inputskill" ).append('<option value="'+item.id+'">'+item.name+'</option>');
    }
</script>
@stop
