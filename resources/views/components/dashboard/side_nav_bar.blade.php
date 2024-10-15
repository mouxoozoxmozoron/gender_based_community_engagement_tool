{{-- <div>
    <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
    <div class="side_nav_bar">
        <div class="profile_section">
            <center class="profile_image_holder">
                @if (session('user_id'))
                    <img src="{{ asset('storage/' . session('user_object')->photo) }}" class="profile_image"
                        alt="N/A" />

            </center>
            <span class="profile_details">
                <p></p>

                <p>{{ session('user_object')->email }}</p>
                @endif

            </span>
        </div>

        <div class="custom_divider"></div>
        <section>
            <ul>
                <li>
                    <a href="{{ route('group_details', ['id' => $groupdata->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('group_details.events', ['id' => $groupdata->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar4-event" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v1h14V3a1 1 0 0 0-1-1zm13 3H1v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                            <path d="M11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                          </svg>
                        Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('group_details.posts', ['id' => $groupdata->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard-heart-fill" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm6 2.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0m3.5.878c1.482-1.42 4.795 1.392 0 4.622-4.795-3.23-1.482-6.043 0-4.622M2 5.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
                          </svg>
                        Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('group_details.members', ['id' => $groupdata->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                          </svg>
                        Members
                    </a>
                </li>
                <div class="custom_divider"></div>
                @if (session('user_id'))
                    <li>
                        <a href="{{ route('exit')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                                <path d="M7.5 1v7h1V1z"/>
                                <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
                              </svg>
                            Exit
                        </a>
                    </li>
                @endif
            </ul>
        </section>
    </div>
</div> --}}





<div class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/">GBCE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->


        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <div class="profile_section">
                            <center class="profile_image_holder">
                                @if (session('user_id'))
                                    <img src="{{ asset('storage/' . session('user_object')->photo) }}"
                                        class="profile_image" alt="N/A" />

                            </center>
                            <span class="profile_details">
                                <p></p>

                                <p>{{ session('user_object')->email }}</p>
                                @endif

                            </span>
                        </div>

                        {{-- if auth user is not a system admin --}}
                        @if (Auth()->user()->user_type == 2)
                        <div class="sb-sidenav-menu-heading">

                            @if (session('user_groupname'))
                                <span>
                                    {{ session('user_groupname')->name }}
                                </span>
                            @endif

                        </div>
                        <a class="nav-link" href="{{ route('group_details', ['id' => $groupdata->id]) }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#mygrouplist">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Other Group
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>



                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            This Group
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('group_details.events', ['id' => $groupdata->id]) }}">Events</a>
                                <a class="nav-link" href="{{ route('group_details.posts', ['id' => $groupdata->id]) }}">Posts</a>
                                <a class="nav-link" href="{{ route('group_details.members', ['id' => $groupdata->id]) }}">Members</a>
                            </nav>
                        </div>


{{-- incase loged in user is a system admin --}}
                @elseif (Auth()->user()->user_type == 1)
                <div class="sb-sidenav-menu-heading">

                    @if (session('user_groupname'))
                        <span>
                           GBCE COMMUNITY
                        </span>
                    @endif

                </div>
                <a class="nav-link" href="{{ ROUTE('system_admindashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#mygrouplist">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Other Group
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>



                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('allorganisation')}}">Organisation</a>
                        <a class="nav-link" href="#">Organisation Admins</a>
                        <a class="nav-link" href="{{route('allgroupmanagers')}}">Group Managers</a>
                        <a class="nav-link" href="{{route('allgroupmembers')}}">Mmebers</a>
                    </nav>
                </div>
{{-- end checking for stsem admin --}}



{{-- incase loged in user is a organisation admin --}}
                @elseif (Auth()->user()->user_type == 4)
                <div class="sb-sidenav-menu-heading">

                    {{-- @if (session('user_groupname')) --}}
                        <span>
                           GBCE COMMUNITY
                        </span>
                    {{-- @endif --}}

                </div>
                <a class="nav-link" href="{{ Route('organisation.organisation_admindashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#mygrouplist">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Other Group
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>



                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('organisation.orgadmin_allorganisation')}}">Organisation</a>
                        <a class="nav-link" href="{{route('organisation.report')}}">Report</a>
                        <a class="nav-link" href="#">Group Managers</a>
                        <a class="nav-link" href="#">Mmebers</a>
                    </nav>
                </div>
                        @endif
{{-- end checking for organisation admin --}}



                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapseError" aria-expanded="false"
                                    aria-controls="pagesCollapseError">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    Groups
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="#!">
                                            Active
                                        </a>
                                        <a class="nav-link" href="#!">

                                        </a>
                                        <a class="nav-link" href="#!">
                                            Innactive
                                        </a>
                                    </nav>
                                </div>





                        {{-- <div class="sb-sidenav-menu-heading">Addons</div> --}}

                        {{-- <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a> --}}
                        <a class="nav-link" href="{{ route('exit') }}">
                            <div class="sb-nav-link-icon">
                                <i class="fas fa-power-off" style="color: red;">
                                </i></i>
                            </div>
                            Exit
                        </a>
                    </div>
                </div>
                @if (session('user_id'))
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ session('user_object')->first_name }}
                        {{ '' }}
                        {{ session('user_object')->last_name }}
                        <i class="fas fa-power-off" style="color: green;"></i>
                    </div>
                @endif
            </nav>
        </div>
