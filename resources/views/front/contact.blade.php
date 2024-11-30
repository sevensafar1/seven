@extends('layouts.front.app')





<style>

section.top-footer {

    visibility: hidden;

}

</style>



@section('content')





    <section class="contactuspagesec">

        <div class="container">

            <!-- TITLE & DESCRIPTION -->

            <div class="spe-title col-md-12 pt-5">

                <h2><span>Contact us</span></h2>

                <div class="title-line">

                    <div class="tl-1"></div>

                    <div class="tl-2"></div>

                    <div class="tl-3"></div>

                </div>

                <p>If you have any queries about our tour packages, hotel booking, adventure tour packages, or wildlife exploration packages, feel free to contact us! We have an expert team who will be happy to solve your query. </p>

            </div>



            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-6 col-sm-12 p-5">

                    <div class="contactform">

                        <form id="contact_Form" action="{{route('contact/save')}}" method="post">

                            @csrf

                            <input class="form-control mb-4" type="text" name="name" placeholder="Full Name"  />

                            <span class="text-danger" id="name_error"></span>

                            <input class="form-control mb-4" type="email" name="email" placeholder="Email Address" />

                            <span class="text-danger" id="email_error"></span>

                            <input class="form-control mb-4" type="number" name="phone" placeholder="Phone"  />

                            <span class="text-danger" id="phone_error"></span>

                            <div class="form-floating">

                                <textarea class="form-control mb-4" placeholder="Leave a comment here"

                                    style="height: 100px" name="comment" ></textarea>

                                <label for="floatingTextarea2">Comments</label>

                                <span class="text-danger" id="comment_error"></span>

                            </div>

                            

                            <button type="submit">Submit</button>

                        </form>

                    </div>

                </div>

                <!-- <div class="col-lg-2 col-md-2 col-sm-12 p-5 d-flex align-items-center">

                    <div>

                        <img class="w-100" src="image/QR_code.png">

                    </div>

                </div> -->

                <div class="col-lg-6 col-md-6 col-sm-12 p-5">

                    

                    <div class="d-flex py-2 text-center align-items-center">

                        <div class="contimgpage">

                            <img src="{{asset('public/front/image/pin.png')}}">

                        </div>

                        <div class="text-left conttextdivpage px-5">

                            <h5>Registered Office</h5>

                            <p>15/8, Block-15, Near Rishabh Battery Geeta Colony, East Delhi-110031</p>

                        </div>

                        <div class="text-left conttextdivpage px-5">

                            <h5>Corporate Office</h5>

                            <p>Office no 6, 3rd Floor H-72 Sector 63 Noida-201301</p>

                        </div>

                    </div>

                    <div class="d-flex py-2 text-center align-items-center">

                        <div class="contimgpage">

                            <img src="{{asset('public/front/image/mail.png')}}">

                        </div>

                        <div class="text-left conttextdivpage px-5">

                            <h5>Email</h5>

                            <p><a href="mailto:info@sevensafar.com">info@sevensafar.com</a></p>

                        </div>

                        <div class="contimgpage">

                            <img src="{{asset('public/front/image/phone-call.png')}}">

                        </div>

                        <div class="text-left conttextdivpage px-5">

                            <h5>Phone</h5>

                            <p><a href="tel:9818054830">9818054830</a>, <a href="tel:9818055980">9818055980</a></p>

                        </div>

                    </div>

                    <!-- <div class="d-flex py-2 text-center align-items-center">

                        <div class="contimgpage">

                            <img src="image/phone-call.png">

                        </div>

                        <div class="text-left conttextdivpage px-5">

                            <h5>Phone</h5>

                            <p><a href="tel:8769784327">8769784327</a></p>

                        </div>

                    </div> -->



                    <div class="text-center">

                        <img class="w-25 " src="{{asset('public/front/image/QR_code.png')}}">

                    </div>

                </div>

            </div>

        </div>

    </section>

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

                        window.location.href = "{{route('contact')}}"; 

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