<div class="vertical-menu" style="background-color: black; color: white; height: 100vh;">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">
        <div class="navbar-brand">
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo">
                        <img src="/B/assets/images/mekanika.png" alt="" height="30">
                    </span>
                </a>
            </div>
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('model') }}" style="color: white;">
                        <i data-feather="home" style="color: white;"></i>
                        <span data-key="t-dashboard" style="color: white;">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-apps">Apps</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" style="color: white;">
                        <i data-feather="archive" style="color: white;"></i>
                        <span data-key="t-ecommerce" style="color: white;">Master Data</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('model') }}" data-key="t-orders" style="color: white;">Models</a></li>
                        <li><a href="{{ route('part') }}" data-key="t-orders" style="color: white;">Parts</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .vertical-menu {
    position: fixed; 
    top: 0; 
    bottom: 0; 
    width: 250px; 
    background-color: black;
    color: white;
    }

    #page-topbar {
        width: 80%; 
        position: absolute; 
        right: 0;
        padding: 5px; 
        background-color: white;
    }
    .navbar-brand {
        padding-left: 30px;
    }
</style>