 <!-- MOBILE MENU -->

 <style>
    .main-menu {
    float: left;
    width: 80%;
}
.contcct{
   
    /* margin-top: 18px;
    font-style: bold; */
    font-weight: bold;
    color: black;

}
 </style>

 <section>

        <div class="ed-mob-menu">

            <div class="ed-mob-menu-con">

                <div class="ed-mm-left">

                    <div class="wed-logo">

                        <a href="{{route('home')}}"><img src="{{asset('public/front/image/logo.png')}}" alt="" />

                        </a>

                    </div>

                </div>

                <div class="ed-mm-right">

                    <div class="ed-mm-menu">

                        <a href="#!" class="ed-micon"><i class="fa fa-bars"></i></a>

                        <div class="ed-mm-inn">

                            <a href="#!" class="ed-mi-close"><i class="fa fa-times"></i></a>

                            <ul>

                                <li><a href="{{route('home')}}">Home</a></li>

                                <li><a href="{{route('about')}}">About</a></li>

                            </ul>

                            @php



                             $package=package(); 

                             $copackage=corporatepackage();

                             @endphp 

                            <h4>Tour Packages</h4>

                            <ul>

                                @if($package)

                                    @foreach($package as $pack)

                                   

                                    <li><a href="{{route('package',$pack->slug)}}">{{$pack->package_name}}</a></li>

                                  

                                    @endforeach

                                @endif

                            </ul>

                            <ul>

                               

                                <li><a href="{{route('hotels')}}">Hotels</a></li>

                                <li><a href="{{route('resort')}}">Resorts</a></li>

                                <li><a href="{{route('contact')}}">Contact us</a></li>
                                <li class="contcct"><a href="tel:+9818054830">9818054830</a></li>
                                <li class="contcct"><a href="tel:+9818055980">9818055980</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!--HEADER SECTION-->

    <section>

        <div class="top-logo" data-spy="affix" data-offset-top="250">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="wed-logo">

                        <a href="{{route('home')}}"><img src="{{asset('public/front/image/logo.png')}}" alt="" />

                            </a>

                        </div>

                        

                        <div class="main-menu">

                            <ul>

                                <li><a href="{{route('home')}}">Home</a>

                                </li>

                                <li>

                                    <a href="{{route('about')}}">About</a>

                                </li>

                                <li class="cour-menu">

                                    <a href="#" class="mm-arr">Tour Package</a>

                                    <div class="mm-pos">

                                        <div class="cour-mm m-menu">

                                            <div class="m-menu-inn">

                                                <div class="mm1-com mm1-cour-com mm1-s3">

                                                <ul>

                                                    @if($package)

                                                        @foreach($package as $pack)

                                                            <li><a href="{{ route('package', $pack->slug) }}">{{ $pack->package_name }}</a></li>

                                                        @endforeach

                                                    @endif

                                                </ul>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                
                                <li><a href="{{route('hotels')}}">Hotels</a>

                                </li>

                                <li><a href="{{route('resort')}}">Resorts</a></li>

                                <li><a href="{{route('contact')}}">Contact us</a></li>
                                <li class="contcct"><a href="tel:+9818054830">9818054830</a></li>
                                <li class="contcct"><a href="tel:+9818055980">9818055980</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!--END HEADER SECTION-->