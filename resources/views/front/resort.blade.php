@extends('layouts.front.app')



@section('content')


<style type="text/css">
    .carousel-inner .item img{

    display: block;

    max-width: 100%;

    height: 240px !important;

    object-fit: cover;

}

.resort .hotel-gal-arr

{
    margin-top: unset;
    left: 10px;
    top: 45%;
}

.resort-fliter-section .filter-price {
    width: 260px;
}
.resort-fliter-section .price-field input[type=range] {
    width: 240px;
}
.resort h2 {
    font-size: 16px;
    color: #014c5c;
}
.bloglist-text:hover h2 {
    font-size: 16px;
    color: #5ed7d6;
}
.bloglist-text {
    width: 400px;
}
.bloglist-text i {
    color: #f27242ad;
}
.com-colo-abou p, li {
    color: rgb(98 98 98);
}
</style>


    <section>

        <div class="rows inner_banner inner_banner_resort">

            <div class="container">

                <div class="spe-title tit-inn-pg">

                    <h1> <span>Resorts</span> </h1>

                    <div class="title-line">

                        <div class="tl-1"></div>

                        <div class="tl-2"></div>

                        <div class="tl-3"></div>

                    </div>

                    <!-- <p>Book travel packages and enjoy your holidays with distinctive experience</p>

					<ul>

						<li><a href="main.html">Home</a></li>

						<li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>

						<li><a href="#" class="bread-acti">Blogs</a>

						</li>

					</ul> -->

                </div>

            </div>

        </div>

    </section>

    <!--====== ALL POST ==========-->



    <section class="resort-fliter-section">
        <div class="container">
            <div class="row resort-filter-div">
            <form id="filterForm" method="GET" action="{{ route('resort') }}">
                    <div class="col-md-3">
                        <div class="form-group">

                            <label>Your destination</label>

                            <select class="chosen-select" name="destination" id="destinationFilter">
                                <option value="">Your destination</option> 
                                @foreach($location as $locat)
                                    <option value="{{ $locat->id }}" {{ request('destination') == $locat->id ? 'selected' : '' }}>
                                        {{ $locat->city }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <!-- Price Range Filter -->
               
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Price</label>
                            <select class="chosen-select" name="price_range" id="priceFilter">
                                <option value="">Starting Price</option>
                                @for($i = 1000; $i <= 25000; $i += 500)
                                <option value="{{ $i+500 }}" {{ request('price_range') == $i+500 ? 'selected' : '' }}>₹{{$i}}-₹{{$i+500}}</option>
                                @endfor
                            
                            </select>
                        </div>
                    </div>
                    <!-- Star Rating Filter -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Top Rated Resort</label>
                            <select class="chosen-select" name="star_rating" id="starRatingFilter">
                                <option value="">Top Resort</option>
                                <option value="5" {{ request('star_rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                                <option value="4" {{ request('star_rating') == '4' ? 'selected' : '' }}>4 Stars</option>
                                <option value="3" {{ request('star_rating') == '3' ? 'selected' : '' }}>3 Star</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Popular</label>
                            <select class="chosen-select" name="facilty" id="popularFilter">

                            <option value="">----Select Popular----</option>
                            <option value="EP" {{ request('facilty') == 'EP' ? 'selected' : '' }}>Only Room</option>
                            <option value="CP" {{ request('facilty') == 'CP' ? 'selected' : '' }}>Breakfast Included</option>
                            <option value="MAP" {{ request('facilty') == 'MAP' ? 'selected' : '' }}>Breakfast +Lunch/Dinner</option>
                            <option value="AP" {{ request('facilty') == 'AP' ? 'selected' : '' }}> Breakfast +Lunch+Dinner</option>
                            </select>
                        </div>
                    </div>


            </div>
            </form>
        </div>
    </section>

    <section class="resort">

        

        <div class="rows inn-page-bg com-colo">

            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">

                <!--===== POSTS ======-->



                



                <div class="rows">

                    <div class="resort-child">

                    @if($resort)

                        @foreach($resort as $res)

                            @php

                                // Fetch the images for the current resort

                                $images = $res->images()->orderBy('id', 'asc')->get();

                            @endphp

                            <div class="col-md-4 col-sm-4 col-xs-12 my-3" style="height: 440px; box-shadow: 0 0 10px 0 #eeeeee;">

                                <div class="tour_head1 hotel-book-room">

                                    <!-- Resort Carousel -->

                                    <div id="carousel{{ $res->id }}" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner" role="listbox">

                                            @if($images->count() > 0)

                                                @foreach($images as $key => $image)
                                                

                                                    <div class="item {{ $key == 0 ? 'active' : '' }}">

                                                        <img src="{{ asset('public/images/resorts/' . $image->images) }}" alt="Resort Image">

                                                    </div>

                                                @endforeach

                                            @else

                                                <div class="item active">

                                                    <img src="{{ asset('public/front/image/default_resort.jpg') }}" alt="Default Resort Image">

                                                </div>

                                            @endif

                                        </div>

                                        <!-- Left and right controls -->

                                        <a class="left carousel-control" href="#carousel{{ $res->id }}" role="button" data-slide="prev">

                                            <span><i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true"></i></span>

                                        </a>

                                        <a class="right carousel-control" href="#carousel{{ $res->id }}" role="button" data-slide="next">

                                            <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true"></i></span>

                                        </a>

                                    </div>

                                </div>



                                <div class="d-flex justify-content-around align-items-baseline">

                                    <div class="bloglist-text">

                                        <a href="{{ route('resort.detail', $res->slug) }}"><h2>{{ $res->name }}</h2></a>

                                        <ul>
                                        @php 
                                        $city=getcity($res->city); 
                                        $state=getState($res->state);
                                        
                                        @endphp


                                            <li>
                                                <i class="fa fa-flag" aria-hidden="true"></i> {{ $res->distance ? $res->distance : 'Empty' }}
                                            </li>
                                            <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $city ? $city->city : 'N/A' }}</li>

                                            <li><i class="fa fa-phone" aria-hidden="true"></i> {{ $res->phone }}</li>

                                        </ul>

                                    </div>

                                    <div class="py-0">

                                        <p class="hot-list-p3-1">Price Per Night</p>

                                        <!-- <span class="hot-list-p3-2">₹{{ $res->price }}</span> -->

                                        <h4 class="hot-list-p3-2" style="padding: 10px 0px 0px 0px;font-size: 16px;">&#8377;{{$res->price}}</h4>
                                        <span class="n-td" style="font-size: 20.5px;">

                                            <span class="n-td-1 hot-list-p3-2" style="font-size: 18px;color: #054b5a;">&#8377;{{$res->mrp}}</span>

                                        </span> 

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @endif

                    </div>
                    <div class="col-md-12" style="display: flex;justify-content: center">
                            <div class="pagination">
                                {{ $resort->links() }}
                            </div>
                        </div>

                </div>

                <!--===== POST END ======-->

            </div>

        </div>

    </section>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#destinationFilter,#priceFilter, #popularFilter, #starRatingFilter').on('change', function() {
            $('#filterForm').submit();

        });
    });
</script>
 @endsection