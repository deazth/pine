@extends('master')

@section('content')
<div class="card">
    <div class="card-header">My Skills</div>
    <div class="card-body">


      <div class="row mb-0">
                <div class="col-6">
                              <div class="hidden-print with-border">

                    <a href="{{route('userskill.create')}}" class="btn btn-success" >

                      <i class="fa fa-plus"></i> Add Skills</a>

                  </div>
            </div>

            </div>





      <table id="taskdetailtable" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">SKill</th>
            <th scope="col">Category</th>
            <th class="sorting_disabled" data-orderable="false">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($userSkills as $us)
          <tr>
            <td>{{ $us->user->name }}</td>
            <td>{{ $us->skill->name }}</td>
            <td>{{ $us->skill->SkillCat->name }}</td>
            <td>	<a href="#" class="btn btn-danger btn-sm"
						onClick="submitDeleteForm('{{$us->id}}','{{$us->skill->name }}')"
						>Delete </a> </td>



          </tr>
          @endforeach
        </tbody>
      </table>

      <form method="POST" action="{{route('userskill.destroy',[],false) }}"
      	id="formDeleteID">
      	@csrf <input name="usid" id="delete_usid" type="hidden" />




      </form>


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



<script type="text/javascript" defer>
$(document).ready(function() {
    $('#taskdetailtable').DataTable();
} );

function submitDeleteForm(usid, skill_name){
	var txt;
	var r = confirm("Are you sure ? "+skill_name+" would be deleted");
	if (r == true) {
		$('#delete_usid').val(usid);
		$('#formDeleteID').submit();
	} else {
	  txt = skill_name+ " Not deleted!";
	}
  };


</script>
@endsection
