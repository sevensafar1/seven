  <!-- Content Start -->

  <div class="content">

            <!-- Navbar Start -->

            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">

                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>

                </a>

                <a href="#" class="sidebar-toggler flex-shrink-0">

                    <i class="fa fa-bars"></i>

                </a>

                <form class="d-none d-md-flex ms-4">

                    <input class="form-control border-0" type="search" placeholder="Search">

                </form>

                <div class="navbar-nav align-items-center ms-auto">

                   

                    

                    @php $user=auth()->user(); @endphp

                    <div class="nav-item dropdown">

                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">

                        <img class="rounded-circle" src="{{asset('public/admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">

                            <span class="d-none d-lg-inline-flex">{{$user->name}}</span>

                        </a>

                       

                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <!-- <a href="#" class="dropdown-item">My Profile</a>

                            <a href="#" class="dropdown-item">Settings</a> -->

                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">

                                @csrf <!-- Include CSRF token for security -->

                                <button type="submit" class="dropdown-item" style="border: none; background: none; cursor: pointer;">Log Out</button>

                            </form>

                        </div>

                    </div>

                </div>

            </nav>

            <!-- Navbar End -->



















           

        