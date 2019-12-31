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

                                        <button id="btnapprove" type="button" class="btn btn-info"
                              						title="Edit" data-toggle="modal" data-target="#reqRateForm"
                              						data-id="{{$task->id}}">Approve</button>

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




<div class="modal fade" id="reqRateForm" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">


				<div class="modal-header">We are glad the job are finish. </div>
				<form method="POST" action="{{}}">
					@csrf
					<div class="modal-body">

						<div class="form-group row">

							<input class="form-control col-sm-3" id="task_id_rate"
								name="id" type="hidden" >
						</div>
Please rate: 1 <input type="radio" value="1" name="rateAssignee"/>
            2<input type="radio" value="2" name="rateAssignee"/>
            3<input type="radio" value="3" name="rateAssignee"/>
            4<input type="radio" value="4" name="rateAssignee"/>
            5<input type="radio" value="5" name="rateAssignee"/>

            <select name="success_rating_assign" class="form-control">
              <option value="1">Service Excellence</option>
              <option value="2">Unity and Teamwork</option>
              <option value="3">Cultivates stakeholders Collaboration</option>
              <option value="4">Catalyzes Change</option>
              <option value="5">Embraces & Nurtures Talent Mindset</option>
              <option value="6">Strives for Results</option>
              <option value="7">Strategic & Entrepreneurial Mindset</option>

            </select>
















					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"
							data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>

		</div>
	</div>
</div>

@section('after_scripts')
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

      $('#reqRateForm').on('show.bs.modal', function(e) {
          //get data-id attribute of the clicked element
          var id = $(e.relatedTarget).data('id');


          //populate the textbox
        //  $(e.currentTarget).find('task_id_rate').val(id);
  $(e.currentTarget).find('input[name="id"]').val(id);

      });


</script>
@stop

@section('after_scripts')
<script type="text/javascript" src="{{ asset('packages/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/datatables.net-fixedheader-bs4/js/fixedHeader.bootstrap4.min.js') }}"></script>

@endsection
