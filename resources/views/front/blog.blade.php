@extends('layouts.front.app')



@section('content')



    <!--====== BANNER ==========-->

    <section>

        <div class="rows inner_banner inner_banner_1">

            <div class="container">

                <div class="spe-title tit-inn-pg">

                    <h1> <span>Blog</span> </h1>

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

    <section>

        <div class="rows inn-page-bg com-colo">

            <div class="container inn-page-con-bg tb-space pad-bot-redu-5" id="inner-page-title">

                <!--===== POSTS ======-->

                <div class="rows">

                   

                    <div class="posts">

                    @if($blogs)

                    @foreach($blogs as $blog)

                    <div class="col-md-4 col-sm-6 col-xs-12 my-3">

                        <img src="{{ asset('public/images/Blog/' . $blog->image) }}" 

                        alt="{{ pathinfo($blog->image, PATHINFO_FILENAME) }}">

                            <div class="bloglist-text">

                                <h2>{{$blog->title}}</h2>

                                <!-- <h5>

                                    <span class="post_author">Author: Johnson</span>

                                    <span class="post_date">Date: 12thMay,2016</span>

                                    <span class="post_city">City: Illunois</span></h5> -->

                                    {!! Str::words($blog->description, 15, '...') !!}<br>

                                <a href="{{route('blog/detail', $blog->slug)}}" class="link-btn">Read more</a>

                            </div>

                            

                        </div>

                        @endforeach

                        @endif

                        

                       

                    





                    </div>

                </div>

                <!--===== POST END ======-->

            </div>

        </div>

    </section>







@endsection