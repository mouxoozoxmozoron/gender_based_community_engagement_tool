    <!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    {{-- <nav class="navbar navbar-expand-lg navbar-light navigationheader ">
        <div class="container-fluid navbar_header">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('gbce_logo.png') }}" width="50" height="50" class="d-inline-block align-top"
                    alt="">
                gbce
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                @if (!@session('user_id'))


                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (!session('user_id'))
                                    <li> --}}
    {{-- <a class="dropdown-item" href="login">Login</a> --}}
    {{-- <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#loginmodel" data-bs-whatever="@mdo">Login
                                        </button>
                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#registrationmodel" data-bs-whatever="@mdo">register
                                        </button>

                                    </li>
                                @endif
                                @if (session('user_id'))
                                    <li><a class="dropdown-item" href="dashboard">Company</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                @if (session('user_id'))
                                    <li><a class="dropdown-item" href="{{route('exit')}}">Logout</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    @else
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="activeuserbadge"><p>Active</p></li>
                    </ul>
                @endif --}}



    {{-- profile part --}}
    {{-- @if (@session('user_id'))
                    <ul class="navbar-nav" id="header_profile_part">
                        <!-- Avatar -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/' . session('user_object')->photo) }}"
                                    class="rounded-circle" height="40" width="40" alt="Avatar" loading="lazy" />
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">My profile</a>
                                </li>
                                 <!-- Trigger button for the modal -->

                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#mygrouplist">My group</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{route('exit')}}">Logout</a>                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif --}}
    {{-- profile part end --}}


    </div>
    {{-- </div>
    </nav> --}}





    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="/" class="logo">
                <img src="{{ asset('gbce_logo.png') }}" alt="" class="img-fluid">
                GBCE
            </a>
            <!-- Uncomment below if you prefer to use text as a logo -->
            <!-- <h1 class="logo"><a href="index.html">Butterfly</a></h1> -->

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#hero">About</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto " href="#achievement">Achievement</a></li>
                    <li class="dropdown"><a href="#"><span>Acount</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            {{-- <li><a href="#">Drop Down 1</a></li> --}}
                            {{-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                    class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li> --}}
                            @if (!session('user_id'))
                                <li>
                                    <a href="!#" data-bs-toggle="modal" data-bs-target="#loginmodel"
                                        data-bs-whatever="@mdo">Login
                                    </a>
                                </li>

                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#registrationmodel"
                                        data-bs-whatever="@mdo">
                                        Register
                                    </a>
                                </li>
                            @endif


                            @if (session('user_id'))
                                <li>
                                    <a href="#!" data-bs-toggle="modal" data-bs-target="#profileModal">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#mygrouplist">
                                        Groups
                                    </a>
                                </li>
                                <li><a href="{{ route('exit') }}">Exit</a></li>
                            @endif
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->




    <x-models.login_form />
    <x-models.registration_form />
    <x-models.profile_model />
    <x-models.group_list />
