<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('asset/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('asset/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">


    <!-- Template Main CSS File -->
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">


    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> --}}


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Sogo Hotel</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">



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
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

        <!-- <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a> -->
                    <!-- End Messages Icon -->

                    <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          <!-- </ul> -->
                    <!-- End Messages Dropdown Items -->

                    <!-- </li> -->
                    <!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()->name }} </span>
                    </a>
                    <!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <!-- End Profile Dropdown Items -->
                </li>

                <!-- End Profile Nav -->
            </ul>
        </nav>
        <!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- End Dashboard Nav -->

            <hr>


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('roles.index') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Roles</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('users.index') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('permissions.index') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Permissions</span>
                </a>
            </li>

            <hr>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav1" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Rooms</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('rooms.create') }}">
                            <i class="bi bi-circle"></i><span>Create Room</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rooms.index') }}">
                            <i class="bi bi-circle"></i><span>The Rooms</span>
                        </a>
                    </li>
                    <li>
                        <a href="/availablerooms">
                            <i class="bi bi-circle"></i><span>Available Room</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav8" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Reservation</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav8" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('reservations.create') }}">
                            <i class="bi bi-circle"></i><span>Create Reservation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reservations.index') }}">
                            <i class="bi bi-circle"></i><span>The Reservations </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav2" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Home</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('image-create')
                        <li>
                            <a href="{{ route('house.create') }}">
                                <i class="bi bi-circle"></i><span>Create Home</span>
                            </a>
                        </li>
                    @endcan

                    @can('image-list')
                        <li>
                            <a href="{{ route('house.index') }}">
                                <i class="bi bi-circle"></i><span>The House</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav3" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Gallery</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav3" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('image-list')
                        <li>
                            <a href="{{ route('Gallery.index') }}">
                                <i class="bi bi-circle"></i><span>The Gallery</span>
                            </a>
                        </li>
                    @endcan

                    @can('image-create')
                        <li>
                            <a href="{{ route('Gallery.create') }}">
                                <i class="bi bi-circle"></i><span>Add New Image</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav4" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>People Says</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav4" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('product-create')
                        <li>
                            <a href="{{ route('feed.create') }}">
                                <i class="bi bi-circle"></i><span>Create Feed</span>
                            </a>
                        </li>
                    @endcan

                    @can('product-list')
                        <li>
                            <a href="{{ route('feed.index') }}">
                                <i class="bi bi-circle"></i><span>The Feeds</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav5" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Event</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav5" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('image-create')
                        <li>
                            <a href="{{ route('event.create') }}">
                                <i class="bi bi-circle"></i><span>Create Event</span>
                            </a>
                        </li>
                    @endcan

                    @can('image-list')
                        <li>
                            <a href="{{ route('event.index') }}">
                                <i class="bi bi-circle"></i><span>The Events</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav6" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>LeaderShips</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav6" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('product-create')
                        <li>
                            <a href="{{ route('leadership.create') }}">
                                <i class="bi bi-circle"></i><span>Create LeaderShip</span>
                            </a>
                        </li>
                    @endcan

                    @can('product-list')
                        <li>
                            <a href="{{ route('leadership.index') }}">
                                <i class="bi bi-circle"></i><span>LeaderShips</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav7" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>History</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav7" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @can('product-list')
                        <li>
                            <a href="{{ route('history.index') }}">
                                <i class="bi bi-circle"></i><span>The History</span>
                            </a>
                        </li>
                    @endcan

                    @can('product-create')
                        <li>
                            <a href="{{ route('history.create') }}">
                                <i class="bi bi-circle"></i><span>Create History</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Forms Nav -->


            <!-- End Forms Nav -->
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        @yield('main')
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('asset/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('asset/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('asset/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('asset/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('asset/js/main.js') }}"></script>

</body>

</html>
