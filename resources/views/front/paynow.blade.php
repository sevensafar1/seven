



@extends('layouts.front.app')



<style>



    .db-2 {

        width: 100% !important;

        margin-right: 0px;

    }

    .db2-form-com form select {

    border: 1px solid rgb(228, 228, 228);

    height: 45px;

    padding: 0px 25px;

    background: rgb(255, 255, 255);

}

.db2-form-com form input[type="submit"] {

    /* padding: 0px; */

    background: #014c59 !important;

    /* background: linear-gradient(39deg, rgb(68, 68, 189), rgb(3, 158, 249) 80%) 0% 0% / 100% 100% rgb(37, 111, 218); */

    color: rgb(255, 255, 255);

    padding: 0px 20px !important;

    font-size: 16px !important;

}

.db-2-com h2 {

    margin: 0px;

    background: rgb(37, 61, 82);

    padding: 15px;

    color: rgb(255, 255, 255);

}



</style>



@section('content')



	

	<!--DASHBOARD-->

	<section>

		<div class="db">

		

			<!--CENTER SECTION-->

			<div class="db-2">

				<div class="db-2-com db-2-main">

					<h2>Enter Payment Details </h2>

					<div class="db-2-main-com db2-form-pay db2-form-com">

						<div class="db-pay-card">

							<!-- <h5>Accepted Card Types</h5></div> -->

						<form action="{{route('payment_success')}}" method="POST" id="payment-form">

                        @csrf

                            <div class="row">

								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Enter Amount</label>

									<input type="number" class="validate" id="amount" name="amount" placeholder="Enter Amount">

								</div>

								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Enter Name</label>

									<input type="text" class="validate" id="pay" name="name" placeholder="Enter Name">

								</div>

							</div>

                            <div class="row">

								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Enter Email Address</label>

									<input type="email" class="validate" id="email" name="email" placeholder="Enter Email Address">

								</div>



								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Enter Mobile Number</label>

									<input type="number" name="mobile" id="mobile" class="validate" placeholder="Enter Mobile Number">

								</div>

							</div>

                            <div class="row">

								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Enter Postal Code</label>

									<input type="number" class="validate" name="pin_code" placeholder="Enter Postal Code">

								</div>

								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Country</label>

                                    <select id="country-dropdown" name="country">

                                        <option value="">Select Country</option>

                                    </select>

                                </div>

							</div>

                            

                            

                            <div class="row">

                            <div class="input-field col-md-6 col-sm-12 m6">

									<!-- <input type="number" class="validate" placeholder="Payment For"> -->

                                    <label>Payment For</label>

                                    <select name="payment_for">

                                        <option>Payment For</option>

                                        <option>Safari</option>

                                        <option>Hotel</option>

                                        <option>Tour Package</option>

                                        <option>Car</option>

                                    </select>

								</div>

								<div class="input-field col-md-6 col-sm-12 m6">

                                    <label>Package Details</label>

									<input type="text" class="validate" name="package_detail" placeholder="Package Details">

								</div>

							</div>

                            <div class="row justify-content-end">

                                    <div class="col-md-3 col-sm-12 text-end">

                                        <input type="submit" id="custom-razorpay-button" value="Continue Payment">

                                    </div>

                            </div>

						</form>

					</div>

				</div>

			</div>



		</div>

	</section>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

    $(document).ready(function () {

        // URL of the REST Countries API

        var apiUrl = "https://restcountries.com/v3.1/all";

        console.log("Razorpay Key: {{ env('RAZORPAY_KEY') }}");

        // Make an AJAX call to the API

        $.ajax({

            url: apiUrl,

            method: 'GET',

            success: function (data) {

                var countryDropdown = $('#country-dropdown');

                

                // Loop through the response and add each country to the dropdown

                data.forEach(function (country) {

                    var countryName = country.name.common;

                    countryDropdown.append('<option value="' + countryName + '">' + countryName + '</option>');

                });

            },

            error: function () {

                console.error("Error fetching country data.");

            }

        });

    });

    document.addEventListener('DOMContentLoaded', function () {



        document.getElementById('custom-razorpay-button').addEventListener('click', function (e) {
    e.preventDefault();

    var form = document.getElementById('payment-form');

    // Check if the form is valid
    if (!form.checkValidity()) {
        form.reportValidity(); // This will display validation messages if fields are invalid
        return; // Stop the function if form is invalid
    }

    var selectedCountry = document.getElementById('country-dropdown').value;
    var amount = document.getElementById('amount').value;
    var finalAmount;

    // Convert amount to paise only if the selected country is India
    if (selectedCountry === 'India') {
        finalAmount = amount * 100; // Convert to paise for India
    } else {
        finalAmount = amount; // Use the entered amount directly for other countries
        // Note: Ensure you handle currency conversion if necessary for other countries
    }

    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}", // Add your Razorpay API Key here
        "amount": finalAmount, // Amount in paise
        "name": "Seven Safar tours & Travels",
        "description": "Payment",
        "image": "https://www.itsolutionstuff.com/frontTheme/images/logo.png",
        "handler": function (response) {
            var form = document.getElementById('payment-form');
            form.action = "{{ route('payment_success') }}"; // Redirect to payment success route
            form.appendChild(createHiddenInput("razorpay_payment_id", response.razorpay_payment_id)); // Append Razorpay payment ID to form
            form.submit(); // Submit the form
        },
        "prefill": {
            "name": document.getElementById('pay').value, // Prefill name
            "email": document.getElementById('email').value, // Prefill email
            "contact": document.getElementById('mobile').value // Prefill mobile
        },
        "theme": {
            "color": "#ff7529" // Customize the Razorpay theme color
        }
    };

    var rzp = new Razorpay(options);
    rzp.open(); // Open Razorpay modal
});







function createHiddenInput(name, value) {



    var input = document.createElement('input');



    input.type = 'hidden';



    input.name = name;



    input.value = value;



    return input;



}



});



</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>



    // Check for session flash messages



    @if (session('confirmMsg'))



        Swal.fire({



            title: 'Success!',



            text: '{{ session('confirmMsg') }}',



            icon: 'success',



            confirmButtonText: 'OK'



        }).then(() => {



            {{ Session::forget('confirmMsg') }}  // Clear the message



        });



    @elseif (session('errMsg'))



        Swal.fire({



            title: 'Error!',



            text: '{{ session('errMsg') }}',



            icon: 'error',



            confirmButtonText: 'OK'



        }).then(() => {



            {{ Session::forget('errMsg') }}  // Clear the message



        });



    @endif



</script>



	@endsection