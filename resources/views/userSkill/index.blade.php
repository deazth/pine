@extends('master')

@section('content')
<div class="card">
    <div class="card-header">Meja Maklumat</div>
    <div class="card-body">


      <div class="row mb-0">
                <div class="col-6">
                              <div class="hidden-print with-border">

                    <a href="{{route('userskill.create')}}" class="btn btn-success" >

                      <i class="fa fa-plus"></i> Add Skills</a>

                  </div>
                            </div>
                <div class="col-6">
                    <div id="datatable_search_stack" class="float-right"><div id="crudTable_filter" class="dataTables_filter"><label><span class="d-none d-sm-inline">Search: </span><input type="search" class="form-control" placeholder="" aria-controls="crudTable"></label></div></div>
                </div>
              </div>





      <table id="taskdetailtable" class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Staff No</th>
          </tr>
        </thead>
        <tbody>
          @foreach($userSkills as $us)
          <tr>
            <td>{{ $us->user_id }}</td>
            <td>{{ $us->skill_id }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
</script>
@endsection
