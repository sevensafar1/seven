@extends('layouts.front.app')



@section('content')





    <section>

		<div class="rows inner_banner inner_banner_2">

			<div class="container">

				<div class="spe-title tit-inn-pg">

					<h1><span>Package</span> </h1>

                    <div class="title-line">

						<div class="tl-1"></div>

						<div class="tl-2"></div>

						<div class="tl-3"></div>

					</div>

				</div>

			</div>

		</div>

	</section>



    <section class="package-section pb-5 mb-5 pt-5">

        <div class="container">

            <div class="spe-title">

                <h2><span>{{$packtype->package_name}}</span></h2>

                <div class="title-line">

                    <div class="tl-1"></div>

                    <div class="tl-2"></div>

                    <div class="tl-3"></div>

                </div>

            </div>

            <div class="row">

                @if($package)

                    @foreach($package as $data)

                    <div class="col-lg-4 col-md-4 col-sm-12 p-4">

                        <div class="packageimg">

                        @php

                            // Fetch the first image for the current package

                            $image = $data->images()->orderBy('id', 'asc')->first();

                        @endphp
                        @if($image)
                            <img src="{{ asset('public/images/packages/' . $image->images) }}" alt="{{ $data->name }}">
                        @else
                            <img src="{{ asset('public/images/packages/default_image.jpg') }}" alt="{{ $data->name }}">
                        @endif


                            <div class="overlay">

                                <div class="packdetail">

                                    <h3>{{$data->name}}</h3>

                                    <p>({{$data->nights}} Nights / {{$data->days}} Days)</p>
                                    <a href="{{ route('package.details', $data->slug) }}"><button >View Details</button></a>

                                    <a href="{{route('enquiry')}}"><button>Enquiry</button></a>

                                    

                                </div>

                            </div>

                        </div>

                    </div>

                    @endforeach

                @endif



            </div>



        </div>

    </section>

    



    @endsection