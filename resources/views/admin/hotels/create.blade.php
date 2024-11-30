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

    .remove-image

    {

        position: absolute;

        top: -8%;

        left: 68%;

        border-radius: 50% !important;

        padding: 2px 10px !important;

    }

</style>





@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">

        <div class="col-sm-12 col-xl-12">

            <div class="bg-light rounded h-100 p-4">

                <h6 class="mb-4">Hotel</h6>

                <form id="hotelForm" action="{{route('hotel/save')}}" method="POST" enctype="multipart/form-data">

                @csrf    

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="exampleInputEmail1" class="form-label">Hotel Name</label>

                            <input type="text" class="form-control" id="name" name="name" >

                            <span class="text-danger" id="name_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="location" class="form-label">Address</label>

                            <input type="text" class="form-control" id="location" name="address" >

                            <span class="text-danger" id="address_error"></span>

                        </div>

                        

                    </div>

                   

                    

                    <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="state" class="form-label">State</label>
                        <select class="form-select" id="state" name="state" >
                            <option value="">Select State</option>
                            <!-- State options will be dynamically populated here -->
                        </select>
                        <span class="text-danger" id="state_error"></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" id="city" name="city">
                            <option value="">Select City</option>
                            <!-- City options will be dynamically populated here -->
                        </select>
                        <span class="text-danger" id="city_error"></span>
                    </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="phone" class="form-label">Phone</label>

                            <input type="text" class="form-control" id="phone" name="phone" >

                            <span class="text-danger" id="phone_error"></span>

                        </div>

                        <!-- Amount -->

                        <div class="col-md-6 mb-3">

                            <label for="mrp" class="form-label">Mrp</label>

                            <input type="number"  class="form-control" id="mrp" name="mrp" >

                            <span class="text-danger" id="mrp_error"></span>

                        </div>

                    </div>

                    

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="price" class="form-label">Price</label>

                            <input type="number"  class="form-control" id="price" name="price" >

                            <span class="text-danger" id="price_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="rating" class="form-label">rating</label>

                            <input type="number"  class="form-control" id="rating" name="rating" >

                            <span class="text-danger" id="rating_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="duration" class="form-label">Duration</label>

                            <input type="text"  class="form-control" id="duration" name="duration" >

                            <span class="text-danger" id="duration_error"></span>

                        </div>
                        <div class="col-md-6 mb-3">

                            <label for="duration" class="form-label">Distance</label>

                            <input type="text"  class="form-control" id="distance" name="distance" >

                            <span class="text-danger" id="distance_error"></span>

                        </div>



                        <div class="col-md-6 mb-3">

                            <label for="package_type" class="form-label">Suggested</label>

                            <select class="form-select" id="suggested" name="suggested" >

                            <option value="0">----- Select------- </option>

                                    <option value="1">Suggested</option>

                            </select>
                        </div>
                        <div class="col-md-6 mb-3">

                            <label for="package_type" class="form-label">Meal Plans</label>

                            <select class="form-select" id="mealsplan" name="meals_plan" >

                            <option value="">----- Select------- </option>
                                    <option value="EP">Only Room</option>
                                    <option value="CP">Breakfast Included</option>
                                    <option value="MAP">Breakfast +Lunch/Dinner</option>
                                    <option value="AP">Breakfast +Lunch+Dinner</option>

                            </select>
                            <span class="text-danger" id="meals_plan_error"></span>

                        </div>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label for="amenities" class="form-label">Amenities</label>

                        <div class="d-flex align-items-center">

                            <input type="text" class="form-control me-2" name="amenities[]"  placeholder="Add an amenity" style="flex: 1;">

                            

                            <a href="JavaScript:void(0)" class="btn btn-primary" id="addMoreAmenities">+</a>

                            

                        </div>

                        <span class="text-danger" id="amenities_error"></span>

                        <div id="amenitiesContainer" class="mt-2 d-flex flex-wrap"></div>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label for="images" class="form-label">Images</label>

                        <input type="file" class="form-control" id="images" name="images[]" multiple >

                        <span class="text-danger" id="images_error"></span>

                    </div>

                    <div id="imagePreviewContainer" class="mt-2 d-flex flex-wrap"></div>

                    <div class="col-md-12 mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                        <span class="text-danger" id="banner_image_error"></span>
                    </div>
                    <div id="bannerImagePreviewContainer" class="mt-2 d-flex flex-wrap"></div>

                    <div class="col-md-12 mb-3">

                        <label for="duration" class="form-label">Hotel Tags</label>

                        <input type="text"  class="form-control" id="hotel_tags" name="hotel_tags">

                        <span class="text-danger" id="hotel_tags_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="productDescription" class="form-label">Description</label>

                        <textarea id="productDescription" class="form-control" name="description"></textarea>

                    </div>

                     

                    



                    <!-- Package Type -->

                    

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

        $('#addMoreAmenities').on('click', function() {

            const amenitiesInput = `

                <div class="d-flex align-items-center mb-2">

                    <input type="text" class="form-control me-2" name="amenities[]" required placeholder="Add an amenity" style="flex: 1;">

                    <button type="button" class="btn btn-danger remove-amenity">-</button>

                </div>

            `;

            $('#amenitiesContainer').append(amenitiesInput); // Append new input field

        });

        $(document).on('click', '.remove-amenity', function() {

            $(this).closest('.d-flex').remove(); // Remove the input field and button

        });

        $(document).on('submit', 'form#hotelForm', function(event) {

            event.preventDefault(); // Prevent default form submission

            $('#loading').css('display', ''); // Show loading indicator (you can remove this line if not using loading indicator)

            

            var form = $(this);

            var data = new FormData(form[0]); // Gather form data

            var url = form.attr("action"); // Get form action URL

            $('#submitBtn').prop('disabled', true); // Disable the button

            $('#submitBtnSpinner').removeClass('d-none'); // Show spinner

            

            $.ajax({

                type: form.attr('method'), // POST method from form

                url: url, // URL for submission (must be specified in form's action attribute)

                data: data,

                cache: false,

                contentType: false,

                processData: false,

                success: function(response) {

                    $('#loading').css('display', 'none'); // Hide loading indicator

                    if (response.success) {

                        toastr.success(response.message ); // Show success message (using Toastr for notifications)

                        window.setTimeout(function() {

                            window.location.href = "{{route('hotel/list')}}"; 

                        },1000);

                    }

                        $('#submitBtn').prop('disabled', false); // Re-enable the button

                        $('#submitBtnSpinner').addClass('d-none'); // Hide spinner

                },

                error: function(err) {

                    $('#loading').css('display', 'none'); // Hide loading indicator

                    setTimeout(function() {

                                $('#submitBtn').prop('disabled', false); // Re-enable the button

                                $('#submitBtnSpinner').addClass('d-none'); // Hide spinner

                            }, 3000); // 3 seconds delay

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

        $('#images').on('change', function(event) {

            const files = event.target.files;

            const previewContainer = $('#imagePreviewContainer');

            previewContainer.empty(); // Clear previous previews



            // Loop through the selected files

            for (let i = 0; i < files.length; i++) {

                const file = files[i];

                const reader = new FileReader();



                // Create a preview for each file

                reader.onload = function(e) {

                    const imagePreview = `

                        <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-new-${i}">

                            <img src="${e.target.result}" alt="Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">

                            <button type="button" class="btn btn-danger remove-image" data-id="new-${i}">x</button>

                        </div>

                    `;

                    previewContainer.append(imagePreview); // Append the new preview

                };



                reader.readAsDataURL(file);

            }

        });
        $(document).on('click', '.remove-image', function() {
    const imageId = $(this).data('id'); // Get the unique id of the image preview
    $(`#preview-${imageId}`).remove(); // Remove the preview from the DOM
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
                        <button type="button" class="btn btn-danger remove-image">x</button>
                    </div>
                `;
                bannerPreviewContainer.append(bannerImagePreview); // Append the new preview
            };

            reader.readAsDataURL(file);
        }
    });

    fetchStates();

    function fetchStates() {
        $.ajax({
            url: '/api/get-states',  // Laravel route
            method: 'GET',
            success: function(response) {
                if (response.states && response.states.length > 0) {
                    var stateSelect = $('#state');
                    stateSelect.empty();  // Clear previous options
                    stateSelect.append('<option value="">Select State</option>');  // Add default option

                    // Loop through the states and add them as options
                    response.states.forEach(function(state) {
                        stateSelect.append('<option value="' + state.id+ '" data-id="' + state.id + '">' + state.state + '</option>');
                    });
                }
            },
            error: function(err) {
                console.error('Error fetching states:', err);
            }
        });
    }

    $('#state').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var stateId = selectedOption.data('id'); // Get state ID from data attribute

        if (stateId) {
            fetchCities(stateId);
        } else {
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        }
    });

    function fetchCities(stateId) {
        $.ajax({
            url: '/api/get-cities/' + stateId,  // Correct API endpoint
            method: 'GET',
            success: function(response) {
                if (response.cities && response.cities.length > 0) {
                    var citySelect = $('#city');
                    citySelect.empty();  // Clear previous options
                    citySelect.append('<option value="">Select City</option>');  // Add default option

                    // Loop through the cities and add them as options
                    response.cities.forEach(function(city) {
                        citySelect.append('<option value="' + city.id + '">' + city.city + '</option>'); // Adjust as per your city model
                    });
                } else {
                    $('#city').empty();
                    $('#city').append('<option value="">No Cities Available</option>');
                }
            },
            error: function(err) {
                console.error('Error fetching cities:', err);
                $('#city').empty();
                $('#city').append('<option value="">Error loading cities</option>');
            }
        });
    }
    });

</script>

@endsection