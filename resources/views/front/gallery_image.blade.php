@extends('layouts.front.app')

@section('content')

<section class="gallery-section pb-5 mb-5">
    <div class="container">
        <div class="row">
            @if($galle)
                @php  
                    // Decode the JSON string into an array of images
                    $images = json_decode($galle->image, true); 
                @endphp

                @if (!empty($images) && is_array($images))
                    @foreach($images as $image)
                        <div class="col-lg-4 col-md-4 col-sm-12 p-4">
                            <div class="galleryimg">
                                <!-- Display each image -->
                                <img src="{{ asset('public/images/gallery/' . trim($image)) }}" alt="{{ $galle->alt }}" style="width: 100%; height: auto;">

                               
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No images available</p>
                @endif
            @endif
        </div>
    </div>
</section>

@endsection
