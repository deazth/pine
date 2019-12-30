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
                <div class="row">
                    <div class="col-lg-10">
                        <div class="container">
                            <div class="row">
                                <!--  -->
                                <div class="col-lg-2">Reference No:</div>
                                <div class="col-lg-10">
                                    @if($task ?? '') 
                                        {{$task->reference_no}} 
                                    @elseif($draft ?? '') 
                                        {{$draft[0]}} 
                                    @endif
                                </div>
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
                                <div class="col-lg-2">Title:</div>
                                <div class="col-lg-10">
                                    <input class="form-control" type="text" name="inputname" 
                                    @if($task ?? '') 
                                        value="{{$task->refno}}" disabled
                                    @endif
                                    >
                                </div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Description:</div>
                                <div class="col-lg-10">
                                    <textarea class="form-control" type="text" name="inputdescription" 
                                    @if($task ?? '') 
                                        value="{{$task->refno}}" 
                                        @if($task->status!="Open")
                                            disabled
                                        @endif
                                    @endif
                                    rows="5"
                                    ></textarea>
                                </div>
                                <div class="mt-2 col-lg-12"></div>
                                <div class="col-lg-2">Skill Category:</div>
                                <div class="col-lg-6">
                                    <select class="form-control" id="inputskillcat" name="inputskillcat"
                                    @if($task ?? '') 
                                        @if($task->status!="Open")
                                            disabled
                                        @endif
                                    @endif    
                                    >
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
                                <div class="col-lg-6">
                                    <select class="form-control" id="inputskill" name="inputskill"
                                    @if($task ?? '') 
                                        @if($task->status!="Open")
                                            disabled
                                        @endif
                                    @elseif($draft ?? '') 
                                        disabled
                                    @endif    
                                    >
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
                    <button class="btn btn-primary">Advertise Task</button>
                    <button class="btn btn-primary">Create Task</button>
                    <button class="btn btn-primary">Assign Task</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
</script>
@stop
