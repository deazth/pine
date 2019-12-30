@extends('master')

@section('content')
@if(session()->has('feedback'))
<div class="alert alert-{{session()->get('feedback_type')}} alert-dismissible" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{session()->get('feedback_text')}}
</div>
@endif
<div class="card">
    <div class="card-header">Add a Skill</div>
        <div class="card-body">
            <div class="container">
<form action="{{route('userskill.store')}}" method="POST">
   @csrf
                <div class="row">



                    <div class="col-lg-10">
                        <div class="container">
                            <div class="row">
                                <!--  -->

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
                                <button class="btn btn-primary ">Return</button>
                                <input type="submit" class="btn btn-success" ></input>

                            </div>


                        </div>
                    </div>
                </div>
              </form>

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
