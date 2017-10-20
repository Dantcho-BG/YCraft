@section('side_nav_bar')

    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                @if(Auth::user()->admin == 1)
                    @if(Request::is('dashboard/*') || Request::is('dashboard'))
                    <li class="header">DASHBOARD NAVIGATION</li>
                        <li @if(Request::is('dashboard')) class="active" @endif >
                            <a href="/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="@if(Request::is('dashboard/pages/*') || Request::is('dashboard/pages')) active menu-open @endif treeview">
                            <a href="#">
                                <i class="fa fa-pencil"></i> <span>CMS</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li @if(Request::is('dashboard/pages')) class='active' @endif><a href="/dashboard/pages"><i class="fa fa-file"></i> Pages</a></li>
                                <li @if(Request::is('dashboard/pages/create')) class='active' @endif><a href="/dashboard/pages/create"><i class="fa fa-file"></i> Add New Page</a></li>
                            </ul>
                        </li>
                    @endif
                @endif
                    @if(!Request::is('dashboard/*') && !Request::is('dashboard'))
                    <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <a href="/home">
                                <i class="fa fa-home"></i> <span>Home Page</span>
                            </a>
                        </li>
                        <li>
                            <a href="/store">
                                <i class="fa fa-shopping-cart"></i> <span>Store Page</span>
                            </a>
                        </li>
                        <li class="header">USER NAVIGATION</li>
                        <li @if(Request::is('profile')) class='active' @endif>
                            <a href="/profile"><i class="fa fa-gear">
                                </i> <span>Profile</span>
                            </a>
                        </li>
                    @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

@endsection
