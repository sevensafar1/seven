<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelImage;
use DB;

class HotelController extends Controller
{
    public function hotels(Request $request)
    {
        // Suggested hotels
        $suggestedhotel = Hotel::where('suggested_hotel', '1')->get();
    
        // Unique locations based on city IDs present in hotels
        $cityIds = Hotel::distinct()->pluck('city');
        $location = DB::table('cities')->whereIn('id', $cityIds)->get();
    
        // Initialize a query for hotels
        $hotelsQuery = Hotel::query();
    
        // Filter by destination (city)
        $destination = $request->query('destination');
        if ($destination) {
            $hotelsQuery->where('city', $destination);
        }
    
        // Apply price range filter (if a price range is selected)
        $priceRange = $request->query('price_range');
        if ($priceRange) {
            // Filter for hotels with price <= selected price (e.g., <= 1500)
            $hotelsQuery->where('price', '<=', $priceRange);
        }

        $mealsPlan=$request->query('facilty');
        if ($mealsPlan) {
            $hotelsQuery->where('meals_plan', $mealsPlan);
        }
        // Apply star rating filter
        $starRating = $request->query('star_rating');
        if ($starRating) {
            $hotelsQuery->where('rating', $starRating);
        }
    
        // Fetch filtered hotels with pagination (10 hotels per page)
        $hotels = $hotelsQuery->paginate(4);
        
        return view('front.hotel', compact('hotels', 'suggestedhotel', 'location'));
    }
    

    public function hotelDetail($slug)
    {
       // Fetch the hotel by slug
    $hotel = Hotel::where('slug', $slug)->first();

    // Check if the hotel exists
    if (!$hotel) {
        // If no hotel is found, handle the error. You can redirect or show a 404 page
        return abort(404, 'Hotel not found');
    }

    // Fetch hotel images and top hotels only if the hotel exists
    $hotelImage = HotelImage::where('hotel_id', $hotel->id)->get();
    $tophotel = Hotel::where('popular', '1')->take(4)->get();

    return view('front.hotel-details', compact('hotel', 'hotelImage', 'tophotel'));

    }

}
