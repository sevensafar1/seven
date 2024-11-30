@extends('layouts.front.app')



@section('content')
<style>
    /* .banner-container {
    position: relative; 
    display: inline-block;
} */

.banner_img {
    width: 100%; /* Adjust the width as per your requirement */
    height: 270px;
}

.banner-text {
    position: absolute;
    top: 50%; /* Position the text in the middle (vertically) */
    left: 50%; /* Position the text in the middle (horizontally) */
    transform: translate(-50%, -50%); /* Center the text */
    color: white; /* Text color */
    font-size: 24px; /* Font size */
    font-weight: bold; /* Make the text bold */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Add shadow to make text stand out */
}
.carousel-inner > .item > img {
    display: block;
    max-width: 100%;
    height: 400px !important;
    object-fit: cover;
}
</style>






    <!--====== BANNER ==========-->

    <section>

    <div class="rows inner_banner inner_banner_resort-details" style="background-image: url('{{ asset('public/images/hotels/' . $hotel->banner_image) }}'); background-size: cover; background-position: center center;">

<div class="container">
    <div class="spe-title tit-inn-pg">
        <h1><span>{{$hotel->name}}</span></h1>
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

                    <ul>
                        @php 
                            $states=getState($hotel->state); 
                            $cities=getcity($hotel->city);
                        @endphp

                        <li class="dl1">Location : {{$cities->city}}</li>

                        <li class="dl2">Price : &#8377;{{$hotel->price}}</li>

                        <li class="dl3">Duration : {{$hotel->duration}}</li>

                        <li class="dl4"><a href="{{route('enquiry')}}">Enquiry</a> </li>

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

                        <h2> {{$hotel->name}}

                             <!-- <span class="tour_star"><i class="fa fa-star"

                                    aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i

                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"

                                    aria-hidden="true"></i><i class="fa fa-star-half-o"

                                    aria-hidden="true"></i></span><span class="tour_rat">4.5</span> -->

                                </h2>

                    </div>

                    <!--====== TOUR DESCRIPTION ==========-->

                    <div class="tour_head1 hotel-com-color">

                        <h3>About Hotel</h3>

                        {!!$hotel->about!!}

                    </div>

                    <!--====== ROOMS: HOTEL BOOKING ==========-->

                    <div class="tour_head1 hotel-book-room">

                    <h3>Photo Gallery</h3>

                    <div id="myCarousel1" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->

                        <ol class="carousel-indicators carousel-indicators-1">

                            @if($hotelImage && count($hotelImage) > 0)

                                @foreach($hotelImage as $index => $images)

                                    <li data-target="#myCarousel1" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}">

                                        <img src="{{ asset('public/images/hotels/' . $images->images) }}" alt="Image {{ $index + 1 }}">

                                    </li>

                                @endforeach

                            @endif

                        </ol>



                        <!-- Wrapper for slides -->

                        <div class="carousel-inner carousel-inner1" role="listbox">

                            @if($hotelImage && count($hotelImage) > 0)

                                @foreach($hotelImage as $index => $images)

                                    <div class="item {{ $index === 0 ? 'active' : '' }}">

                                        <img src="{{ asset('public/images/hotels/' . $images->images) }}" alt="Image {{ $index + 1 }}" width="460" height="345"> 

                                    </div>

                                @endforeach

                            @else

                                <!-- Fallback images if no package images are available -->

                                <div class="item active">

                                    <img src="{{ asset('public/front/images/gallery/t1.jpg') }}" alt="Chania" width="460" height="345"> 

                                </div>

                                <div class="item">

                                    <img src="{{ asset('public/front/images/gallery/t2.jpg') }}" alt="Chania" width="460" height="345">

                                </div>

                                <div class="item">

                                    <img src="{{ asset('public/front/images/gallery/t3.jpg') }}" alt="Chania" width="460" height="345">

                                </div>

                                <div class="item">

                                    <img src="{{ asset('publicfront/images/gallery/t4.jpg') }}" alt="Chania" width="460" height="345">

                                </div>

                            @endif

                        </div>



                        <!-- Left and right controls -->

                        <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">

                            <span><i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true"></i></span>

                        </a>

                        <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">

                            <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true"></i></span>

                        </a>

                    </div>

                </div>

                            

                    <div class="tour_head1 hot-ameni">

                        @php $aminity =json_decode($hotel->amenities, true);   @endphp

                        <h3>Hotel Amenities</h3>

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
                        <p>{{$hotel->address}},{{$cities->city}}, {{$states->state}}</p>
                    </div>

                    <!--====== TOUR LOCATION ==========-->



                    <!-- <div>

                        <div class="dir-rat">

                            <div class="dir-rat-inn dir-rat-title">

                                <h3>Write Your Rating Here</h3>

                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't

                                    anything embarrassing hidden in the middle of text</p>

                                <fieldset class="rating">

                                    <input type="radio" id="star5" name="rating" value="5" />

                                    <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                    <input type="radio" id="star4half" name="rating" value="4.5" />

                                    <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                    <input type="radio" id="star4" name="rating" value="4" />

                                    <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                    <input type="radio" id="star3half" name="rating" value="3.5" />

                                    <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                    <input type="radio" id="star3" name="rating" value="3" />

                                    <label class="full" for="star3" title="Meh - 3 stars"></label>

                                    <input type="radio" id="star2half" name="rating" value="2.5" />

                                    <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                    <input type="radio" id="star2" name="rating" value="2" />

                                    <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                    <input type="radio" id="star1half" name="rating" value="1.5" />

                                    <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                    <input type="radio" id="star1" name="rating" value="1" />

                                    <label class="full" for="star1" title="Sucks big time - 1 star"></label>

                                    <input type="radio" id="starhalf" name="rating" value="0.5" />

                                    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                </fieldset>

                            </div>

                            <div class="dir-rat-inn">

                                <form class="dir-rat-form" action="" method="POST">

                                    

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="text" name="name" class="form-control" id="email11" placeholder="Enter Name" required>

                                    </div>

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="number" name="mobile" class="form-control" id="email12" placeholder="Enter Mobile" required>

                                    </div>

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="email" name="email" class="form-control" id="email13" placeholder="Enter Email id" required>

                                    </div>

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="text" name="city" class="form-control" id="email14" placeholder="Enter your City" required>

                                    </div>

                                    <div class="form-group col-md-12 pad-left-o">

                                        <textarea name="message" placeholder="Write your message" required></textarea>

                                    </div>

                                    <div class="form-group col-md-12 pad-left-o">

                                        <input type="submit" value="SUBMIT" class="link-btn">

                                    </div>

                                </form>

                            </div>

                            

                            <div class="dir-rat-inn dir-rat-review">

                               

                            </div>

                        </div>

                    </div> -->

                </div>

                <div class="col-md-4 tour_rhs">

                    <!--====== SPECIAL OFFERS ==========-->

                    <div class="tour_right tour_offer">

                        <div class="band1"><img src="images/offer.png" alt="" /> </div>

                        <p>Special Offer</p>

                        <h4>&#8377;{{$hotel->price}}<span class="n-td">

                                <span class="n-td-1">&#8377;{{$hotel->mrp}}</span>

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

                    <!--====== PUPULAR TOUR PACKAGES ==========-->

                    <div class="tour_right tour_rela tour-ri-com">

                        <h3>Popular Hotel</h3>

                        @if($tophotel)

                        @foreach($tophotel as $top)

                        <div class="tour_rela_1"> <img src="{{asset('public/images/related1.png')}}" alt="" />

                            <h4>{{$top->city}} {{$top->days}} Days / {{$top->nights}}Nights</h4>

                            {!!$top->about!!}

                                 <a href="{{route('hotel.detail',$top->slug)}}" class="link-btn">View this Package</a>

                        </div>

                        @endforeach

                        @endif

                       

                    </div>

                </div>

            </div>

        </div>

    </section>





@endsection