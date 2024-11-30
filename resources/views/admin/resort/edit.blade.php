@extends('layouts.admin.app')



<style>

    .addbtndes {

        background-color: #178750 !important;

        border: none !important;

        border-radius: 50% !important;

        padding: 7px 15px !important;  

    }

    .minusbtndes {

        background-color: #ee1010 !important;

        border: none !important;

        border-radius: 50% !important;

        padding: 9px 19px !important;

        margin-left: 11px;

    }

    .remove-image {

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

                <h6 class="mb-4">Resort</h6>

                <form id="hotelFormUpdate" action="{{ route('resort/update') }}" method="POST" enctype="multipart/form-data">

                    @csrf    
                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="name" class="form-label">Resort Name</label>

                            <input type="hidden" class="form-control" id="update_id" name="update_id" value="{{ $resort->slug }}">

                            <input type="hidden" class="form-control" id="resort_id" name="resort_id" value="{{ $resort->id }}">

                            <input type="text" class="form-control" id="name" name="name" value="{{ $resort->name }}">

                            <span class="text-danger" id="name_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="location" class="form-label">Address</label>

                            <input type="text" class="form-control" id="location" name="address" value="{{ $resort->address }}">

                            <span class="text-danger" id="address_error"></span>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state" name="state">
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
                        <input type="hidden" id="saved_state" value="{{ $resort->state }}">
                        <input type="hidden" id="saved_city" value="{{ $resort->city }}">
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="phone" class="form-label">Phone</label>

                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $resort->phone }}">

                            <span class="text-danger" id="phone_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="mrp" class="form-label">MRP</label>

                            <input type="number" class="form-control" id="mrp" name="mrp" value="{{ $resort->mrp }}">

                            <span class="text-danger" id="mrp_error"></span>

                        </div>

                    </div>



                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label for="price" class="form-label">Price</label>

                            <input type="number" class="form-control" id="price" name="price" value="{{ $resort->price }}">

                            <span class="text-danger" id="price_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="rating" class="form-label">Rating</label>

                            <input type="number" class="form-control" id="rating" name="rating" value="{{ $resort->rating }}">

                            <span class="text-danger" id="rating_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="suggested" class="form-label">Suggested</label>

                            <select class="form-select" id="suggested" name="suggested">

                                <option value="0" {{ $resort->suggested_hotel == 0 ? 'selected' : '' }}>----- Select -------</option>

                                <option value="1" {{ $resort->suggested_hotel == 1 ? 'selected' : '' }}>Suggested</option>

                            </select>

                        </div>
                        <div class="col-md-6 mb-3">

                            <label for="package_type" class="form-label">Meal Plans</label>

                            <select class="form-select" id="mealsplan" name="meals_plan" >

                            <option value="">----- Select------- </option>
                                    <option value="EP" {{ $resort->meals_plan == 'EP' ? 'selected' : '' }}>Only Room</option>
                                    <option value="CP" {{ $resort->meals_plan == 'CP' ? 'selected' : '' }}>Breakfast Included</option>
                                    <option value="MAP" {{ $resort->meals_plan == 'MAP' ? 'selected' : '' }}>Breakfast +Lunch/Dinner</option>
                                    <option value="AP" {{ $resort->meals_plan == 'AP' ? 'selected' : '' }}>Breakfast +Lunch+Dinner</option>

                            </select>
                            <span class="text-danger" id="meals_plan_error"></span>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="location" class="form-label">Distance</label>

                            <input type="text" class="form-control" id="distance" name="distance" value="{{$resort->distance}}">

                            <span class="text-danger" id="distance_error"></span>

                        </div>
                        <div class="col-md-6 mb-3">

                        <label for="duration" class="form-label">Duration</label>

                        <input type="text"  class="form-control" id="duration" name="duration" value="{{$resort->duration}}">

                        <span class="text-danger" id="duration_error"></span>

                        </div>

                    </div>



                    <div class="col-md-12 mb-3">

                        <label for="amenities" class="form-label">Amenities</label>

                        <div class="d-flex align-items-center" id="amenitiesContainer">

                            @if($resort->facilty)

                                @php

                                    $amenities = json_decode($resort->facilty, true);

                                @endphp



                                <input type="text" class="form-control me-2" name="amenities[]" value="{{ $amenities[0] }}" placeholder="Add an amenity" style="flex: 1;">



                                @for ($i = 1; $i < count($amenities); $i++)

                                    <div class="d-flex align-items-center mb-1">

                                        <input type="text" class="form-control me-2" name="amenities[]" value="{{ $amenities[$i] }}" style="flex: 1;">

                                        <button type="button" class="btn btn-danger remove-amenity">-</button>

                                    </div>

                                @endfor

                            @else

                                <input type="text" class="form-control me-2" name="amenities[]" placeholder="Add an amenity" style="flex: 1;">

                            @endif



                            <button type="button" class="btn btn-primary" id="addMoreAmenities">+</button>

                        </div>

                        <span class="text-danger" id="amenities_error"></span>

                    </div>



                    <div class="col-md-12 mb-3">

                        <label for="images" class="form-label">Images</label>

                        <input type="file" class="form-control" id="images" name="images[]" multiple>

                        <span class="text-danger" id="images_error"></span>

                    </div>

                    

                    <div id="imagePreviewContainer" class="mt-2 d-flex flex-wrap">

                        @php

                            $existingImages = \App\Models\ResortImage::where('resort_id', $resort->id)->get();

                        @endphp



                        @if($existingImages->count())

                            @foreach($existingImages as $image)

                                <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-{{ $image->id }}">

                                    <img src="{{ asset('public/images/resorts/' . $image->images) }}" alt="Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">

                                    <button type="button" class="btn btn-danger remove-image" data-id="{{ $image->id }}">x</button>

                                </div>

                            @endforeach

                        @endif

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                        <span class="text-danger" id="banner_image_error"></span>
                    </div>

                    <!-- Banner Image Preview Container -->
                    <div id="bannerImagePreviewContainer" class="mt-2">
                        @if($resort->banner_image)
                            <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-banner">
                                <img src="{{ asset('public/images/resorts/' . $resort->banner_image) }}" alt="Banner Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">
                                <!-- <button type="button" class="btn btn-danger remove-banner-image">x</button> -->
                            </div>
                        @endif
                    </div>

                   



                    <div class="mb-3">

                        <label for="productDescription" class="form-label">Description</label>

                        <textarea id="productDescription" class="form-control" name="description">{!! $resort->about !!}</textarea>

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

            height: 200,

            placeholder: 'Enter product description here...'

        });



        $('#addMoreAmenities').on('click', function() {

            const amenitiesInput = `

                <div class="d-flex align-items-center mb-2">

                    <input type="text" class="form-control me-2" name="amenities[]" required placeholder="Add an amenity" style="flex: 1;">

                    <button type="button" class="btn btn-danger remove-amenity">-</button>

                </div>

            `;

            $('#amenitiesContainer').append(amenitiesInput);

        });



        $(document).on('click', '.remove-amenity', function() {

            $(this).closest('.d-flex').remove();

        });



        $(document).on('submit', 'form#hotelFormUpdate', function(event) {

            event.preventDefault();

            $('#loading').css('display', '');



            var form = $(this);

            var data = new FormData(form[0]);

            var url = form.attr("action");

            $('#submitBtn').prop('disabled', true);

            $('#submitBtnSpinner').removeClass('d-none');



            $.ajax({

                type: form.attr('method'),

                url: url,

                data: data,

                cache: false,

                contentType: false,

                processData: false,

                success: function(response) {

                    $('#loading').css('display', 'none');

                    if (response.success) {

                        toastr.success(response.message);

                        window.setTimeout(function() {

                            window.location.href = "{{ route('resort/list') }}"; // Redirect after 1 second



                        }, 1000);

                    }

                    $('#submitBtn').prop('disabled', false);

                    $('#submitBtnSpinner').addClass('d-none');

                },

                error: function(err) {

                    $('#loading').css('display', 'none');

                    $('#submitBtn').prop('disabled', false);

                    $('#submitBtnSpinner').addClass('d-none');

                    if (err.status === 422) {

                        var error = $.parseJSON(err.responseText);

                        $.each(error.errors, function(key, val) {

                            $("#" + key + "_error").text(val);

                        });

                    }

                }

            });



            return false;

        });



        $('#images').on('change', function(event) {

            const files = event.target.files;

            const previewContainer = $('#imagePreviewContainer');



            for (let i = 0; i < files.length; i++) {

                const file = files[i];

                const reader = new FileReader();



                reader.onload = function(e) {

                    const imagePreview = `

                        <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-new-${i}">

                            <img src="${e.target.result}" alt="Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">

                            <button type="button" class="btn btn-danger remove-image" data-id="new-${i}">x</button>

                        </div>

                    `;

                    previewContainer.append(imagePreview);

                };



                reader.readAsDataURL(file);

            }

        });



        $(document).on('click', '.remove-image', function() {

            const imageId = $(this).data('id');

            const imagePreview = $(this).closest('.image-preview');



            if (typeof imageId === 'string' && imageId.startsWith('new-')) {

                imagePreview.remove();

            } else {

                $.ajax({

                    url: '/delete-image/' + imageId,

                    type: 'DELETE',

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    },

                    success: function(response) {

                        if (response.success) {

                            imagePreview.remove();

                            toastr.success(response.message);

                        } else {

                            toastr.error('Failed to delete the image.');

                        }

                    },

                    error: function() {

                        toastr.error('An error occurred while deleting the image.');

                    }

                });

            }

        });

        $('#banner_image').on('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imagePreview = `
                    <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-banner">
                        <img src="${e.target.result}" alt="Banner Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">
                    </div>
                `;
                $('#bannerImagePreviewContainer').html(imagePreview);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        // Handle removal of banner image preview
        $(document).on('click', '.remove-banner-image', function() {
            // Clear the input field
            $('#banner_image').val('');
            // Remove the preview
            $('#preview-banner').remove();
        });
        fetchStates();
        // Fetch and populate cities based on the selected state (if any)
        var savedState = $('#saved_state').val();
        var savedCity = $('#saved_city').val();

        if (savedState) {
            $('#state').val(savedState); // Pre-select the saved state
            fetchCities(savedState); // Fetch cities for the selected state
        }

        // Fetch cities once a state is selected
        $('#state').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var stateId = selectedOption.data('id');

            if (stateId) {
                fetchCities(stateId);
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        });

    // Function to fetch states
    function fetchStates() {
        $.ajax({
            url: '/api/get-states',  // Laravel route
            method: 'GET',
            success: function(response) {
                if (response.states && response.states.length > 0) {
                    var stateSelect = $('#state');
                    stateSelect.empty();  // Clear previous options
                    stateSelect.append('<option value="">Select State</option>');

                    response.states.forEach(function(state) {
                        stateSelect.append('<option value="' + state.id + '" data-id="' + state.id + '">' + state.state + '</option>');
                    });

                    // Pre-select the state if one was saved
                    if (savedState) {
                        stateSelect.val(savedState);
                    }
                }
            },
            error: function(err) {
                console.error('Error fetching states:', err);
            }
        });
    }

    // Function to fetch cities based on state
    function fetchCities(stateId) {
        $.ajax({
            url: '/api/get-cities/' + stateId,
            method: 'GET',
            success: function(response) {
                if (response.cities && response.cities.length > 0) {
                    var citySelect = $('#city');
                    citySelect.empty();
                    citySelect.append('<option value="">Select City</option>');

                    response.cities.forEach(function(city) {
                        citySelect.append('<option value="' + city.id + '">' + city.city + '</option>');
                    });

                    // Pre-select the city if one was saved
                    if (savedCity) {
                        citySelect.val(savedCity);
                    }
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

