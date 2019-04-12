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
        Analytics
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item @if(substr_count($currentRoute, 'reports')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-chart-pie"></i>
        <span class="@if(substr_count($currentRoute, 'reports')) text-warning @endif">Reports</span>
        </a>
        <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Report Types:</h6>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.incident.by.district')) active @endif" href="{{ route('reports.incident.by.district') }}">Incidents by Districts</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.incident.by.type')) active @endif" href="{{ route('reports.incident.by.type') }}">Total Incidents by Type</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.incident.victims')) active @endif" href="{{ route('reports.incident.victims') }}">Victims of Incidents</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.victims.by.gender')) active @endif" href="{{ route('reports.victims.by.gender') }}">Victims By Gender</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.perpetrators.of.incidents')) active @endif" href="{{ route('reports.perpetrators.of.incidents') }}">Perpetrators Of Incidents</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.perpetrators.by.gender')) active @endif" href="{{ route('reports.perpetrators.by.gender') }}">Perpetrators By Gender</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.impact.by.incidents')) active @endif" href="{{ route('reports.impact.by.incidents') }}">Impact of Incidents</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.incidents.over.days')) active @endif" href="{{ route('reports.incidents.over.days') }}">Incidents Over Days</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.incidents.location')) active @endif" href="{{ route('reports.incidents.location') }}">Location of Incidents</a>
            <a class="collapse-item @if(substr_count($currentRoute, 'reports.responses.taken')) active @endif" href="{{ route('reports.responses.taken') }}">Responses Taken</a>
            
            {{-- <a class="collapse-item" href="{{ route('reports') }}">Charts</a> --}}
        </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->
