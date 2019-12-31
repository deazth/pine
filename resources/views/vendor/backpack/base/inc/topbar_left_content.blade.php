<!-- This file is used to store topbar (left) items -->

{{-- <li class="nav-item px-3"><a class="nav-link" href="#">Dashboard</a></li>
<li class="nav-item px-3"><a class="nav-link" href="#">Users</a></li>
<li class="nav-item px-3"><a class="nav-link" href="#">Settings</a></li> --}}

@if(session()->get('noti_count') > 0)
<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"  data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i>
  <span class="badge badge-pill badge-danger">{{ session()->get('noti_count') }}</span></a>
  <div class="dropdown-menu">
      @foreach(session()->get('noti_list') as $ous)
      <a class="dropdown-item" href="{{ $ous['url'] }}"><i class="{{$ous['class']}}"></i> {{$ous['text']}}</a>
      @endforeach
    </div>
</li>
@else
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="fa fa-bell"></i></a></li>
@endif
