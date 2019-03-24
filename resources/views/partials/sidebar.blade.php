<!-- Sidebar  -->
<nav id="sidebar" class="active bg-dark d-none d-md-block">
   @php // Current route
    $currentRoute = \Request::route()->getName(); @endphp
    <ul class="list-unstyled components">
        <li class="@if(substr_count($currentRoute, 'welcome')) active @endif">
            <a href="{{ url('/map') }}">
                <i class="fa fa-map-marker"></i>
                Map
            </a>
        </li>
        <li class="@if(substr_count($currentRoute, 'posts')) active @endif">
        <a href="{{ route('/') }}">
                <i class="fa fa-briefcase"></i>
                Data
            </a>
            
        </li>
        <li class="@if(substr_count($currentRoute, 'reports')) active @endif">
            <a href="{{ route('reports') }}">
                <i class="fa fa-image"></i>
                Reports
            </a>
        </li>
        
    </ul>

    {{-- <ul class="list-unstyled">
        <li>
            <a href="#">
                <i class="fa fa-question"></i>
                FAQ
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-paper-plane"></i>
                Contact
            </a>
        </li>
    </ul> --}}
</nav>