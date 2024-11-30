<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PackageType;
use App\Models\Package;
use App\Models\PackageImage;
use App\Models\Blog;
use App\Models\Gallery;

class HomeController extends Controller
{
    //

    public function index(){
        return view('front.home');
    }
    public function aboutUs()
    {
        return view('front.about');
    }
    public function tourPackage($slug)
    {
        
        $packtype=PackageType::select('id','package_name')->where(['slug'=>$slug])->first();
        $package=Package::where(['package_type'=>$packtype->id])->get();
       
        return view('front.package',compact('package','packtype')); 
    }
    public function corporatePackage($slug)
    {
        
        $packtype=PackageType::select('id','package_name')->where(['slug'=>$slug])->first();
       
        $package=Package::where(['package_type'=>$packtype->id])->get();

        return view('front.corporate',compact('package','packtype'));
    }
    public function enquiry()
    {
        $package=Package::get();
        $uniqueLocations = Package::distinct()->pluck('location')->toArray();
        return view('front.enquiry',compact('package','uniqueLocations'));
    }
    public function packageDetails($slug)
    {
        $package=Package::where(['slug'=>$slug])->first();
        $popularpackage=Package::take(3)->get();
        $packageImage=PackageImage::where(['package_id'=>$package->id])->get();

        return view('front.package-details',compact('package','packageImage','popularpackage'));
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function testimonial()
    {
        return view('front.testimonials');
    }
    public function gallery()
    {
        $gallery=Gallery::get();
        return view('front.gallery',compact('gallery'));
    }
    public function imageGallery($id)
    {
        $galle=Gallery::where(['slug'=>$id])->first();
        return view('front.gallery_image',compact('galle'));
        
    }
    public function blog()
    {
        $blogs=Blog::where(['status'=>'1'])->get();
        return view('front.blog',compact('blogs'));
    }
    public function blogDetail($slug)
    {
        // dd($slug);
        $blogdetail=Blog::where(['slug'=>$slug,'status'=>"1"])->first();
        return view('front.blog-detail',compact('blogdetail'));
    }
    public function termsConditions()
    {
        return view('front.termsconditions');
    }
    public function payment()
    {
        return view('front.paynow');
    }
    public function privacy()
    {
        return view('front.privacy');
    }

}
