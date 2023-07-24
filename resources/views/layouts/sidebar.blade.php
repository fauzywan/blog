       <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BLOG</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item  {{Request::segment(1)=='dashboard'?'active':''}}">
        <a class="nav-link" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::segment(2)=='post'?'active':''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Posts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/post">Post</a>
                <a class="collapse-item" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/post/draff">Draff</a>
                <a class="collapse-item" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/post/confirm">Confirm</a>
            </div>
        </div>
    </li>

    @if (auth()->user()->role_id!=3)
        
    <li class="nav-item  {{Request::segment(2)=='categories'?'active':''}}">
        <a class="nav-link" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/categories">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Categories</span>
        </a>

    </li>
    <li class="nav-item {{Request::segment(2)=='account'?'active':''}}">
        <a class="nav-link" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/account">
            <i class="fas fa-fw fa-users"></i>
            <span>Account</span>
        </a>

    </li>
    @endif
    <li class="nav-item {{Request::segment(2)=='comment'?'active':''}}">
        <a class="nav-link" href="/{{auth()->user()->role_id!=3?'admin':'creator'}}/comment">
            <i class="fas fa-fw fa-comment"></i>
            <span>Comment</span>
        </a>

   
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="/logout">
            <i class="fas fa-fw sign-out"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->

</ul>
<!-- End of Sidebar -->