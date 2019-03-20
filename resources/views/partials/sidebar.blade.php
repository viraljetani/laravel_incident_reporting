<!-- Sidebar  -->
<nav id="sidebar" class="active bg-dark">
   @php // Current route
    $currentRoute = \Request::route()->getName(); @endphp
    <ul class="list-unstyled components position-fixed">
        <li class="@if(substr_count($currentRoute, 'welcome')) active @endif">
            <a href="{{ url('/') }}">
                <i class="fa fa-map-marker"></i>
                Map
            </a>
        </li>
        <li class="@if(substr_count($currentRoute, 'posts')) active @endif">
        <a href="{{ route('posts') }}">
                <i class="fa fa-briefcase"></i>
                Data
            </a>
            
        </li>
        <li>
            <a href="#">
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