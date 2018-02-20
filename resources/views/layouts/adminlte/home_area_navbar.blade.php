@section('nav_bar')

    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="@yield("website_url")" class="navbar-brand"><b>@yield("website_name_first_part")</b>@yield("website_name_second_part")</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                  <?php $loopRuns = 0 ?>
                  @while(true)
                    <li @if(Request::is($websitePagesList[$loopRuns]->page_slug)) class="active" @endif><a href="{{$websitePagesList[$loopRuns]->page_slug}}">{{$websitePagesList[$loopRuns]->page_name}} @if(Request::is($websitePagesList[$loopRuns]->page_slug)) <span class="sr-only">(current)</span> @endif</a></li>
                    <?php $loopRuns++ ?>
                    @if($loopRuns == $websitePagesAmount)
                      @break
                    @endif
                  @endwhile
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    @guest
                        <li class="user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="/login">
                                <!-- The user image in the navbar-->
                                <i class="fa fa-sign-in"></i>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">Login</span>
                            </a>
                        </li>
                        <li class="user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="/register">
                                <!-- The user image in the navbar-->
                                <i class="fa fa-user-plus"></i>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">Register</span>
                            </a>
                        </li>
                        @else
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="{{URL::asset('/uploads/avatars/'.Auth::user()->avatar)}}" class="user-image" alt="User Image">
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs">{{Auth::user()->name}}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header">
                                        <img src="{{URL::asset('/uploads/avatars/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">

                                        <p>
                                            {{ Auth::user()->first_name }} {{Auth::user()->last_name}}
                                            <small>{{ Auth::user()->email }}</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                        <div class="row">
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Followers</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Sales</a>
                                            </div>
                                            <div class="col-xs-4 text-center">
                                                <a href="#">Friends</a>
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @if(Auth::user()->admin == 1)
                            <li>
                                <a href="/dashboard"><i class="fa fa-tachometer"></i></a>
                            </li>
                            @endif
                            @endguest

                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>

@endsection
