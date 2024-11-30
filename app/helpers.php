<?php

use App\Models\PackageType;

use App\Models\Package;

use App\Models\Gallery;

use App\Models\Blog;





    function package()

    {

        $package=PackageType::where(['status'=>'1'])->limit(4)->get();

        

        return $package;

    }

    

    function corporatepackage()

    {

        $copackage=PackageType::select('package_name','slug')->where(['status'=>'1','slug'=>'corporate'])->first();

        return $copackage;

    }

    function homepackage()

    {

        $homepackage=Package::where(['in_home'=>'1'])->limit(6)->get();

        

        return $homepackage;

    }



    function gallery(){

        $gall=Gallery::limit(12)->get();

        

        return $gall;

    }



    function homeBlog()

    {

        $blog = Blog::orderBy('created_at', 'desc')->take(3)->get();

        return $blog;

    }

    function getState($id){
        $state_name=DB::table('states')->where(['id'=>$id])->first();
        return $state_name;

    }
    function getcity($id){
        $city_name=DB::table('cities')->where(['id'=>$id])->first();
        return $city_name;

    }

    function bannerimg(){
        $banner=DB::table('banners')->get();
        return $banner;
    }



?>