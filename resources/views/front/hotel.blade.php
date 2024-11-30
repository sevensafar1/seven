@extends('layouts.front.app')

@section('content')


<style type="text/css">
    .filter-div .filter-price {
    width: 100%;
}
.filter-div .price-field input[type=range] {
    width: 240px;
}
.hot-page2-alp-ri-p2 p {
    color: #626262;
    margin-bottom: 0px;
    text-transform: unset;
    font-size: 12px;
}
.hotelslistdet i {
    color: #f27242ad;
}
.hot-page2-alp-ri-p3 {
    padding: 10px 0px 10px;
}
.hot-page2-alp-con {
    position: relative;
    overflow: hidden;
    background: rgb(242 241 241 / 0%);
    box-shadow: rgb(0 0 0 / 25%) 0px 4px 30px;
}
 
.row.filter-div {
    background: #effcff;
    position: sticky;
    top: 70px;
    padding: 10px;
    box-shadow: 0px 0px 4px 0px #dedede;
    z-index: 9;
}
 
.hot-page2-alp-r-list {
    border: 1px solid rgb(222, 222, 222);
    background: rgb(239 252 255);
    position: relative;
    overflow: hidden;
    margin: 20px 25px 20px 15px;
    transition: all 0.5s 0s;
}
 
.hot-page2-hom-pre {
    position: relative;
    overflow: hidden;
    background: rgb(239 252 255);
    padding: 15px;
    border: 1px solid rgb(231, 231, 231);
    margin-bottom: 30px;
    border-radius: 0px 0px 10px 10px;
}
.filter-div label {
    display: inline-block;
    font-size: 16px;
    font-weight: 500;
    color: #05495d;
}
 

</style>





<section class="hot-page2-alp hot-page2-pa-sp-top all-hot-bg pb-5">
    <div class="container">
        <div class="row inner_banner inner_banner_3 bg-none">
            <div class="hot-page2-alp-tit">
                <h1>Hotels</h1>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"></div>
                    <div class="tl-3"></div>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <form id="filterForm" method="GET" action="{{ route('hotels') }}">
            <div class="row filter-div">
                <!-- Destination Filter -->
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
                        <label>Your Hotels</label>
                        <select class="chosen-select" name="star_rating" id="starRatingFilter">
                            <option value="">Top Hotels</option>
                            <option value="5" {{ request('star_rating') == '5' ? 'selected' : '' }}>5 Stars hotels</option>
                            <option value="4" {{ request('star_rating') == '4' ? 'selected' : '' }}>4 Stars hotels</option>
                            <option value="3" {{ request('star_rating') == '3' ? 'selected' : '' }}>3 Star Hotels</option>
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

                <!-- Submit Button for Filtering -->
               <!--  <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div> -->
            </div>
        </form>

        <!-- Suggested Hotels Section -->
        <div class="row">
            <div class="hot-page2-alp-con py-5 p-0">
                <!-- Left Sidebar -->
                <div class="col-md-3 hot-page2-alp-con-left">
                    <div class="hot-page2-alp-con-left-1">
                        <h3>Suggesting Hotels</h3>
                    </div>
                    <div class="hot-page2-hom-pre hot-page2-alp-left-ner-notb">
                        <ul>
                            @if($suggestedhotel && !$suggestedhotel->isEmpty())
                                @foreach($suggestedhotel as $hotel)
                                    @php $image = $hotel->images()->orderBy('id', 'asc')->first(); 
                                    $city=getcity($hotel->city);
                                    @endphp
                                    <li>
                                        <a href="{{ route('hotel.detail', $hotel->slug) }}">
                                            <div class="hot-page2-hom-pre-1 hot-page2-alp-cl-1-1"> 
                                                <img src="{{ $image ? asset('public/images/hotels/' . $image->images) : asset('public/images/hotels/default.jpg')}}" alt="{{ $hotel->name }}"> 
                                            </div>
                                            <div class="hot-page2-hom-pre-2 hot-page2-alp-cl-1-2">
                                                <h5>{{ $hotel->name }}</h5>
                                                <span>City: {{ $city ? $city->city : 'N/A' }}</span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <span>Not Available</span>
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Right Listings -->
                <div class="col-md-9 hot-page2-alp-con-right">
                    <div class="hot-page2-alp-con-right-1 px-5">
                        <div class="row">
                            
                            @if($hotels)
                                @foreach($hotels as $data)
                             
                                    <div class="hot-page2-alp-r-list d-flex align-items-center hotelstar p-2">
                                        <div class="col-md-3 hot-page2-alp-r-list-re-sp">
                                            <a href="{{ route('hotel.detail', $data->slug) }}">
                                                <div class="hot-page2-hli-1" style="height: 200px;"> 
                                                    <img src="{{ $data->images()->first() ? asset('public/images/hotels/' . $data->images()->first()->images) : asset('public/images/hotels/default.jpg')}}" alt="{{ $data->name }}"> 
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="hot-page2-alp-ri-p2">
                                                <p></p>
                                                <a href="{{ route('hotel.detail', $data->slug) }}">
                                                    <h3>{{ $data->name }}</h3>
                                                </a>
                                                @php
                                                    $amenities = json_decode($hotel->amenities); // Assuming amenities is a JSON string
                                                    $amenities = array_slice($amenities, 0, 3); // Get first three amenities
                                                @endphp
                                                <div class="hotelslistdet">
                                                    
                                                    <p><i class="fa fa-flag" aria-hidden="true"></i> {{$data->distance}}</p>
                                                    <p style="font-size: 12px;"><b>Room In A Homestay</b> | 1 Bedroom | Sleeps 2 Guests</p>
                                                    <p>
                                                    @foreach($amenities as $amenity)
                                                        <span style="font-size:12px;">
                                                            <i class="fa fa-check" aria-hidden="true"></i> {{ $amenity }}
                                                        </span>
                                                        &nbsp;&nbsp;
                                                    @endforeach
                                                    </p>


                                               @php  $city=getcity($data->city); @endphp
                                                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $city ? $city->city : 'N/A' }}</p>
                                                    <!-- <p><i class="fa fa-phone" aria-hidden="true"></i> {{ $data->phone }}</p> -->

                                                    <p>{{$data->hotel_tags}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="hot-page2-alp-ri-p3 text-end">
                                                <label for="chp61">
                                                    <span class="ho-hot-rat-star-list">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa {{ $i <= $data->rating ? 'fa-star' : 'fa-star-o' }}" aria-hidden="true"></i>
                                                        @endfor
                                                    </span>
                                                </label>
                                                <h4 class="hot-list-p3-2" style="padding: 0px 0;font-size: 25px; text-align:end;">&#8377;{{ $data->price }}</h4>
                                                <p style="font-size: 14px; color: #626262;">Per Night</p>
                                                <span class="hot-list-p3-4">
                                                    <a href="{{ route('hotel.enquiry') }}" class="hot-page2-alp-quot-btn">Enquiry</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-12" style="display: flex;justify-content: center">
                            <div class="pagination">
                                {{ $hotels->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
