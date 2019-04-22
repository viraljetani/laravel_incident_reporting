<!-- Topbar -->
<nav class="navbar navbar-expand navbar-dark bg-gray-900 topbar static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <span class="navbar-text d-md-block d-none text-light">
            “A conflict Early Warning and Response System for the 2019 General Elections in
            Malawi.”
    </span>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
        @guest
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ trans('titles.login') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ trans('titles.register') }}</a></li>
        @else
        @role('admin')
        <li class="nav-item">
             <a href="{{route('posts.create')}}" class="nav-link"> Import Excel Data </a> 
        </li>
        @endrole
        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form></li>
        @endguest

    </ul>

    </nav>
    <!-- End of Topbar -->