<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resort;
use App\Models\ResortImage;
use DB;

class ResortController extends Controller
{
    public function resort(Request $request)
    {
        $cityIds = Resort::distinct()->pluck('city');
        $location = DB::table('cities')->whereIn('id', $cityIds)->get();
        $resortQuery=Resort::query();
        $destination = $request->query('destination');
        if ($destination) {
            $resortQuery->where('city', $destination);
        }
    
        // Apply price range filter (if a price range is selected)
        $priceRange = $request->query('price_range');
        if ($priceRange) {
            // Filter for hotels with price <= selected price (e.g., <= 1500)
            $resortQuery->where('price', '<=', $priceRange);
        }

        $mealsPlan=$request->query('facilty');
        if ($mealsPlan) {
            $resortQuery->where('meals_plan', $mealsPlan);
        }
        // Apply star rating filter
        $starRating = $request->query('star_rating');
        if ($starRating) {
            $resortQuery->where('rating', $starRating);
        }
    
        // Fetch filtered hotels with pagination (10 hotels per page)
        $resort = $resortQuery->paginate(6);
        
        return view('front.resort',compact('resort','location'));
    }
    public function resortDetail($slug)
    {
        $resort=Resort::where(['slug'=>$slug])->first();
        $resortImage=ResortImage::where(['resort_id'=>$resort->id])->get();
        return view('front.resort-detail',compact('resort','resortImage'));
    }
}
