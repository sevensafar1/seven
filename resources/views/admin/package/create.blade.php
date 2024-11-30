@extends('layouts.admin.app') 

<style>

    .addbtndes

    {

        background-color: #178750 !important;

        border: none !important;

        border-radius: 50% !important;

        padding: 7px 15px !important;  

    }

    .minusbtndes

    {

        background-color: #ee1010 !important;

        border: none !important;

        border-radius: 50% !important;

        padding: 9px 19px !important;

        margin-left: 11px;

    }

</style>





@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">

        <div class="col-sm-12 col-xl-12">

            <div class="bg-light rounded h-100 p-4">

                <h6 class="mb-4">Package</h6>

                <form id="packageForm" action="{{ route('package/save') }}" method="POST" enctype="multipart/form-data">

                @csrf 

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Package Title</label>

                        <input type="text" class="form-control" id="name" name="title" >

                        <span class="text-danger" id="title_error"></span>

                    </div>   

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Package Name</label>

                        <input type="text" class="form-control" id="name" name="name" >

                        <span class="text-danger" id="name_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="images" class="form-label">Images</label>

                        <input type="file" class="form-control" id="images" name="images[]" multiple >

                        <span class="text-danger" id="images_error"></span>

                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                        <span class="text-danger" id="banner_image_error"></span>
                    </div>
                    <div id="bannerImagePreviewContainer" class="mt-2 d-flex flex-wrap"></div>

                    <!-- Arrival Date -->

                    <div class="mb-3">

                        <label for="arrival_date" class="form-label">Arrival Date</label>

                        <input type="date" class="form-control" id="arrival_date" name="arrival_date"  >

                        <span class="text-danger" id="arrival_date_error"></span>

                    </div>



                    <!-- Departure Date -->

                    <div class="mb-3">

                        <label for="departure_date" class="form-label">Departure Date</label>

                        <input type="date" class="form-control" id="departure_date" name="departure_date" >

                        <span class="text-danger" id="departure_date_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="amount" class="form-label">Price</label>

                        <input type="number" step="0.01" class="form-control" id="price" name="price" >

                        <span class="text-danger" id="price_error"></span>

                    </div>

                     <!-- Amount -->

                    <div class="mb-3">

                        <label for="amount" class="form-label">Amount</label>

                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" >

                        <span class="text-danger" id="amount_error"></span>

                    </div>



                    <!-- Days -->

                    <div class="mb-3">

                        <label for="days" class="form-label">Days</label>

                        <input type="number" class="form-control" id="days" name="days" >

                        <span class="text-danger" id="days_error"></span>

                    </div>



                    <!-- Nights -->

                    <div class="mb-3">

                        <label for="nights" class="form-label">Nights</label>

                        <input type="number" class="form-control" id="nights" name="nights" >

                        <span class="text-danger" id="nights_error"></span>

                    </div>



                    <!-- Location -->

                    <div class="mb-3">

                        <label for="location" class="form-label">Location</label>

                        <input type="text" class="form-control" id="location" name="location" >

                        <span class="text-danger" id="location_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="productDescription" class="form-label">Description</label>

                        <textarea id="productDescription" name="description"></textarea>

                        <span class="text-danger" id="description_error"></span>

                    </div>

                     <!-- About Tour (Array) -->

                     <div class="mb-3">

                        <label for="about_tour" class="form-label">About Tour</label><br>

                        <div id="aboutTourContainer">

                            <!-- Initial Tour Row -->

                            <div class="row mb-3 about-tour-item">

                                <div class="col">

                                    <input type="text" class="form-control mb-1" name="place[]" placeholder="Place covered">

                                </div>

                                <div class="col">

                                    <input type="text" class="form-control mb-1" name="inclusions[]" placeholder="Inclusions">

                                </div>

                                <div class="col">

                                    <input type="text" class="form-control mb-1" name="exclusions[]" placeholder="Exclusions">

                                </div>

                                <div class="col d-flex align-items-center">

                                    <input type="text" class="form-control mb-1" name="event_date[]" placeholder="Resort Amenities">

                                    <!-- Add Button -->

                                    <a href="JavaScript:void(0)" class="btn btn-primary ms-2" id="addMoreTour">+</a>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="mb-3">

                        <label for="tour_description" class="form-label">Tour Description</label><br>

                        <div id="tourDescriptionContainer">

                            <div id="">

                                <!-- Initial Tour Description Section -->

                                <div class="tour-description-item">

                                    <input type="text" class="form-control mb-1" name="tourtitle[]" placeholder="Tour Title"  />

                                    <textarea class="form-control mb-3" id="tour_description" name="tour_description[]" rows="3" placeholder="Enter tour descriptions, one per line" ></textarea>

                                </div>

                            </div>



                            <!-- Add Button outside of the container -->

                            <a href="JavaScript:void(0)" class="btn btn-primary ms-2" id="addMoreDescription">+</a>

                        </div>

                    </div>



                    <!-- Package Type -->

                    <div class="mb-3">

                        <label for="package_type" class="form-label">Package Type</label>

                        <select class="form-select" id="package_type" name="package_type" >

                        <option value="">----- Select type ------- </option>

                            @if($packageType)

                                @foreach($packageType as $type)

                                    <option value="{{$type->id}}">{{$type->package_name}} </option>

                                @endforeach

                            @endif

                            

                        </select>

                    </div>
                    
                    <div class="mb-3">

                        <label for="home_package" class="form-label">Home Package</label>

                        <select class="form-select" id="home_package" name="home_package" >

                        <option value="">----- Select type ------- </option>

                            <option value="1">In Home</option>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>

        </div>

    </div>

</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<script>

    $(document).ready(function() {

            $('#productDescription').summernote({

                height: 200, // Set the height of the editor

                placeholder: 'Enter product description here...'

            });

            $('#addMoreTour').on('click', function () {

                var newSection ='<div class="row mb-3 about-tour-item"><div class="col"><input type="text" class="form-control mb-1" name="place[]" placeholder="Place covered"></div><div class="col"><input type="text" class="form-control mb-1" name="inclusions[]" placeholder="Inclusions"></div><div class="col"><input type="text" class="form-control mb-1" name="exclusions[]" placeholder="Exclusions"></div><div class="col d-flex align-items-center"><input type="text" class="form-control mb-1" name="event_date[]" placeholder="Event Date"><a href="JavaScript:void(0)" class="btn btn-danger ms-2 removeTourSection">-</a></div></div>';



                // Append the new section to the aboutTourContainer

                $('#aboutTourContainer').append(newSection);

            });

            $(document).on('click', '.removeTourSection', function () {

                // Remove the specific about-tour-item that the button is within

                $(this).closest('.about-tour-item').remove();

            });

            $('#addMoreDescription').on('click', function () {

            var newDescription = `

                <div class="tour-description-item mt-3">

                    <input type="text" class="form-control mb-1" name="tourtitle[]" placeholder="Tour Title" required />

                    <textarea class="form-control mb-3" name="tour_description[]" rows="3" placeholder="Enter tour descriptions, one per line" required></textarea>

                    <a href="JavaScript:void(0)" class="btn btn-danger removeDescription">-</a>

                </div>

            `;



            // Append the new description section before the "Add" button (after the last description item)

            $('#tourDescriptionContainer').append(newDescription);

        });

        $(document).on('click', '.removeDescription', function () {

            $(this).closest('.tour-description-item').remove();

        });

        $(document).on('submit', '#packageForm', function(event) {

            event.preventDefault(); // Prevent default form submission

            $('#loading').css('display', ''); // Show loading indicator

            $('#submitBtn').prop('disabled', true); // Disable the submit button

            $('#submitBtnSpinner').removeClass('d-none'); // Show spinner



            var form = $(this);

            var data = new FormData(form[0]); // Gather form data

            var url = form.attr("action"); // Get form action URL



            $.ajax({

                type: 'POST', // Use POST method

                url: url, // URL for submission

                data: data,

                cache: false,

                contentType: false,

                processData: false,

                success: function(response) {

                    $('#loading').css('display', 'none'); // Hide loading indicator

                    toastr.success(response.message); // Show success message

                    window.setTimeout(function() {

                        window.location.href = "{{ route('package/list') }}"; // Redirect after 1 second

                    }, 1000);

                },

                error: function(err) {

                    $('#loading').css('display', 'none'); // Hide loading indicator

                    $('#submitBtn').prop('disabled', false); // Re-enable the submit button

                    $('#submitBtnSpinner').addClass('d-none'); // Hide spinner

                    

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
        $('#banner_image').on('change', function(event) {
        const file = event.target.files[0];
        const bannerPreviewContainer = $('#bannerImagePreviewContainer');
        bannerPreviewContainer.empty(); // Clear previous previews

        if (file) {
            const reader = new FileReader();

            // Create a preview for the selected file
            reader.onload = function(e) {
                const bannerImagePreview = `
                    <div class="image-preview d-flex align-items-center mb-2 position-relative">
                        <img src="${e.target.result}" alt="Banner Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">
                    </div>
                `;
                bannerPreviewContainer.append(bannerImagePreview); // Append the new preview
            };

            reader.readAsDataURL(file);
        }
    });



});

</script>

@endsection