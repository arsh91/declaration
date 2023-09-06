<!DOCTYPE html>
<html lang="en">

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between headerCont">
            <a href="{{ url('/dashboard') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Document</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->
    
        <nav class="header-nav ms-auto headerCont">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <!-- <li class="nav-item dropdown"> -->

                <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span> -->
                <!-- /  </a>End Notification Icon -->

                <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            You have 4 new notifications
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Test</h4>
                                <p>Test here</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Test</h4>
                                <p>Test here</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li> -->

                <!-- / </ul>End Notification Dropdown Items -->

                <!-- </li>End Notification Nav -->

                <!-- <li class="nav-item dropdown">-->

                <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a>End Messages Icon -->

                <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="" alt="" class="rounded-circle">
                                <div>
                                    <h4>Test</h4>
                                    <p>Test here...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="" alt="" class="rounded-circle">
                                <div>
                                    <h4>Test</h4>
                                    <p>Test here...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul>End Messages Dropdown Items -->

                <!-- </li>End Messages Nav -->
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <!-- <img src="{{asset('assets/img/').'/'.auth()->user()->profile_picture}}" id="profile_picture"
                        alt="Profile" height="50px" width="50px" class="rounded-circle picture"> -->
                </a>
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                        <span
                            class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name ?? " " }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- <img src="{{asset('assets/img/').'/'.auth()->user()->profile_picture}}"
                                        id="profile_picture" alt="Profile" height="50px" width="50px"
                                        class="rounded-circle picture"> -->
                                </div>
                                <div class="col-md-5">
                                    <h6>{{ auth()->user()->name ?? " " }}</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                        <!-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <hr class="dropdown-divider"> -->

                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout')}}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log Out</span>
                        </a>
                </li>

            </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }}" href="{{ url('/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->
            @if(auth()->user()->role == 1 || auth()->user()->role == 5)
             <li class="nav-item">
                <a class="nav-link {{ request()->is('declarationupload') ? '' : 'collapsed' }}" href="{{ url('/declaration/upload') }}">
                    <i class="bi-shop"></i>
                    <span>Document Upload</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role != 5)
             <li class="nav-item">
                <a class="nav-link {{ request()->is('/declaration/list') ? '' : 'collapsed' }}" href="{{ url('/declaration/list') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                    <span>Document Upload List
                    </span>
                </a>
            </li>
            @endif
            @if(auth()->user()->role ==1 || auth()->user()->role == 2)
            <li class="nav-item">
                <a class="nav-link {{ request()->is('users') ? '' : 'collapsed' }}" href="{{ url('/users') }}">
                    <i class="bi bi-person-square"></i>
                    <span>Users
                    </span>
                </a>
            </li>
            @endif
        </ul>
    </aside><!-- End Sidebar-->
</body>
</html>