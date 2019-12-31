<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-title">My Personal Space</li>
<li class="nav-item"><a class="nav-link" href="{{ route('user.profile') }}"><i class="fa fa-home nav-icon"></i> {{ backpack_user()->staff_no }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('userskill.index') }}"><i class="fa fa-book nav-icon"></i> My Skills</a></li>
<li class="nav-title">Task</li>
<li class="nav-item"><a class="nav-link" href="{{ route('task.newrequest') }}"><i class="fa fa-edit nav-icon"></i>Request New Task</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('task.showlist') }}"><i class="fa fa-list nav-icon"></i>Requested Task</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('task.showpending') }}"><i class="fa fa-hotel nav-icon"></i>Pending Task</a></li>
<li class="nav-item"><a class="nav-link" href="{{ route('task.showopen') }}"><i class="fa fa-wheelchair nav-icon"></i>Task Advertisement</a></li>
<li class="nav-title">Misc</li>
<li class="nav-item"><a class="nav-link" href="{{ route('userskill.find') }}"><i class="fa fa-search nav-icon"></i>Find Person With Skill</a></li>
<li class="nav-title">Admin</li>
<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-cog"></i> Admin thingy</a>
  <ul class="nav-dropdown-items">
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('skillcat') }}'><i class='nav-icon fa fa-briefcase  '></i> Skill Category</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('skill') }}'><i class='nav-icon fa fa-book'></i> Skills</a></li>
  </ul>
</li>
<!---
<li class="nav-title">Contoh</li>

<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-scissors"></i> Samples</a>
  <ul class="nav-dropdown-items">
    <li class="nav-item"><a class="nav-link" href="{{ route('index')}}"><i class="nav-icon fa fa-briefcase"></i> kosong</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('wijjet')}}"><i class="nav-icon fa fa-briefcase"></i> widget</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('home')}}"><i class="nav-icon fa fa-briefcase"></i> kelendar</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('geraf')}}"><i class="nav-icon fa fa-briefcase"></i> graf</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('datable')}}"><i class="nav-icon fa fa-briefcase"></i> Data Table</a></li>
  </ul>
</li>
--->
