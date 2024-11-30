@extends('layouts.admin.app')



<style>

    /* Your existing styles */

</style>



@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">

        <div class="col-sm-12 col-xl-12">

            <div class="bg-light rounded h-100 p-4">

                <h6 class="mb-4">Blog</h6>

                <form id="BlogupdateForm" action="{{route('blog/update')}}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">

                        <label for="title" class="form-label">Title</label>

                        <input type="hidden" name="update_id" value="{{$blog->id}}">

                        <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}">

                        <span class="text-danger" id="title_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="slug" class="form-label">Slug</label>

                        <input type="text" class="form-control" id="slug" name="slug" value="{{$blog->slug}}">

                        <span class="text-danger" id="slug_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="images" class="form-label">Images</label>

                        <input type="file" class="form-control" id="images" name="images">

                        <span class="text-danger" id="images_error"></span>

                    </div>



                    <!-- Show uploaded image -->

                    @if ($blog->image) <!-- Assuming the uploaded image URL is stored in $blog->image -->

                    <div class="mb-3">

                        <img id="uploadedImage" src="{{ asset('public/images/Blog/' . $blog->image) }}"  alt="Uploaded Image" style="max-width: 100%; height: auto;">

                    </div>

                    @endif



                    <!-- Image Preview -->

                    <div class="mb-3">

                        <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-width: 100%; height: auto;">

                    </div>

                    <div class="mb-3">

                        <label for="arrival_status" class="form-label">Status</label>

                        <select class="form-control" id="status" name="status">

                            <option value="" selected>Select Status</option>

                            <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>

                            <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label for="productDescription" class="form-label">Description</label>

                        <textarea id="productDescription" name="description">{!!$blog->description!!}</textarea>

                        <span class="text-danger" id="description_error"></span>

                    </div>



                    <button type="submit" class="btn btn-primary" id="submitBtn">

                        Submit

                        <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>



<!-- Your existing script imports -->

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<script>

$(document).ready(function() {

    // Initialize Summernote

    $('#productDescription').summernote({

        height: 200,

        placeholder: 'Enter blog description here...',

        toolbar: [

            // Your toolbar options

        ],

        // Your Summernote options

    });



    $('#images').on('change', function(event) {

        const file = event.target.files[0];

        if (file) {

            const reader = new FileReader();

            reader.onload = function(e) {

                $('#imagePreview').attr('src', e.target.result).show();

                $('#uploadedImage').hide(); // Hide the uploaded image when a new image is selected

            }

            reader.readAsDataURL(file);

        } else {

            $('#imagePreview').attr('src', '').hide();

            $('#uploadedImage').show(); // Show the uploaded image if no new file is selected

        }

    });

    

    // Your existing form submission and validation logic

    // Populate custom font sizes after Summernote is fully initialized

    $('#productDescription').on('summernote.init', function() {

        // Default font sizes in Summernote

        var defaultFontSizes = [8, 9, 10, 11, 12, 13, 14, 15, 16, 18, 20, 24, 30, 36, 48, 64, 82, 150];



        // Custom font sizes you want to add

        var customFontSizes = [22]; // Add your custom sizes here



        // Combine default and custom font sizes, removing duplicates

        var allFontSizes = [...new Set([...defaultFontSizes, ...customFontSizes])];



        // Update the font size dropdown

        var fontsizeDropdown = $('.note-fontsize .dropdown-menu');



        // Clear existing dropdown items

        fontsizeDropdown.empty();



        // Append all font sizes

        $.each(allFontSizes, function(index, value) {

            fontsizeDropdown.append(

                $('<li>').append(

                    $('<a>').attr('class', 'note-fontsize').attr('data-value', value).text(value + 'px')

                )

            );

        });

    });

    $(document).on('submit', 'form#BlogupdateForm', function(event) {

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

                        window.location.href = "{{route('blog/list')}}"; 

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

});

</script>

@endsection

