<header class="{{ config('backpack.base.header_class') }}">
  <!-- Logo -->
  <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!-- <a class="navbar-brand" href="{{ url(config('backpack.base.home_link')) }}"> -->
  <a class="navbar-brand" href="{{ route('backpack.dashboard') }}" style="opacity: 1; color: #28A745">
  
    <img class="mr-1" src="{{asset('assets/logo-2.png')}}" height="35">
    {!! config('backpack.base.project_logo') !!}
  </a>
  <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
    <span class="navbar-toggler-icon"></span>
  </button>

  @include(backpack_view('inc.menu'))
</header>
