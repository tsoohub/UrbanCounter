<header>
    <div class="header">
        <div class="menu-image-wrapper">
            <img src="{{asset('data/bg/RayLight.png')}}" alt="img" class="bg-img2"/>
        </div>
        <div class="container">
            <div class="top clearfix">
                <span>
                    <a href="mailto:Urbancountertops@gmail.com">Urbancountertops@gmail.com</a> - <a
                            href="tel:773-893-5259">773-893-5259</a>
                </span>
            </div>
            <div class="mid">
                <menu data-order="1">
                    @if(isset($mainMenu) && property_exists($mainMenu, 'menuItems'))
                        @php $count = 0; @endphp
                        @foreach ($mainMenu->menuItems as $menu)
                            @php $count = $count + 1; @endphp
                            @if (array_key_exists('parentID', $menu) && $menu['parentID'] == NULL)
                                @if ($count == 1)
                                    <li><a href="{{$menu['url']}}"><i class="fa fa-home"></i>&nbsp;{{ $menu['title'] }}</a></li>
                                @else
                                    @if ($count == 2)
<!--                                        <li><a href="{{$menu['url']}}" class="hasSub">{{$menu['title']}}</a>-->
                                        <li><a href="{{$menu['url']}}" >{{$menu['title']}}</a>
                                        <!--ul class="sub-menu">
                                        @foreach ($mainMenu->menuItems as $submenu)
                                            @if ($menu['id'] == $submenu['parentID'])
                                                <li><a href="{{$submenu['url']}}">{{$submenu['title']}}</a></li>
                                            @endif
                                        @endforeach
                                        </ul>-->
                                    @else
                                        <li><a href="{{$menu['url']}}">{{$menu['title']}}</a>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @else
                        <div style='color: white'>No menus</div>
                    @endif
                </menu>
            </div>
        </div>
        <div class="top-banner">
            <ul>
                <li>
                    <a href="/">
                        <img src="{{asset('data/logo.png')}}" alt="Logo">
                    </a>
                </li>
            </ul>
        </div>
        <div class="top-bg">
            <img src="{{asset('data/Stripes.png')}}"/>
        </div>
        <div class="top-bg-small" style="pointer-events: none;">
            <img src="{{asset('data/stripe.png')}}" alt="stripes">
        </div>
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="{{asset('data/logo.png')}}" alt="Urbancounters">
                    </a>
                </div>
                <div id="navbar3" class="navbar-collapse collapse" style="height: 1px;">
                    <ul class="nav navbar-nav navbar-right">

                    @php $count = 0; @endphp
                    @if(isset($mainMenu) && property_exists($mainMenu, 'menuItems'))
                        @foreach ($mainMenu->menuItems as $menu)
                            @php $count = $count + 1; @endphp
                            @if (array_key_exists('parentID', $menu) && $menu['parentID'] == NULL)
                                @if ($count == 1)
                                    <li class="active"><a href="{{$menu['url']}}"><i class="fa fa-home"></i>&nbsp;{{ $menu['title'] }}</a></li>
                                @else
                                    <li><a href="{{$menu['url']}}">{{ $menu['title'] }}</a>
                                @endif
                            @endif
                        @endforeach
                    @else
                        <div style='color: white'>No menus</div>
                    @endif
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </nav>
    </div>
</header>

