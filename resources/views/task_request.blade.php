@extends('master')

@section('content')
@if(session()->has('feedback'))
<div class="alert alert-{{session()->get('feedback_type')}} alert-dismissible" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('feedback_text')}}
</div>
@endif
<div class="card">
    <div class="card-header">Task Request</div>
    <div class="card-body">
        <div class="container">
            <form id="form" action="{{route('task.submitrequest')}}" method="POST">
            @csrf
                @if($task ?? '')
                    <input class="form-control" type="text" hidden name="inputid" value="{{$task->id}}" required>
                    <input class="form-control" type="text" hidden name="inputref" value="{{$task->reference_no}}" required>
                @elseif($draft ?? '')
                    @if($draft[4]!="")
                    <input class="form-control" type="text" hidden name="inputparentid" value="{{$draft[4]}}" required>

                    @endif
                @endif
                <input class="form-control d-none" type="text" hidden id="inputassignid" name="inputassignid">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2">Reference No:</div>
                                <div class="col-lg-10">
                                    @if($task ?? '')
                                        {{$task->reference_no}}
                                    @elseif($draft ?? '')
                                        {{$draft[0]}}
                                    @endif
                                </div>
                                @if($task ?? '')
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Created Date:</div>
                                <div class="col-lg-10">
                                    @if($task ?? '')
                                        {{$task->created_at}}
                                    @endif
                                </div>

                                @endif
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Status:</div>
                                <div class="col-lg-10">
                                    @if($task ?? '')
                                        {{$task->status}}
                                    @elseif($draft ?? '')
                                        {{$draft[1]}}
                                    @endif
                                </div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Requested by:</div>
                                <div class="col-lg-10">
                                    @if($task ?? '')
                                        {{ucfirst($task->user->staff_no)}} - {{ucfirst($task->user->name)}}
                                    @elseif($draft ?? '')
                                        {{ucfirst($draft[2])}} - {{ucfirst($draft[3])}}
                                    @endif
                                </div>
                                    @if($task ?? '')
                                        @if(($task->status!="Open")&&($task->status!="Advertised"))
                                        <div class="mt-2 col-lg-12"></div>
                                        <div class="col-lg-2">Assigned to:</div>
                                        <div class="col-lg-10">
                                                    {{ucfirst($task->assign->staff_no)}} - {{ucfirst($task->assign->name)}}

                                        </div>
                                        @endif
                                    @endif
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Title:</div>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" id="inputname" name="inputname" placeholder="Insert Title"
                                    @if($task ?? '')
                                        value="{{$task->name}}" readonly
                                    @endif
                                    required>
                                </div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Description:</div>
                                <div class="col-lg-10">
                                    <textarea class="form-control" type="text" id="inputdescription" name="inputdescription" @if($task ?? '') @if($task->status!="Open") disabled @endif @endif rows="5" required placeholder="Insert Description">@if($task ?? ''){{$task->descr}}@endif</textarea>
                                </div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Skill Category:</div>
                                @if($task ?? '')
                                        @if($task->status!="Open")
                                        <input class="form-control" type="text" hidden name="inputskillcat" value="{{$task->skill_cat_id}}" required>
                                        @endif
                                    @endif
                                <div class="col-lg-6">
                                    <select class="form-control" id="inputskillcat" name="inputskillcat"
                                    @if($task ?? '')
                                        @if($task->status!="Open")
                                            readonly
                                        @endif
                                    @endif
                                    required>
                                        <option hidden disabled value=""
                                            @if($task ?? '')
                                                @if($task->skill_cat_id=="")
                                                    selected
                                                @endif
                                            @else
                                                selected
                                            @endif>Select Skill Category
                                        </option>
                                        @foreach($skillcat as $single)
                                        <option value="{{$single->id}}">{{$single->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4"></div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Skill:</div>
                                    @if($task ?? '')
                                        @if($task->status!="Open")
                                        <input class="form-control" type="text" hidden name="inputskill" value="{{$task->skill_id}}" required>
                                        @endif
                                    @endif
                                <div class="col-lg-6">
                                    <select class="form-control" id="inputskill" name="inputskill"
                                    @if($task ?? '')
                                        @if($task->status!="Open")
                                            disabled
                                        @endif
                                    @elseif($draft ?? '')
                                        disabled
                                    @endif
                                    required>
                                        @if($task ?? '')
                                            @foreach($skill as $single)
                                                <option value="{{$single->id}}">{{$single->name}}</option>
                                            @endforeach
                                        @elseif($draft ?? '')
                                            <option hidden disabled selected value="">Select Skill</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5 col-lg-12"></div>
                <div class="text-center">
                    @if($task ?? '')
                        @if($task->user_id==$user)
                            @if(($task->status=="Open")||($task->status=="Proposed")||($task->status=="Advertised"))
                                <button type="submit" class="btn btn-primary">Advertise Task</button>
                                @if(($task->status=="Open")||($task->status=="Advertised"))
                                <button id="assign" type="button" class="btn btn-success"
                                data-toggle="modal" data-target="#ass">Propose Assignee</button>
                                @elseif($task->status=="Proposed")
                                <button id="assign" type="button" class="btn btn-success"
                                data-toggle="modal" data-target="#ass">Propose to other Assignee</button>
                                @endif
                            @elseif($task->status=="Request to Cancel")
                                <div class="mb-4 text-danger">The assignee has requested to cancel his progress</div>
                                <a href="{{route('task.cancellationreject')}}" onClick="confirm('Reject assignee request to cancel?')"><button type="button" class="btn btn-danger">Reject</button></a>
                                <a href="{{route('task.cancellationapprove')}}" onClick="confirm('Approve assignee request to cancel?')"><button type="button" class="btn btn-success">Approve</button>
                               <!---- resquester action --->
                                  @elseif($task->status=="Pending Verification")
                                      <div class="mb-4 text-info">The assignee has marked this task as completed</div>
                                      <a href="{{route('task.requesterReject',['task_id'=>$task->id ],false) }}" onClick="confirm('Mark incomplete and return to assignee?')"><button type="button" class="btn btn-danger">Reject</button></a>
                                      <a href="{{route('task.cancellationapprove')}}" onClick="confirm('Mark this task ask complete?')"><button type="button" class="btn btn-success">Approve</button>

                            <!---- resquester action  end--->
                            @endif
                        @elseif($task->assign_id==$user)
                            @if($task->status=="Proposed")
                            <a href="{{route('task.proposedreject',['task_id'=>$task->id ],false)}}" onClick="return confirm('Reject this task?')"><button type="button" class="btn btn-danger">Reject</button></a>
                            <a href="{{route('task.proposedaccept',['task_id'=>$task->id ],false)}}" onClick="return confirm('Accept this task?')"><button type="button" class="btn btn-success">Accept</button></a>
                            <button id="assign" type="button" class="btn btn-primary"
                                data-toggle="modal" data-target="#ass">Propose to other Assignee</button>
                            @elseif($task->status=="In Progress")
                            <a href="{{route('task.assigneeCancel',['task_id'=>$task->id ],false) }}" onClick="return confirm('Request to cancel this task?')"><button type="button" class="btn btn-danger">Request Cancellation</button></a>
                            <a href="{{route('task.assigneeComplete',['task_id'=>$task->id ],false) }}" onClick="return confirm('Mark this task as completed?')"><button type="button" class="btn btn-success" onclick="assigneeAction($task->id)">Task Completed</button></a>
                            <a href="{{route('task.assigneeExtend',['task_id'=>$task->id ],false) }}" onClick="confirm('Extend this task as a requester to another assignee?')"><button type="button" class="btn btn-primary">Extend</button></a>
                            @endif
                        @endif
                    @endif
                    @if($draft ?? '')
                        <button type="submit" class="btn btn-primary">Advertise Task</button>
                        <button id="assign" type="button" class="btn btn-success" data-toggle="modal" data-target="#ass">Propose Assignee</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@if($task->status == 'Advertised' && count($task->applicant)!=0)
<div class="card">
    <div class="card-header">Applicant</div>
    <div class="card-body">
        <div class="container">
            <div class="table-responsive">
                <table id="tapplicant" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Staff Name</th>
                            <th>Have requested Skil</th>
                            <th>Staff Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($task->applicant as $single)
                        <tr>
                            <td><a href="{{ route('user.profile', ['staff_no' => $single->user->staff_no]) }}">{{$single->user->name}}</a></td>
                            <td>
                              @if($single->user->hasSkill($task->skill_id))
                              Yes
                              @else
                              No
                              @endif
                            </td>
                            <td>{{$single->user->total_do_count == 0 ? 0 : $single->user->total_do_rating / $single->user->total_do_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

@if($draft ?? '')
    @if($draft[4]!="")
    <div class="card">
        <div class="card-header">Original Task</div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Reference No</th>
                                <th>Task title</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{route('task.viewrequest',['inputid'=>$draft[4] ],false) }}" onClick="return confirm('View parent task?')">{{$draft[5]}}
                                </a></td>
                                <td>{{$draft[6]}}</td>
                                <td>{{$draft[7]}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@endif

@if($task ?? '')
    @if($task->parent_id!="")
    <div class="card">
        <div class="card-header">Original Task</div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Reference No</th>
                                <th>Task title</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="{{route('task.viewrequest',['inputid'=>$task->parent->id ],false) }}" onClick="return confirm('View parent task?')">{{$task->parent->reference_no}}
                                </a></td>
                                <td>{{$task->parent->name}}</td>
                                <td>{{$task->parent->created_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(count($task->child)!=0)
    <div class="card">
        <div class="card-header">Child Task</div>
        <div class="card-body">
            <div class="container">
                <div class="table-responsive">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Reference No</th>
                                <th>Task title</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($task->child as $single)
                            <tr>
                                <td><a href="{{route('task.viewrequest',['inputid'=>$single->id ],false) }}" onClick="return confirm('View parent task?')">{{$single->reference_no}}
                                </a></td>
                                <td>{{$single->name}}</td>
                                <td>{{$single->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="row">
            @if(count($task->interaction)!=0)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Task Interaction</div>
                    <div class="card-body">
                        @foreach($task->interction as $single)
                            <div class="card">
                                <div class="card-body">
                                    @if($single->user_id==$task->user_id)
                                        <div class="w-100" style="text-align: left">{{$single->user->name}}</div>
                                    @else
                                        <div class="w-100" style="text-align: right">{{$single->user->name}}</div>
                                    @endif
                                    <div class="w-100" style="text-align: center">{{$single->created_at}}</div>
                                    {{$single->message}}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endif


<!-- Task Parent -->
<!-- <div class="card">
    <div class="card-header">Task Request</div>
    <div class="card-body">
    </div>
</div> -->

@endsection

<div id="assignee" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Propose Assignee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body text-center">
                <select class="form-control" id="inputassignee" name="inputassignee">
                    <option hidden disabled value="" selected>Select Assignee</option>
                    @foreach($assignee as $single)
                        @if($task ?? '')
                            @if(($single->id!=$user)&&($single->id!=$task->user_id))
                                <option value="{{$single->id}}"> {{ucfirst("$single->staff_no ")}} - {{ucfirst("$single->name ")}}</option>
                            @endif
                        @else
                            @if($single->id!=$user)
                                <option value="{{$single->id}}"> {{ucfirst("$single->staff_no ")}} - {{ucfirst("$single->name ")}}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                <button id="assignassignee" class="mt-4 btn btn-success">Propose Assignee</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('after_scripts')
<script type="text/javascript" src="{{ asset('packages/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $("#inputskillcat").on('change', function(){
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
    });

    function updateResp(item, index){
        $( "#inputskill" ).append('<option value="'+item.id+'">'+item.name+'</option>');
    }


    $("#assign").on('click', function(){
        if($('#inputname').get(0).checkValidity()==false){
            $('#inputname').get(0).reportValidity();
        }else if($('#inputdescription').get(0).checkValidity()==false){
            $('#inputdescription').get(0).reportValidity();
        }else if($('#inputskillcat').get(0).checkValidity()==false){
            $('#inputskillcat').get(0).reportValidity();
        }else if($('#inputskill').get(0).checkValidity()==false){
            $('#inputskill').get(0).reportValidity();
        }else{
            $("#assignee").modal("show");
        }
    });

    $("#assignassignee").on('click', function(){
        $("#inputassignid").removeClass("d-none");
        $("#inputassignid").val($("#inputassignee").val());
        $("#form").submit();

    });


    function assigneeAction(taskid, act){


//confirm('Mark this task as completed?
    		$('#task_id').val(taskid);
        $('#act_val').val(act);
    		$('#formAssigneeAction').submit();

      };
</script>
@stop
