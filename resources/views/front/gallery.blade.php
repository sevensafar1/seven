@extends('layouts.front.app')



@section('content')





<section class="gallery-section pb-5 mb-5">

        <div class="container">

            <div class="spe-title">

                <h2>Our <span>gallery</span></h2>

                <div class="title-line">

                    <div class="tl-1"></div>

                    <div class="tl-2"></div>

                    <div class="tl-3"></div>

                </div>

            </div>

            <div class="row">

            @php $gallery = gallery(); @endphp

        @if($gallery)
            @foreach($gallery as $gall)
                @php
                    // Decode the JSON string into a PHP array
                    $images = json_decode($gall->image, true);
                @endphp

                <div class="col-lg-4 col-md-4 col-sm-12 p-4">
                    <div class="galleryimg">
                        @if (!empty($images) && is_array($images) && isset($images[0]))
                            <img src="{{ asset('public/images/gallery/' . trim($images[0], '"')) }}" alt="{{ $gall->alt }}">
                        @else
                            <span>No image available</span> <!-- Fallback if no images exist -->
                        @endif
                        <a href="{{route('gallery/image',$gall->slug)}}">
                        <div class="overlay">
                            <div>
                                <h3>{{ $gall->title }}</h3>
                                <p>{{ $gall->location }}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

            </div>

            

        </div>

    </section>









@endsection