<div class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/">GBCE</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
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
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
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

                        <!-- Common Links for All Users -->
                        <div class="sb-sidenav-menu-heading">Common Links</div>
                        {{-- <a class="nav-link" href="{{ route('profile') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-user" style="color: blue;"></i></div>
                            Profile
                        </a> --}}

                        {{-- Admin Users --}}
                        @if (Auth()->user()->user_type == 1)
                            <div class="sb-sidenav-menu-heading">Admin Links</div>
                            <a class="nav-link" href="{{ ROUTE('system_admindashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="{{ route('profile') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user" style="color: blue;"></i></div>
                                Profile
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayoutsAdmin" aria-expanded="false"
                                aria-controls="collapseLayoutsAdmin">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsAdmin" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('allorganisation') }}">Organisation</a>
                                    <a class="nav-link" href="#">Organisation Admins</a>
                                    <a class="nav-link" href="{{ route('allgroupmanagers') }}">Group Managers</a>
                                    <a class="nav-link" href="{{ route('allgroupmembers') }}">Members</a>
                                </nav>
                            </div>
                        @endif

                        {{-- Group Admin Users --}}
                        @if (Auth()->user()->user_type == 2)
                            <div class="sb-sidenav-menu-heading">Group Admin Links</div>
                            <a class="nav-link" href="{{ route('group_details', ['id' => $groupdata->id ?? 0]) }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayoutsGroupAdmin" aria-expanded="false"
                                aria-controls="collapseLayoutsGroupAdmin">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                This Group
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsGroupAdmin" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link"
                                        href="{{ route('group_details.events', ['id' => $groupdata->id]) }}">Events</a>
                                    <a class="nav-link"
                                        href="{{ route('group_details.posts', ['id' => $groupdata->id]) }}">Posts</a>
                                    <a class="nav-link"
                                        href="{{ route('group_details.members', ['id' => $groupdata->id ?? 0]) }}">Members</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="#!" data-bs-toggle="modal" data-bs-target="#mygrouplist">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Other Group
                            </a>
                        @endif

                        {{-- Organisation Admin Users --}}
                        @if (Auth()->user()->user_type == 4)
                            <div class="sb-sidenav-menu-heading">Organisation Admin Links</div>
                            <a class="nav-link" href="{{ Route('organisation.organisation_admindashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="{{ route('profile') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user" style="color: blue;"></i></div>
                                Profile
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseLayoutsOrgAdmin" aria-expanded="false"
                                aria-controls="collapseLayoutsOrgAdmin">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsOrgAdmin" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link"
                                        href="{{ route('organisation.orgadmin_allorganisation') }}">Organisation</a>
                                    <a class="nav-link" href="{{ route('organisation.report') }}">Report</a>
                                    <a class="nav-link" href="#">Group Managers</a>
                                    <a class="nav-link" href="#">Members</a>
                                </nav>
                            </div>
                        @endif



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
                                <a class="nav-link" href="#!">Active</a>
                                <a class="nav-link" href="#!">Inactive</a>
                            </nav>
                        </div>

                        <a class="nav-link" href="{{ route('exit') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-power-off" style="color: red;"></i></div>
                            Exit
                        </a>
                    </div>
                </div>



                @if (session('user_id'))
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ session('user_object')->first_name }} {{ session('user_object')->last_name }}
                        <i class="fas fa-power-off" style="color: green;"></i>
                    </div>
                @endif
            </nav>
        </div>
        {{-- </div>
</div> --}}
