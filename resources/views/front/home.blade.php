<head>

    <title>Sevensafar - Tour & Travels</title>
    <meta name="google-site-verification" content="WYLaoWmB_hrMvq5XMj-929IIz9AMBA_-iPBAeMcPLqY">

    <!--== META TAGS ==-->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- FAV ICON -->

    <link rel="shortcut icon" href="{{asset('public/front/image/favicon.png')}}">

    <!-- GOOGLE FONTS -->

    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">

    <!-- FONT-AWESOME ICON CSS -->

    <link rel="stylesheet" href="{{asset('public/front/css/font-awesome.min.css')}}">

    <!--== ALL CSS FILES ==-->

    <link rel="stylesheet" href="{{asset('public/front/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/style.css?v=18.0')}}">

    <!-- <link rel="stylesheet" href="css/styles.css?v=4.0"> -->

    <link rel="stylesheet" href="{{asset('public/front/css/jquery-ui.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/mob.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/animate.css')}}">

    <link rel="stylesheet" href="path/to/styles.css">


    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"

        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

    </script>
    <script src="{{asset('public/front/js/slick.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

   

</head>

<style>
    
    .hom-pack-deta {
    position: absolute;
    left: 8%;
    right: 0px;
    top: 30%;
    color: rgb(255, 255, 255);
    width: 80%;
    padding: 0px 50px 30px;
    z-index: 2;
}
.spe-title p {
    margin-bottom: 0px;
    font-size: 18px;
    font-weight: 400;
    padding-top: 12px;
    color: #181818;
    line-height: 25px;
}
.tourpacksection .pack-new-box .to-ho-hotel-con-1 img {
    height: 250px;
}
.tourpacksection .tourpackname h2 a {
    color: #024c59 !important;
    font-size: 18px;
    font-weight: 600;
}
.tourpackname p {
    font-size: 16px;
    color: #3f3f3f;
}
.tourpackname p i
{
    color: #ee724894;
}
.tourpacksection .slick-track li
{
    border-radius: 5px;
    height: 380px;
    background-color: #fff;
}

.tourpacksection
{
    background-image: url(public/front/image/tourbackground.png);
    background-repeat: no-repeat;
    background-size: cover;
    padding: 20px 0px;
}
.pad-bot-redu {
    padding-bottom: 35px;
}
.gallery-section img {
    width: 100%;
}

.homegalleryimgdiv {
    padding: 10px;
}







.gallery-section .gallerycontainer {
  display: flex;
  width: 100%;
  padding: 0;
  box-sizing: border-box;
  height: 60vh;
  margin-bottom: 30px;
}

.gallery-section .box {
  flex: 1;
  overflow: hidden;
  transition: .5s;
  margin: 0 2px;
  box-shadow: 0 20px 30px rgba(0,0,0,.1);
  line-height: 0;
  background-color: #ffffff;
}

.gallery-section .box > img {
  width: 200%;
  height: calc(100% - 10vh);
  object-fit: cover; 
  transition: .5s;
}

.gallery-section .box > span {
  font-size: 3.8vh;
  display: block;
  text-align: center;
  height: 10vh;
  line-height: 2.6;
}

.gallery-section .box:hover { flex: 1 1 50%; }
.gallery-section .box:hover > img {
  width: 100%;
  height: 100%;
}
.box p {
    padding: 10px 10px;
}
section.gallery-section {
    background: #fff5e5;
    padding-top: 20px;
    padding-bottom: 10px;
}
.main-menu ul li a {
    color: rgb(255 255 255);
    }





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

.top-logo {
    transition: all 0.5s ease 0s;
    padding: 10px 0px;
    background: rgb(255 255 255 / 0%);
}




.videosection {
    /* margin-top: 240px; */
    background-image: url(public/front/image/videobannerimageaaaa.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    height: 320px;
}


section.blogsection {
    background-color: #e9faff;
}




</style>
    <!--HEADER SECTION-->

  <!--   <section class="bannersection">

        <div class="container-fluid">

            <div class="to-ho-hotel">

                <ul class="multiple-items">
                    @php 
                        $banner=bannerimg();
                    @endphp
                    @if($banner)
                    @foreach($banner as $bnn)
                    <li class="col-md-12">

                        <div class="to-ho-hotel-con pack-new-box">

                            <div class="to-ho-hotel-con-1">
                            <img src="{{ asset('public/images/banner/' . $bnn->image) }}" alt="{{ $bnn->title }}" loading="lazy">



                                <div class="hom-pack-deta">

                                    <h2>{{$bnn->title}}</h2>

                                    <p>{!!$bnn->description!!}</p>

                                </div>

                            </div>

                        </div>

                    </li>
                    @endforeach
                    @endif

                    



                </ul>

            </div>

        </div>

    </section> -->

    <!--END HEADER SECTION-->







<body>

<section style="position: absolute; width: 100%;">

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

                            <h4 >Tour Packages</h4>

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

    <section style="position: absolute; width: 100%;">

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







    <section>
        <!-- <video width="100%" controls autoplay muted style="pointer-events: none;"> 
            <source src="public/front/images/gallery/banner-video.mp4" type="video/mp4">
        </video> -->
        <div>
            <img style="width: 100%; height: 100vh;" src="public/front/images/banner/bannerimage23.jpg">
        </div>

    </section>





    <section class="tourpacksection py-2 bg-overlay-light-600 bg-overlay">

        <div class="rows pad-bot-redu">

            <div class="container">

                @php $pacage= homepackage(); @endphp

                <!-- TITLE & DESCRIPTION -->

                <div class="spe-title">

                    <h2>Tour <span>Packages</span></h2>

                    <div class="title-line">

                        <div class="tl-1"></div>

                        <div class="tl-2"></div>

                        <div class="tl-3"></div>

                    </div>

                    <p>It’s time to explore the unexplored places that you always wanted to visit once in your life. We offer tour packages that will make every travel dream come true without breaking the bank. So, book your tour package with us and get ready to enjoy your real travel life!</p>

                </div>

                <!-- HOTEL GRID -->

                <div class="to-ho-hotel">

                    <ul class="tourpackage">

                        @if($pacage)

                        @foreach($pacage as $pack)

                        @php

                            // Fetch the first image for the current package

                            $image = $pack->images()->orderBy('id', 'asc')->first();

                        @endphp

                        <li class="col-md-4 col-lg-4 col-sm-12" style="padding: 0;">

                            <div class="to-ho-hotel-con pack-new-box">

                                <div class="to-ho-hotel-con-1">
                                <img src="{{ $image ? asset('public/images/packages/' . $image->images) : asset('public/images/packages/'. $image->images) }}" alt="{{ $pack->name }}" loading="lazy">


                                    <!-- <img src="{{ $image ? asset('public/images/packages/' . $image->images) : asset('public/images/packages/'. $image->images) }}" alt="{{ $pack->name }}"> -->

                                    <!-- <div class="hom-pack-deta">

                                        <h2>Family package</h2>

                                        <h4><span>20+</span> destinations</h4>

                                        <span class="cta-2">Book now</span>

                                    </div> -->

                                </div>

                                <a href="{{ route('package.details', $pack ->slug) }}" class="fclick"></a>





                            </div>

                            <div class="tourpackname py-4">

                                <h2><a>{{$pack->title}}</a></h2>

                                <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$pack->location}}</p>

                            </div>

                        </li>

                        @endforeach

                        @endif

                       

                       



                    </ul>

                </div>

            </div>

        </div>

    </section>



    <section class="gallery-section pb-5">

        <div class="container">

            <div class="spe-title">

                <h2>Our <span>gallery</span></h2>

                <div class="title-line">

                    <div class="tl-1"></div>

                    <div class="tl-2"></div>

                    <div class="tl-3"></div>

                </div>

            </div>



            @php $gallery = gallery(); @endphp
            <div class="gallerycontainer">
            @if($gallery)
            @foreach($gallery as $gall)
                @php
                    // Decode the JSON string into a PHP array
                    $images = json_decode($gall->image, true);
                @endphp
                @if (!empty($images) && is_array($images) && isset($images[0]))
                
                    <div class="box">
                    <!-- <a href="{{route('gallery/image',$gall->slug)}}"> -->
                    <img src="{{ asset('public/images/gallery/' . trim($images[0], '"')) }}" alt="{{ $gall->alt }}" loading="lazy">
                    <p>{{ $gall->title }}</p>
                    <!-- </a> -->
                    
                    </div>
                
                @else
                    <span>No image available</span> 
                @endif
               
            @endforeach
              @endif
            </div>



            <!-- <div class="row">
                <div class="col-lg-4 p-0">
                    <div class="homegalleryimgdiv">
                        <img src="public/front/images/gallery/frontgallery1.jpg">
                    </div>
                    <div class="homegalleryimgdiv">
                        <img src="public/front/images/gallery/frontgallery1.jpg">
                    </div>
                </div>
                <div class="col-lg-3 p-0">
                    <div class="homegalleryimgdiv">
                        <img style="height: 500px; object-fit: cover;" src="public/front/images/gallery/frontgallery2.jpg">
                    </div>
                </div>
                <div class="col-lg-5 p-0">
                    <div class="homegalleryimgdiv">
                        <img src="public/front/images/gallery/frontgallery1.jpg">
                    </div>
                    <div class="homegalleryimgdiv d-flex">
                        <img class="w-50" src="public/front/images/gallery/frontgallery1.jpg">
                        <img class="w-50" src="public/front/images/gallery/frontgallery1.jpg">
                    </div>
                </div>
            </div> -->




            <!-- <div class="row">
                @php $gallery = gallery(); @endphp

                @if($gallery)
                    @foreach($gallery as $gall)
                        @php
                            // Decode the JSON string into a PHP array
                            $images = json_decode($gall->image, true);
                        @endphp

                        <div class="col-lg-4 col-md-4 col-sm-12 p-4">
                            <div class="galleryimg">
                                @if (!empty($images) && is_array($images) && isset($images[0]))

                                    <a href="{{route('gallery/image',$gall->slug)}}"><img src="{{ asset('public/images/gallery/' . trim($images[0], '"')) }}" alt="{{ $gall->alt }}" loading="lazy"></a>
                                @else
                                    <span>No image available</span> 
                                @endif
                                <a href="{{route('gallery/image',$gall->slug)}}">
                                <div class="overlay">
                                    <div>
                                     <h3>{{ $gall->title }}</h3>
                                        <p>{{ $gall->location }}</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div> -->





            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 text-center">

                    <a href="{{route('gallery')}}"><button>view more</button></a>

                </div>

            </div>

        </div>

    </section>



    <!-- <section class="offerpacksection mt-5 mb-5">

        <div class="rows pad-bot-redu offerpackimg">

            <div class="container">


                <div class="spe-title">

                    <h2>Offer <span>Packages</span></h2>

                    <div class="title-line">

                        <div class="tl-1"></div>

                        <div class="tl-2"></div>

                        <div class="tl-3"></div>

                    </div>


                </div>


                <div class="to-ho-hotel">

                    <ul class="offerpackage">

                        <li class="col-md-6">

                            <div class="to-ho-hotel-con pack-new-box">

                                <div class="to-ho-hotel-con-1">

                                    <img src="{{asset('front/image/tourimg.jpg')}}" alt="">

                                     <div class="hom-pack-deta">

                                        <h2>Family package</h2>

                                        <h4><span>20+</span> destinations</h4>

                                        <span class="cta-2">Book now</span>

                                    </div> 

                                </div>

                                <a href="#" class="fclick"></a>





                            </div>

                            <div class="tourpackname py-4">

                                <h2><a>Jim Corbett National Park</a></h2>

                                <p>Uttrakhand</p>

                            </div>

                        </li>



                        <li class="col-md-6">

                            <div class="to-ho-hotel-con pack-new-box">

                                <div class="to-ho-hotel-con-1">

                                    <img src="{{asset('public/front/image/tourimg2.jpg')}}" alt="">

                                    
                                </div>

                                <a href="#" class="fclick"></a>





                            </div>

                            <div class="tourpackname py-4">

                                <h2><a>Jim Corbett National Park</a></h2>

                                <p>Uttrakhand</p>

                            </div>

                        </li>



                        <li class="col-md-6">

                            <div class="to-ho-hotel-con pack-new-box">

                                <div class="to-ho-hotel-con-1">

                                    <img src="{{asset('public/front/image/tourimg3.jpg')}}" alt="">

                                   

                                </div>

                                <a href="#" class="fclick"></a>





                            </div>

                            <div class="tourpackname py-4">

                                <h2><a>Jim Corbett National Park</a></h2>

                                <p>Uttrakhand</p>

                            </div>

                        </li>



                    </ul>

                </div>

            </div>

        </div>

    </section> -->







    <section class="videosection mb-5">

        <div class="rows pad-bot-redu">

            <div class="container pt-5" style="display: none;">

                <!-- TITLE & DESCRIPTION -->

                <div class="spe-title mt-4">

                    <h2>Offer <span>Packages</span></h2>

                    <div class="title-line">

                        <div class="tl-1"></div>

                        <div class="tl-2"></div>

                        <div class="tl-3"></div>

                    </div>

                    <!-- <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide.</p> -->

                </div>

                <div class="video-text text-center">

                    <p>We have a wide range of tour packages that fit your budget and give you a once-in-a-lifetime chance to live your travel dreams. Whether you are looking for adventure trips, wildlife exploration, or family packages, we've got you covered! </p>



                    <div class="playbtn ">

                        <a href="#." class="popup" data-toggle="modal" data-target="#exampleModal">

                            <span></span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>







    <section class="blogsection py-5">

    <div class="container">

        <div class="spe-title">

            <h2>Our <span>Blog</span></h2>

            <div class="title-line">

                <div class="tl-1"></div>

                <div class="tl-2"></div>

                <div class="tl-3"></div>

            </div>

        </div>

        <div class="row">

            @php $blogs = homeBlog(); @endphp



            @if($blogs && $blogs->count() > 0)

                <div class="col-lg-8 col-md-8 col-sm-12 p-4">

                    @php $firstBlog = $blogs->first(); @endphp

                    <div class="blogimg">

                        <img src="{{ asset('public/images/Blog/' . $firstBlog->image) }}" 

                             alt="{{ pathinfo($firstBlog->image, PATHINFO_FILENAME) }}" loading="lazy">

                        <div class="overlay">

                            <div>

                                <p>{{ \Carbon\Carbon::parse($firstBlog->created_at)->format('d F Y') }}</p>

                                <h3>{{ $firstBlog->title }}</h3>

                                <a href="{{ route('blog/detail', $firstBlog->slug) }}"><button>Read More</button></a>

                            </div>

                        </div>

                    </div>

                </div>

            @endif



            <div class="col-lg-4 col-md-4 col-sm-12 p-4">

                @if($blogs->count() > 1)

                    @foreach($blogs->skip(1)->take(2) as $blg)

                    <div class="blogimg mb-5">

                        <img src="{{ asset('public/images/Blog/' . $blg->image) }}" 

                             alt="{{ pathinfo($blg->image, PATHINFO_FILENAME) }}" loading="lazy">

                        <div class="overlay">

                            <div>

                                <p>{{ \Carbon\Carbon::parse($blg->created_at)->format('d F Y') }}</p>

                                <h3>{{ $blg->title }}</h3>

                                <a href="{{ route('blog/detail', $blg->slug) }}"><button>Read More</button></a>

                            </div>

                        </div>

                    </div>

                    @endforeach

                @endif

            </div>

        </div>

    </div>

</section>





















    <!--========= Scripts ===========-->

    <script src="js/jquery-latest.min.js"></script>

    <script src="js/bootstrap.js"></script>

    <script src="js/jquery-ui.js"></script>

    <script src="js/wow.min.js"></script>

    <script src="js/select-opt.js"></script>

    <script src="js/slick.js"></script>

    <script src="js/custom.js"></script>

    <script>

    $('.multiple-items').slick({

        dots: true,

        arrows: false,

        infinite: false,

        slidesToShow: 1,

        slidesToScroll: 1,

        autoplay: true,

        autoplaySpeed: 3000,

        responsive: [{

            breakpoint: 992,

            settings: {

                slidesToShow: 1,

                slidesToScroll: 1,

                centerMode: false,

            }

        }]



    });

    $('.tourpackage').slick({

        dots: true,

        arrows: false,

        infinite: false,

        slidesToShow: 3,

        slidesToScroll: 1,

        autoplay: true,

        autoplaySpeed: 3000,

        responsive: [{

            breakpoint: 992,

            settings: {

                slidesToShow: 1,

                slidesToScroll: 1,

                centerMode: false,

            }

        }]



    });



    $('.offerpackage').slick({

        dots: true,

        arrows: false,

        infinite: false,

        slidesToShow: 2,

        slidesToScroll: 1,

        autoplay: true,

        autoplaySpeed: 3000,

        responsive: [{

            breakpoint: 992,

            settings: {

                slidesToShow: 1,

                slidesToScroll: 1,

                centerMode: false,

            }

        }]



    });

    </script>






<section class="footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div>
                        <p style="position: relative;"><i class="fa fa-map-marker" aria-hidden="true"></i> <span style="position: absolute; left: 35px;">15/8, Block -15, Near Exide Battery, Geeta Colony, East Delhi, New Delhi - 110031</p>
                        <p class="mt-4"><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:info@sevensafar.com">info@sevensafar.com</a></p>
                        <p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:9818054830">9818054830</a>, <a href="tel:9818055980">9818055980</a></p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div>
                        <p style="font-size: 20px; margin-bottom: 5px;">Quick Links</p>
                        <ul>

                            <a href="#"><li>Domestic Package</li></a>

                            <a href="#"><li>Wildlife Package</li></a>

                            <a href="#"><li>Adventure Package</li></a>

                            <a href="#"><li>Corporate Tour Package</li></a>

                            <a href="#"><li>Resort</li></a>

                            <a href="#"><li>Hoteliers</li></a>

                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <p style="font-size: 20px; margin-bottom: 5px;">Useful Links</p>
                        <ul>

                            <a href="{{route('testimonial')}}"><li>Testimonial</li></a>

                            <a href="{{route('contact')}}"><li>Contact Us</li></a>

                            <a href="#"><li>Achievements</li></a>

                            <a href="{{route('blog')}}"><li>Blog</li></a>

                            <a href="{{ route('privacy') }}"><li>Privacy & Policy</li></a>

                            <a href="{{route('termsconditions')}}"><li>Terms & Conditions</li></a>

                        </ul>
                </div>

                <div class="col-md-8 col-sm-12 d-flex align-items-center">
                   

                        <div class="text-center">

                            <p>©Copyright 2024 Sevensafar. All Rights Reserved</p>

                        </div>
                </div>

                <div class="col-md-4 col-sm-12">
                     <div class="d-flex justify-content-center py-3">

                            <i class="fa fa-facebook" aria-hidden="true"></i>

                            <i class="fa fa-instagram" aria-hidden="true"></i>

                            <i class="fa fa-twitter" aria-hidden="true"></i>

                            <i class="fa fa-youtube-play" aria-hidden="true"></i>

                        </div>
                </div>
            </div>
        </div>
    </section>