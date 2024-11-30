@extends('layouts.front.app')



@section('content')







	<!--====== ALL POST ==========-->

	<section>

		<div class="inn-page-bg com-colo">

			<div class="container inn-page-con-bg" id="inner-page-title">

				<!--===== POSTS ======-->

				<div class="rows">

					<div class="posts">

						<div class="col-md-12 col-sm-12 col-xs-12"> 

						<img src="{{ asset('public/images/Blog/' . $blogdetail->image) }}" alt="{{ pathinfo($blogdetail->image, PATHINFO_FILENAME) }}">

						 </div>

						<div class="col-md-12 col-sm-12 col-xs-12 pt-5">

							<h1>{{$blogdetail->title}}</h1>

							<!-- <h5><span class="post_author">Author: Johnson</span><span class="post_date">Date: 12th May,2024</span><span class="post_city">City: Noida</span></h5> -->

							<!-- <div class="post-btn">

								<ul>

									<li><a href="#"><i class="fa fa-facebook fb1"></i> Share On Facebook</a>

									</li>

									<li><a href="#"><i class="fa fa-twitter tw1"></i> Share On Twitter</a>

									</li>

									<li><a href="#"><i class="fa fa-google-plus gp1"></i> Share On Google Plus</a>

									</li>

								</ul>

							</div>							 -->

							{!!$blogdetail->description	!!}

					</div>

				</div>

				<!--===== POST END ======-->

			</div>

		</div>

	</section>







@endsection