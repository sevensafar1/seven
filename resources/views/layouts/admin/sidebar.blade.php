 <!-- Sidebar Start -->

 <div class="sidebar pe-4 pb-3">

            <nav class="navbar bg-light navbar-light">

                <a href="index.html" class="navbar-brand mx-4 mb-3">

                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>

                </a>

                @php $user=auth()->user(); @endphp

                <div class="d-flex align-items-center ms-4 mb-4">

                    <div class="position-relative">

                    <img class="rounded-circle" src="{{asset('public/admin/img/user.jpg')}}" alt="" style="width: 40px; height: 40px;">

                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>

                    </div>

                    <div class="ms-3">

                        <h6 class="mb-0">{{$user->name}}</h6>

                        <span>{{ $user->user_type == 1 ? 'Subadmin' : 'Admin' }}</span>

                    </div>

                </div>

                <div class="navbar-nav w-100">

                    @if($user->user_type == 1)

                    <a href="{{route('enquiry/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Enquiry List</a>

                    <a href="{{route('contact/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Contact List</a>

                    @elseif($user->user_type == 2)
                    <a href="{{route('blog/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Blog  </a>
                    @else

                    <a href="{{route('package/type')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Package Type</a>

                    <a href="{{route('package/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Package</a>

                    <a href="{{route('hotel/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Hotels</a>

                    <a href="{{route('resort/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Resort</a>

                    <a href="{{route('enquiry/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Enquiry List</a>

                    <a href="{{route('contact/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Contact List</a>

                    <a href="{{route('gallery/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Gallery  </a>

                    <a href="{{route('blog/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Blog  </a>
                    <a href="{{route('banner/list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Banner  </a>
                    <a href="{{route('city.list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>City</a>
                    <a href="{{route('user.list')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Users</a>

                    @endif

                    

                </div>

            </nav>

        </div>

        <!-- Sidebar End -->