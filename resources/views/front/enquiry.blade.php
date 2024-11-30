@extends('layouts.front.app')


<style>
    section.top-footer {
        display: none;
    }
</style>


@section('content')


    <!--END HEADER SECTION-->
    <div class="video-container">
        <video autoplay muted loop class="background-video">
            <source src="{{asset('front/image/booking-back2.mp4')}}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

	
	<!--DASHBOARD-->
	<section>
		<div class="tr-register">
			<div class="tr-regi-form v2-search-form">
				<h4> Enquiry for <span>Booking</span></h4>
				<p>It's free and always will be.</p>
				<form id="contact_Form" action="{{route('enquiry/save')}}" method="post">
					@csrf
							<div class="alert alert-success contact__msg" style="display: none" role="alert">
								Thank you for arranging a wonderful trip for us! Our team will contact you shortly!
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input type="text"  class="validate" name="name" placeholder="Enter your name" >
									<span class="text-danger" id="name_error"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input type="number"  class="validate" name="phone" placeholder="Enter your phone" >
									<span class="text-danger" id="phone_error"></span>
								</div>
								<div class="input-field col s6">
									<input type="email"  class="validate" name="email" placeholder="Enter your email" >
									<span class="text-danger" id="email_error"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
                                    <select name="city" class="chosen-select">
                                        <option value=" " disabled selected>Destination</option>
										@if($uniqueLocations)
											@foreach($uniqueLocations as $index)
                                        		<option value="{{$index}}">{{$index}}</option>
											@endforeach
										@endif
                                       
                                    </select>
									<span class="text-danger" id="city_error"></span>
								</div>
								
								@if(request()->path() === 'hotel/enquiry')
									<!-- Display the enquiry selection field -->
									<div class="input-field col s12">
										<select name="enquiry" class="chosen-select">
											<option value=" " disabled selected>----Select ---</option>
											<option value="hotel">Hotel</option>
											<option value="resort">Resort</option>
										</select>
										<span class="text-danger" id="package_error"></span>
									</div>
								@else
									<!-- Display the package selection field -->
									<div class="input-field col s12">
										<select name="package" class="chosen-select">
											<option value=" " disabled selected>Select your package</option>
											@if($package) 
												@foreach($package as $pack)
													<option value="{{ $pack->id }}">{{ $pack->name }}</option>
												@endforeach
											@endif
										</select>
										<span class="text-danger" id="package_error"></span>
									</div>
								@endif
								
							</div>
							<div class="row">
								<div class="input-field col s6">
									<input type="text" id="from" name="arrival" placeholder="Arrival Date" class="datepicker">
									<span class="text-danger" id="arrival_error"></span>
								</div>

								<div class="input-field col s6">
									<input type="text" id="to" name="departure" placeholder="Departure Date" class="datepicker">
									<span class="text-danger" id="departure_error"></span>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s6">
									<select name="noofadults" class="chosen-select">
										<option value="" disabled selected>No of adults (Above 12 yrs)</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">7</option>
                                        <option value="6">8</option>
                                        <option value="6">9</option>
                                        <option value="6">10</option>
                                        <option value="6">10 - 20</option>
                                        <option value="6">20 - 30</option>
                                        <option value="6">30 - 50</option>
                                        <option value="6">50 and above</option>
									</select>

									<span class="text-danger" id="noofadults_error"></span>
								</div>
								<div class="input-field col s6">
									<select name="noofchildrens" class="chosen-select">
										<option value="" disabled selected>No of childrens (Between 5 to 12 yrs)</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">7</option>
                                        <option value="6">8</option>
                                        <option value="6">9</option>
                                        <option value="6">10</option>
                                        <option value="6">10 - 20</option>
                                        <option value="6">20 - 30</option>
                                        <option value="6">30 - 50</option>
                                        <option value="6">50 and above</option>					
									</select>
									<span class="text-danger" id="noofchildrens_error"></span>
								</div>
							</div>							

													
							<div class="row">
								<div class="input-field col s12">
									<input type="submit" value="Book Now" id="submitBtn" class="waves-effect waves-light tourz-sear-btn v2-ser-btn">
								</div>
							</div>
				</form>
			</div>
		</div>
	</section>
	<!--END DASHBOARD-->
	<script>
    $(document).on('submit', 'form#contact_Form', function(event) {
        event.preventDefault(); // Prevent default form submission
        // $('#loading').css('display', ''); // Show loading indicator (you can remove this line if not using loading indicator)
        
        var form = $(this);
        var data = new FormData(form[0]); // Gather form data
		
        var url = form.attr("action"); // Get form action URL
        // $('#submitBtn').prop('disabled', true); // Disable the button
        // $('#submitBtnSpinner').removeClass('d-none'); // Show spinner
        
        $.ajax({
            type: form.attr('method'), // POST method from form
            url: url, // URL for submission (must be specified in form's action attribute)
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                // $('#loading').css('display', 'none'); // Hide loading indicator
                if (response.success) {
                    toastr.success(response.message ); // Show success message (using Toastr for notifications)
                    window.setTimeout(function() {
                        window.location.href = "{{route('enquiry')}}"; 
                    },1000);
                }
                    // $('#submitBtn').prop('disabled', false); // Re-enable the button
                    // $('#submitBtnSpinner').addClass('d-none'); // Hide spinner
            },
            error: function(err) {
                // $('#loading').css('display', 'none'); // Hide loading indicator
                // setTimeout(function() {
                //             $('#submitBtn').prop('disabled', false); // Re-enable the button
                //             $('#submitBtnSpinner').addClass('d-none'); // Hide spinner
                //         }, 3000); // 3 seconds delay
                if (err.status === 422) { // Handle validation errors
                    $('#loading').css('display', 'none');
                    var error = $.parseJSON(err.responseText);
                    $.each(error.errors, function(key, val) {
                        $("#" + key + "_error").text(val); // Display validation errors next to inputs
                    });
                }
                
            }
        });

        return false; // Prevent further event handling
});
</script>
	@endsection