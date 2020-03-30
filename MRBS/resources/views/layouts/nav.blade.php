    <div class="wrapper">
        <div class="sidebar" data-color="azure" data-image="{{ asset('assets/img/sidebar-4.jpg')}}">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        Meeting Room Booking System
                    </a>
                </div>
                @if(Auth::user()->role != 1)
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="fas fa-chalkboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{route('booking')}}">
                            <i class="far fa-calendar-alt"></i>
                            <p>Room Booking</p>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mngbooking')}}">
                            <i class="fas fa-calendar-day"></i>
                            <p>Manage Booking</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rooms')}}">
                            <i class="fas fa-door-open"></i>
                            <p>Room Maintenance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('usermain')}}">
                            <i class="fas fa-users"></i>
                            <p>User Maintenance</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target=".change_pass">
                            <i class="fab fa-keycdn"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                </ul>
                @else
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="fas fa-chalkboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('booking')}}">
                            <i class="far fa-calendar-alt"></i>
                            <p>Room Booking</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target=".change_pass">
                            <i class="fab fa-keycdn"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"> {{isset($title) ? $title : 'MRBS'}}</a>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="no-icon">{{ Auth::user()->name }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                @yield('content')
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="#">IT System Developer</a>
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>
