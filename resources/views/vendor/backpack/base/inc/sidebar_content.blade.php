<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-briefcase"></i> admin thingy</a>
  <ul class="nav-dropdown-items">
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('skillcat') }}'><i class='nav-icon fa fa-briefcase  '></i> Skill Category</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('skill') }}'><i class='nav-icon fa fa-book'></i> Skills</a></li>
  </ul>
</li>

<li class="nav-title">Tajuk lagi</li>
<li class="nav-item nav-dropdown"><a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-briefcase"></i> Samples</a>
  <ul class="nav-dropdown-items">
    <li class="nav-item"><a class="nav-link" href="{{ route('index')}}"><i class="nav-icon fa fa-briefcase"></i> kosong</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('wijjet')}}"><i class="nav-icon fa fa-briefcase"></i> widget</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('home')}}"><i class="nav-icon fa fa-briefcase"></i> kelendar</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('geraf')}}"><i class="nav-icon fa fa-briefcase"></i> graf</a></li>
  </ul>
</li>
