
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{asset('Admin/img/logo/logo-2.ico')}}">
        </div>
        <div class="sidebar-brand-text mx-3">NKD</div>
    </a>
    <li class="nav-item">
        <a class="nav-link" href="{{url('home')}}">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Submissions</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('rewards_statistic')}}">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Product Statistic</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('users')}}">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Users</span>
        </a>
    </li>
</ul>