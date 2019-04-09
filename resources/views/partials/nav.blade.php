<!-- Topbar -->
<nav class="navbar navbar-expand navbar-dark bg-gray-900 topbar static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <span class="navbar-text d-md-block d-none text-light">
            “An early warning and early response system for the 2019 General elections in Malawi.”
    </span>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <li><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
        @guest
        <li><a class="nav-link" href="{{ route('login') }}">{{ trans('titles.login') }}</a></li>
        <li><a class="nav-link" href="{{ route('register') }}">{{ trans('titles.register') }}</a></li>
        @else
        <li class="nav-item">
            @role('admin') <a href="{{route('posts.create')}}" class="nav-link"> Import Excel Data </a> @endrole
        </li>
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