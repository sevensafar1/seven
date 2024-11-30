@extends('layouts.front.app')
@section('content')


<style type="text/css">
    .carousel-inner > .item > img {
    display: block;
    max-width: 100%;
    height: 400px !important;
    object-fit: cover;
}
</style>






    <!--====== BANNER ==========-->

    <section>

    <div class="rows inner_banner inner_banner_resort-details" style="background-image: url('{{ asset('public/images/resorts/' . $resort->banner_image) }}'); background-size: cover; background-position: center center;">

        <div class="container">
            <div class="spe-title tit-inn-pg">
                <h1><span>{{$resort->name}}</span></h1>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
            </div>
        </div>

    </div>

    </section>

    <!--====== TOUR DETAILS - BOOKING ==========-->

    <section>

        <div class="rows banner_book" id="inner-page-title">

            <div class="container">

                <div class="banner_book_1">
                @php 
                $city=getcity($resort->city); 
                $state=getState($resort->state);
                
                @endphp


                    <ul>

                        <li class="dl1">Location :{{ $city ? $city->city : 'N/A' }}</li>

                        <li class="dl2">Price : &#8377;{{$resort->price}}</li>

                        <li class="dl3">Duration : {{$resort->duration}}</li>

                        <li class="dl4"><a href="{{route('hotel.enquiry')}}">Enquiry</a> </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>

    <!--====== TOUR DETAILS ==========-->

    <section>

        <div class="rows inn-page-bg com-colo">

            <div class="container inn-page-con-bg tb-space">

                <div class="col-md-8 tour_lhs">

                    <!--====== TOUR TITLE ==========-->

                    <div class="tour_head">

                        <h2>{{$resort->name}}</h2>

                    </div>

                    <!--====== TOUR DESCRIPTION ==========-->

                    <div class="tour_head1 hotel-com-color">

                        <h3>About Resort</h3>

                        {!!$resort->about!!}

                    </div>

                    <!--====== ROOMS: HOTEL BOOKING ==========-->

                    <div class="tour_head1 hotel-book-room">

                        <h3>Photo Gallery</h3>

                        <div id="myCarousel1" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->

                            <ol class="carousel-indicators carousel-indicators-1">

                            @if($resortImage && count($resortImage) > 0)

                                @foreach($resortImage as $index => $images)

                                    <li data-target="#myCarousel1" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}">

                                        <img src="{{ asset('public/images/resorts/' . $images->images) }}" alt="Image {{ $index + 1 }}">

                                    </li>

                                @endforeach

                            @endif

                            </ol>

                            <!-- Wrapper for slides -->

                            <div class="carousel-inner carousel-inner1" role="listbox">

                            @if($resortImage && count($resortImage) > 0)

                                @foreach($resortImage as $index => $images)

                                    <div class="item {{ $index === 0 ? 'active' : '' }}">

                                        <img src="{{ asset('public/images/resorts/' . $images->images) }}" alt="Image {{ $index + 1 }}" width="460" height="345"> 

                                    </div>

                                @endforeach

                            @else

                            <div class="item active"> <img src="{{asset('public/front/images/gallery/s1.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s2.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s3.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s4.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s5.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s6.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s7.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('public/front/images/gallery/s8.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                                <div class="item"> <img src="{{asset('publi/front/images/gallery/s9.jpg')}}" alt="Chania" width="460"

                                        height="345"> </div>

                            @endif

                            </div>

                            <!-- Left and right controls -->

                            <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">

                                <span><i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true"></i></span> </a>

                            <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">

                                <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1"

                                        aria-hidden="true"></i></span> </a>

                        </div>

                    </div>

                 



                    <!--====== AMENITIES ==========-->

                    <div class="tour_head1 hot-ameni">

                    @php $aminity =json_decode($resort->facilty, true);   @endphp

                        <h3>Resort Facilities</h3>

                        <ul>

                        @if($aminity)

                            @foreach($aminity as $ami)

                                <li><i class="fa fa-check" aria-hidden="true"></i> {{$ami}}</li>

                            @endforeach

                            @endif

                            

                        </ul>

                    </div>



                    <div class="tour_head1 hot-ameni">
                        <h3>Address</h3>
                        <p>{{$resort->address}}, {{ $city ? $city->city : 'N/A' }}, {{ $state ? $state->state : 'N/A' }}</p>
                    </div>

                    

                </div>

                <div class="col-md-4 tour_rhs">

                    <!--====== SPECIAL OFFERS ==========-->

                    <div class="tour_right tour_offer">

                        <div class="band1"><img src="{{asset('public/images/offer.png')}}" alt="" /> </div>

                        <p>Special Offer</p>

                        <h4>&#8377;{{$resort->price}}<span class="n-td">

                                <span class="n-td-1">&#8377;{{$resort->mrp}}</span>

                            </span>

                        </h4> <a href="{{route('enquiry')}}" class="link-btn">Enquiry</a>

                    </div>

                    

                    <!--====== PACKAGE SHARE ==========-->

                    <div class="tour_right head_right tour_social tour-ri-com">

                        <h3>Share This Package</h3>

                        <ul>

                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>

                            <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a> </li>

                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>

                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>

                            <li><a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> </li>

                        </ul>

                    </div>

                    <!--====== HELP PACKAGE ==========-->

                    <div class="tour_right head_right tour_help tour-ri-com">

                        <h3>Help & Support</h3>

                        <div class="tour_help_1">

                            <h4 class="tour_help_1_call">Call Us Now</h4>

                            <h4><i class="fa fa-phone" aria-hidden="true"></i> 8756453476</h4>

                        </div>

                    </div>

                  

                </div>

            </div>

        </div>

    </section>





@endsection