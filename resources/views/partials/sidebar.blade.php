<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-american-sign-language-interpreting"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Chisankho</div>
    </a>

    @php // Current route
    $currentRoute = \Request::route()->getName(); @endphp
    <!-- Nav Item - Dashboard -->
   
    {{-- <li class="nav-item @if(substr_count($currentRoute, 'welcome')) active @endif">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(substr_count($currentRoute, 'welcome')) active @endif">
        <a class="nav-link @if(substr_count($currentRoute, 'welcome')) text-warning @endif" href="{{ url('/') }}">
        <i class="fas fa-fw fa-map-marker"></i>
        <span>Map</span>
        </a>
        
    </li>
    <li class="nav-item @if(substr_count($currentRoute, 'posts')) active @endif">
            <a class="nav-link @if(substr_count($currentRoute, 'posts')) text-warning @endif" href="{{ route('posts.data') }}"">
            <i class="fas fa-fw fa-database"></i>
            <span>Data</span>
            </a>
            
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Reports
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link less-padding @if(substr_count($currentRoute, 'reports.incident.by.district')) text-warning @endif" href="{{ route('reports.incident.by.district') }}"><span>Incidents by Districts</span></a>
        
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.incident.by.type')) text-warning @endif" href="{{ route('reports.incident.by.type') }}"><span>Total Incidents by Type</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.incident.victims')) text-warning @endif" href="{{ route('reports.incident.victims') }}"><span>Victims of Incidents</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.victims.by.gender')) text-warning @endif" href="{{ route('reports.victims.by.gender') }}"><span>Victims By Gender</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.perpetrators.of.incidents')) text-warning @endif" href="{{ route('reports.perpetrators.of.incidents') }}"><span>Perpetrators Of Incidents</span></a>
    </li>
    <!--li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.perpetrators.by.gender')) text-warning @endif" href="{{ route('reports.perpetrators.by.gender') }}"><span>Perpetrators By Gender</span></a>
    </li-->
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.impact.by.incidents')) text-warning @endif" href="{{ route('reports.impact.by.incidents') }}"><span>Impact of Incidents</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.incidents.over.days')) text-warning @endif" href="{{ route('reports.incidents.over.days') }}"><span>Incidents Over Days</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.incidents.location')) text-warning @endif" href="{{ route('reports.incidents.location') }}"><span>Location of Incidents</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link less-padding  @if(substr_count($currentRoute, 'reports.responses.taken')) text-warning @endif" href="{{ route('reports.responses.taken') }}"><span>Responses Taken</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->
    <style>
        .less-padding {
            padding:0.1rem 1rem !important;
        }
    </style>
