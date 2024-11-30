@extends('layouts.front.app')



@section('content')





    <!--====== BANNER ==========-->

    <section>

        <div class="rows inner_banner inner_banner_4" style="background-image: url('{{ asset('public/images/packages/' . $package->banner_image) }}'); background-size: cover; background-position: center center;">

            <div class="container">

                <div class="spe-title tit-inn-pg">

                    <h1>{{$package->name}} </h1>

                    <div class="title-line">

                        <div class="tl-1"></div>

                        <div class="tl-2"></div>

                        <div class="tl-3"></div>

                    </div>

                    <p>India's leading Hotel Booking website,Over 30,000 Hotel rooms worldwide.</p>

                    <ul>

                        <li><a href="{{route('home')}}">Home</a></li>

                        <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>

                        <li><a href="#" class="bread-acti">{{$package->name}}</a>

                        </li>

                    </ul>

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

                        <li class="dl1">Location : {{$package->location}}</li>

                        <li class="dl2">Price : &#8377;{{$package->price}}</li>

                        <li class="dl3">Duration : {{$package->nights}} Nights/ {{$package->days}} Days</li>

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

                        <h2>{{$package->title}} 

                            <!-- <span class="tour_star"><i class="fa fa-star" aria-hidden="true"></i><i

                                    class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"

                                    aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i

                                    class="fa fa-star-half-o" aria-hidden="true"></i></span><span

                                class="tour_rat">4.5</span> -->

                            </h2>

                    </div>

                    <!--====== TOUR DESCRIPTION ==========-->

                    <div class="tour_head1">

                        <h3>Trip Highlights</h3>

                       {!!$package->description!!}

                    </div>

                    <!--====== ROOMS: HOTEL BOOKING ==========-->

                <div class="tour_head1 hotel-book-room">

                    <h3>Photo Gallery</h3>

                    <div id="myCarousel1" class="carousel slide" data-ride="carousel">

                        <!-- Indicators -->

                        <ol class="carousel-indicators carousel-indicators-1">

                            @if($packageImage && count($packageImage) > 0)

                                @foreach($packageImage as $index => $images)

                                    <li data-target="#myCarousel1" data-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}">

                                        <img src="{{ asset('public/images/packages/' . $images->images) }}" alt="Image {{ $index + 1 }}">

                                    </li>

                                @endforeach

                            @endif

                        </ol>



                        <!-- Wrapper for slides -->

                        <div class="carousel-inner carousel-inner1" role="listbox">

                            @if($packageImage && count($packageImage) > 0)

                                @foreach($packageImage as $index => $images)

                                    <div class="item {{ $index === 0 ? 'active' : '' }}">

                                        <img src="{{ asset('public/images/packages/' . $images->images) }}" alt="Image {{ $index + 1 }}" width="460" height="345"> 

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

                                    <img src="{{ asset('public/front/images/gallery/t4.jpg') }}" alt="Chania" width="460" height="345">

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

                    <!--====== TOUR LOCATION ==========-->

                 

                    <!--====== ABOUT THE TOUR ==========-->

                    <div class="tour_head1">

                        @php $tour=json_decode($package->about_tour, true);  @endphp

                        <h3>About The Tour</h3>

                        <table>

                            <tr>

                                <th>Places covered</th>

                                <th class="event-res">Inclusions</th>

                                <th class="event-res">Exclusions</th>

                                <th>Event Date</th>

                            </tr>

                            @if(!empty($tour['place']))

                                @foreach($tour['place'] as $index => $place)

                                    <tr>

                                        <td>{{ $place }}</td>

                                        <td class="event-res">{{ $tour['inclusions'][$index] ?? 'N/A' }}</td>

                                        <td class="event-res">{{ $tour['exclusions'][$index] ?? 'N/A' }}</td>

                                        <td>{{ $tour['event_date'][$index] ?? 'N/A' }}</td>

                                    </tr>

                                @endforeach

                            @else

                                <tr>

                                    <td colspan="4">No tour information available.</td>

                                </tr>

                            @endif

                        </table>

                    </div>

                    <!--====== DURATION ==========-->

                    <div class="tour_head1 l-info-pack-days days">



                        @php $tour_desscription= json_decode($package->tour_description, true);   @endphp

                        <h3>Detailed Day Wise Itinerary</h3>

                        <ul>

                        @if(!empty($tour_desscription['tourtitle']))

                            @foreach($tour_desscription['tourtitle'] as $index => $tourtitle)

                            <li class="l-info-pack-plac"> <i class="fa fa-clock-o" aria-hidden="true"></i>

                                <h4><span>Day : {{$index+1}}</span> {{$tourtitle}}</h4>

                                @if (isset($tour_desscription['tour_description']) && is_array($tour_desscription['tour_description']))

                                    <p>{{ $tour_desscription['tour_description'][$index] ?? 'No description available.' }}</p>

                                @else

                                    <p>No description available.</p>

                                @endif

                            </li>

                            @endforeach

                        @endif

                            

                        </ul>

                    </div>

                    <!-- <div>

                        <div class="dir-rat">

                            <div class="dir-rat-inn dir-rat-title">

                                <h3>Write Your Rating Here</h3>

                                <p>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't

                                    anything embarrassing hidden in the middle of text</p>

                                <fieldset class="rating">

                                    <input type="radio" id="star5" name="rating" value="5" />

                                    <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                    <input type="radio" id="star4half" name="rating" value="4 and a half" />

                                    <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                    <input type="radio" id="star4" name="rating" value="4" />

                                    <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                    <input type="radio" id="star3half" name="rating" value="3 and a half" />

                                    <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                    <input type="radio" id="star3" name="rating" value="3" />

                                    <label class="full" for="star3" title="Meh - 3 stars"></label>

                                    <input type="radio" id="star2half" name="rating" value="2 and a half" />

                                    <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                    <input type="radio" id="star2" name="rating" value="2" />

                                    <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                    <input type="radio" id="star1half" name="rating" value="1 and a half" />

                                    <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                    <input type="radio" id="star1" name="rating" value="1" />

                                    <label class="full" for="star1" title="Sucks big time - 1 star"></label>

                                    <input type="radio" id="starhalf" name="rating" value="half" />

                                    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>

                                </fieldset>

                            </div>

                            <div class="dir-rat-inn">

                                <form class="dir-rat-form">

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="text" class="form-control" id="email11" placeholder="Enter Name">

                                    </div>

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="number" class="form-control" id="email12"

                                            placeholder="Enter Mobile">

                                    </div>

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="email" class="form-control" id="email13"

                                            placeholder="Enter Email id">

                                    </div>

                                    <div class="form-group col-md-6 pad-left-o">

                                        <input type="text" class="form-control" id="email14"

                                            placeholder="Enter your City">

                                    </div>

                                    <div class="form-group col-md-12 pad-left-o">

                                        <textarea placeholder="Write your message"></textarea>

                                    </div>

                                    <div class="form-group col-md-12 pad-left-o">

                                        <input type="submit" value="SUBMIT" class="link-btn">

                                    </div>

                                </form>

                            </div>


                            <div class="dir-rat-inn dir-rat-review">

                                <div class="row">

                                    <div class="col-md-3 dir-rat-left"> <img src="{{asset('public/front/images/reviewer/4.jpg')}}" alt="">

                                        <p>Orange Fab & Weld <span>19th December, 2024</span> </p>

                                    </div>

                                    <div class="col-md-9 dir-rat-right">

                                        <div class="dir-rat-star"> <i class="fa fa-star" aria-hidden="true"></i><i

                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"

                                                aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i

                                                class="fa fa-star-o" aria-hidden="true"></i> </div>

                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,

                                            when an unknown printer took a galley of type and scrambled it to make a

                                            type specimen book.</p>



                                    </div>

                                </div>

                            </div>


                            <div class="dir-rat-inn dir-rat-review">

                                <div class="row">

                                    <div class="col-md-3 dir-rat-left"> <img src="{{asset('public/front/images/reviewer/3.jpg')}}" alt="">

                                        <p>Orange Fab & Weld <span>19th December, 2024</span> </p>

                                    </div>

                                    <div class="col-md-9 dir-rat-right">

                                        <div class="dir-rat-star"> <i class="fa fa-star" aria-hidden="true"></i><i

                                                class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star"

                                                aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i

                                                class="fa fa-star-o" aria-hidden="true"></i> </div>

                                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,

                                            when an unknown printer took a galley of type and scrambled it to make a

                                            type specimen book.</p>

                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div> -->

                </div>

                <div class="col-md-4 tour_rhs">

                    <!--====== SPECIAL OFFERS ==========-->

                    <div class="tour_right tour_offer">

                        

                        <div class="band1"><img src="{{asset('public/front/images/offer.png')}}" alt="" /> </div>

                        <p>Special Offer</p>

                        <h4>&#8377;{{$package->price}}<span class="n-td">

                                <span class="n-td-1">&#8377;{{$package->amount}}</span>

                            </span>

                        </h4> <a href="{{route('enquiry')}}" class="link-btn">Enquiry</a>

                    </div>

                    <!--====== TRIP INFORMATION ==========-->

                    <!-- <div class="tour_right tour_incl tour-ri-com">

                        <h3>Trip Information</h3>

                        @php

                            $formatarrival_ = \Carbon\Carbon::parse($package->arrival_date)->format('M d, Y'); 

                            $formatdeparture= \Carbon\Carbon::parse($package->departure_date)->format('M d, Y');

                        @endphp

                        <ul>

                            <li>Location : {{$package->location}}</li>

                            <li>Arrival Date: {{ $formatarrival_ }}</li>

                            <li>Departure Date: {{$formatdeparture}}</li>

                        </ul>

                    </div> -->

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

                            <h4><i class="fa fa-phone" aria-hidden="true"></i> 6784563217</h4>

                        </div>

                    </div>

                    <!--====== PUPULAR TOUR PACKAGES ==========-->

                    <div class="tour_right tour_rela tour-ri-com">

                        <h3>Popular Packages</h3>

                        @if($popularpackage)

                            @foreach($popularpackage as $data)

                                @php

                                    // Fetch the first image for the current package

                                    $image = $data->images()->orderBy('id', 'asc')->first();

                                @endphp

                            <div class="tour_rela_1"> <img src="{{ $image ? asset('public/images/packages/' . $image->images) : asset('public/images/packages/'. $image->images) }}" alt="{{ $data->name }}" alt="" />

                                <h4>{{$data->name}} {{$data->days}}Days /{{$data->nights}}Nights</h4>

                                <p>{{ Str::limit(strip_tags($data->description), 100, '...') }}</p> <a href="{{ route('package.details', $data->slug) }}" class="link-btn">View this Package</a>

                            </div>

                            @endforeach

                        @endif

                        

                    </div>

                </div>

            </div>

        </div>

    </section>

   







@endsection