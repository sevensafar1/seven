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

                <h6 class="mb-4">Package</h6>

                <form id="packageUpdateForm" action="{{ route('package/update') }}" method="POST" enctype="multipart/form-data">

                @csrf  

                <div class="mb-3">

                    <label for="exampleInputEmail1" class="form-label">Package Title</label>

                    <input type="text" class="form-control" id="name" name="title" value="{{$package->title}}">

                    <span class="text-danger" id="title_error"></span>

                </div>   

                <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Package Name</label>

                        <input type="hidden" class="form-control" name="update_id" value="{{$package->slug}}">

                        <input type="hidden" class="form-control" name="package_id" value="{{$package->id}}">

                        <input type="text" class="form-control" id="name" name="name" value="{{$package->name}}">

                    </div>

                    <div class="mb-3">

                        <label for="images" class="form-label">Images</label>

                        <input type="file" class="form-control" id="images" name="images[]" multiple>

                    </div>

                    <div id="imagePreviewContainer" class="mt-2 d-flex flex-wrap">

                        @php

                            $existingImages = \App\Models\PackageImage::where('package_id', $package->id)->get();

                        @endphp



                        @if($existingImages->count())

                            @foreach($existingImages as $image)

                                <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-{{ $image->id }}">

                                    <img src="{{ asset('public/images/packages/' . $image->images) }}" alt="Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">

                                    <button type="button" class="btn btn-danger remove-image" data-id="{{ $image->id }}">x</button>

                                </div>

                            @endforeach

                        @else

                            <p>No images uploaded yet.</p>

                        @endif

                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="banner_image" class="form-label">Banner Image</label>
                        <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                        <span class="text-danger" id="banner_image_error"></span>
                    </div>

                    <!-- Banner Image Preview Container -->
                    <div id="bannerImagePreviewContainer" class="mt-2">
                        @if($package->banner_image)
                            <div class="image-preview d-flex align-items-center mb-2 position-relative" id="preview-banner">
                                <img src="{{ asset('public/images/packages/' . $package->banner_image) }}" alt="Banner Image Preview" class="img-thumbnail" style="width: 100px; height: auto; margin-right: 10px;">
                                <!-- <button type="button" class="btn btn-danger remove-banner-image">x</button> -->
                            </div>
                        @endif
                    </div>

                    <!-- Arrival Date -->

                    <div class="mb-3">

                        <label for="arrival_date" class="form-label">Arrival Date</label>

                        <input type="date" class="form-control" id="arrival_date" name="arrival_date" value="{{ old('arrival_date', $package->arrival_date) }}" required>

                    </div>



                    <!-- Departure Date -->

                    <div class="mb-3">

                        <label for="departure_date" class="form-label">Departure Date</label>

                        <input type="date" class="form-control" id="departure_date" name="departure_date" value="{{ old('departure_date', $package->departure_date) }}" required>

                    </div>

                    <div class="mb-3">

                        <label for="amount" class="form-label">Price</label>

                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{$package->price}}" >

                        <span class="text-danger" id="price_error"></span>

                    </div>

                     <!-- Amount -->

                    <div class="mb-3">

                        <label for="amount" class="form-label">Amount</label>

                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{$package->amount}}" required>

                    </div>



                    <!-- Days -->

                    <div class="mb-3">

                        <label for="days" class="form-label">Days</label>

                        <input type="number" class="form-control" id="days" name="days" value="{{$package->days}}" required>

                    </div>



                    <!-- Nights -->

                    <div class="mb-3">

                        <label for="nights" class="form-label">Nights</label>

                        <input type="number" class="form-control" id="nights" name="nights" value="{{$package->nights}}" required>

                    </div>



                    <!-- Location -->

                    <div class="mb-3">

                        <label for="location" class="form-label">Location</label>

                        <input type="text" class="form-control" id="location" name="location" value="{{$package->location}}" required>

                    </div>

                    <div class="mb-3">

                        <label for="productDescription" class="form-label">Description</label>

                        <textarea id="productDescription" name="description">{{$package->description}}</textarea>

                    </div>

                    @php $tourData = json_decode($package->about_tour, true); @endphp

                    <!-- About Tour (Array) -->

                    <div class="mb-3">

                        <label for="about_tour" class="form-label">About Tour</label><br>

                        <div id="aboutTourContainer">

                            @if(isset($tourData) && count($tourData['place']) > 0)

                                @foreach($tourData['place'] as $index => $place)

                                    <div class="row mb-3 about-tour-item">

                                        <div class="col">

                                            <input type="text" class="form-control mb-1" name="place[]" value="{{ $place }}" placeholder="Place covered">

                                        </div>

                                        <div class="col">

                                            <input type="text" class="form-control mb-1" name="inclusions[]" value="{{ $tourData['inclusions'][$index] ?? '' }}" placeholder="Inclusions">

                                        </div>

                                        <div class="col">

                                            <input type="text" class="form-control mb-1" name="exclusions[]" value="{{ $tourData['exclusions'][$index] ?? '' }}" placeholder="Exclusions">

                                        </div>

                                        <div class="col d-flex align-items-center">

                                            <input type="text" class="form-control mb-1" name="event_date[]" value="{{ $tourData['event_date'][$index] ?? '' }}" placeholder="Event Date">

                                            @if($index === 0)

                                                <a href="JavaScript:void(0)" class="btn btn-primary ms-2" id="addMoreTour">+</a>

                                            @else

                                                <a href="JavaScript:void(0)" class="btn btn-danger ms-2 removeTourSection">-</a>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            @else

                                <!-- Initial Tour Row if no data -->

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

                                        <input type="text" class="form-control mb-1" name="event_date[]" placeholder="Event Date">

                                        <a href="JavaScript:void(0)" class="btn btn-primary ms-2" id="addMoreTour">+</a>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                    @php $tourDescription = json_decode($package->tour_description, true); @endphp

                    <div class="mb-3">

                        <label for="tour_description" class="form-label">Tour Description</label><br>

                        <div id="tourDescriptionContainer">

                            @if(isset($tourDescription) && count($tourDescription['tourtitle']) > 0)

                                @foreach($tourDescription['tourtitle'] as $index => $title)

                                    <div class="tour-description-item mb-3">

                                        <input type="text" class="form-control mb-1" name="tourtitle[]" value="{{ $title }}" placeholder="Tour Title" required />

                                        <textarea class="form-control mb-3" name="tour_description[]" rows="3" placeholder="Enter tour descriptions, one per line" required>{{ $tourDescription['tour_description'][$index] ?? '' }}</textarea>

                                        

                                        @if($index === 0)

                                            <a href="JavaScript:void(0)" class="btn btn-primary ms-2" id="addMoreDescription">+</a>

                                        @else

                                            <a href="JavaScript:void(0)" class="btn btn-danger ms-2 removeDescription">-</a>

                                        @endif

                                    </div>

                                @endforeach

                            @else

                                <div class="tour-description-item mb-3">

                                    <input type="text" class="form-control mb-1" name="tourtitle[]" placeholder="Tour Title" required />

                                    <textarea class="form-control mb-3" name="tour_description[]" rows="3" placeholder="Enter tour descriptions, one per line" required></textarea>

                                    <a href="JavaScript:void(0)" class="btn btn-primary ms-2" id="addMoreDescription">+</a>

                                </div>

                            @endif

                        </div>

                    </div>



                    <!-- Package Type -->

                    <div class="mb-3">

                        <label for="package_type" class="form-label">Package Type</label>

                        <select class="form-select" id="package_type" name="package_type">

                            <option value="">----- Select type ------- </option>

                            @if($packageType)

                                @foreach($packageType as $type)

                                    <option value="{{ $type->id }}" {{ $package->package_type == $type->id ? 'selected' : '' }}>

                                        {{ $type->package_name }}

                                    </option>

                                @endforeach

                            @endif

                            <option value="1" {{ $package->package_type == 1 ? 'selected' : '' }}>Domestic</option>

                        </select>

                    </div>
                    <div class="mb-3">

                        <label for="home_package" class="form-label">Home Package</label>

                        <select class="form-select" id="home_package" name="home_package" >

                        <option value="">----- Select type ------- </option>

                            <option value="1" {{ $package->in_home == 1 ? 'selected' : '' }}>In Home</option>

                        </select>

                    </div>

                   

                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit

                    <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>

                    </button>

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

        $(document).on('submit', '#packageUpdateForm', function(event) {



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

                        var error = $.parseJSON(err.responseText);

                        $.each(error.errors, function(key, val) {

                            toastr.error(val[0]); // Show error message

                        });

                    } else {

                        toastr.error('Something went wrong. Please try again.'); // Generic error message

                    }

                }

            });



            return false; // Prevent further event handling

        });

        $('#images').on('change', function(event) {

        const files = event.target.files;

        const previewContainer = $('#imagePreviewContainer');



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

        const imageId = $(this).data('id'); // Get the image ID
        // alert(imageId);

        console.log('Image ID:', imageId, 'Type:', typeof imageId); // Debugging line

        const imagePreview = $(this).closest('.image-preview'); // Find the parent div



        // Check if imageId is indeed a string

        if (typeof imageId === 'string' && imageId.startsWith('new-')) {

            // For new images (not yet uploaded), just remove from preview

            imagePreview.remove();

        } else {

            // AJAX request to delete the existing image from the database

            $.ajax({

                url: '/delete-packageimage/' + imageId, // Adjust this URL to your route

                type: 'DELETE',

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                },

                success: function(response) {

                    if (response.success) {

                        imagePreview.remove(); // Remove the preview from the DOM

                        toastr.success(response.message); // Show success message

                    } else {

                        toastr.error('Failed to delete the image.'); // Show error message

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

});

</script>

@endsection