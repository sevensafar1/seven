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
    .img-preview {
        position: relative;
        display: inline-block;
        margin: 10px;
    }
    .img-preview img {
        max-width: 150px;
        max-height: 150px;
    }
    .img-preview .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
    }
    #preview-container {
        display: flex;
        flex-wrap: wrap; /* Row layout with wrapping */
        gap: 10px; /* Gap between images */
    }

</style>





@section('content')

<div class="container-fluid pt-4 px-4">

    <div class="row g-4">

        <div class="col-sm-12 col-xl-12">

            <div class="bg-light rounded h-100 p-4">

                <h6 class="mb-4">Gallery</h6>

                <form id="galleryForm" action="{{route('gallery/save')}}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Title</label>

                        <input type="text" class="form-control" id="title" name="title">

                        <span class="text-danger" id="title_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Slug</label>

                        <input type="text" class="form-control" id="slug" name="slug">

                        <span class="text-danger" id="slug_error"></span>

                    </div>

                    

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Location</label>

                        <input type="text" class="form-control" id="location" name="location">

                        <span class="text-danger" id="location_error"></span>

                    </div>

                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">Alt</label>

                        <input type="text" class="form-control" id="alt" name="alt">

                        <span class="text-danger" id="alt_error"></span>

                    </div>



                    <div class="mb-3">

                        <label for="images" class="form-label">Images</label>

                        <input type="file" class="form-control" id="images" name="images[]" multiple >

                        <span class="text-danger" id="images_error"></span>

                    </div>
                    <div class="mb-3" id="preview-container">
                        <!-- Image previews will be displayed here in a row -->
                    </div>



                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit

                    <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>

                    </button>

                    

                </form>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).on('submit', 'form#galleryForm', function(event) {

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

                        window.location.href = "{{route('gallery/list')}}"; 

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
let selectedFiles = []; // Store selected files

    // On change event for the file input
    $('#images').on('change', function(event) {
        const files = event.target.files;
        selectedFiles = Array.from(files); // Convert file list to array
        previewImages(selectedFiles); // Call function to show previews
    });

    // Function to preview images
    function previewImages(files) {
        $('#preview-container').empty(); // Clear previous previews
        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-container').append(`
                    <div class="img-preview" data-index="${index}">
                        <img src="${e.target.result}" alt="${file.name}">
                        <button type="button" class="remove-btn" onclick="removeImage(${index})">X</button>
                    </div>
                `);
            };
            reader.readAsDataURL(file); // Read the file as a data URL
        });
    }

    // Function to remove image preview and file from the selected list
    function removeImage(index) {
        selectedFiles.splice(index, 1); // Remove the selected file
        previewImages(selectedFiles); // Re-render the preview
        $('#images').val(""); // Clear the input value to allow re-selection of files
    }
</script>



@endsection