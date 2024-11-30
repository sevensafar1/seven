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

    .image-preview {
        width: 100px !important;
        height: 100px;
        object-fit: cover;
        margin: 5px;
        position: relative;
        display: inline-block;
    }

    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    img#uploadedImage {
        width: 100%;
        height: 100%;
    }
</style>

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Gallery</h6>
                <form id="galleryForm" action="{{ route('banner/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="hidden" name="update_id" value="{{ $banner->id }}">
                        <input type="text" class="form-control" id="title" name="title" value="{{ $banner->title }}">
                        <span class="text-danger" id="title_error"></span>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ $banner->description }}</textarea>
                        <span class="text-danger" id="description_error"></span>
                    </div>

                    <!-- Single Image Input and Preview -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="text-danger" id="image_error"></span>

                        <!-- Display existing image -->
                        <div class="image-preview-container mt-2" id="imagePreview">
                            @if($banner->image)
                                <div class="image-preview">
                                    <img id="uploadedImage" src="{{ asset('public/images/banner/' . $banner->image) }}" alt="Uploaded Image">
                                </div>
                            @endif
                        </div>
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

<script>
    // Handle image preview for new images
    document.getElementById('image').addEventListener('change', function() {
        const file = this.files[0];
        const imagePreviewContainer = document.getElementById('imagePreview');
        imagePreviewContainer.innerHTML = ''; // Clear previous previews

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewDiv = document.createElement('div');
                previewDiv.classList.add('image-preview'); // Add the class for consistent styling

                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px'; // Ensure width is fixed
                img.style.height = '100px'; // Ensure height is fixed
                img.style.objectFit = 'cover'; // Maintain aspect ratio while fitting inside the container

                // Append img to previewDiv
                previewDiv.appendChild(img);

                // Add previewDiv to the preview container
                imagePreviewContainer.appendChild(previewDiv);
            };

            reader.readAsDataURL(file); // Read file for preview
        }
    });

    // AJAX form submission
    $(document).on('submit', 'form#galleryForm', function(event) {
        event.preventDefault(); // Prevent default form submission

        $('#loading').css('display', ''); // Show loading indicator

        var form = $(this);
        var data = new FormData(form[0]); // Gather form data
        var url = form.attr("action"); // Get form action URL

        $('#submitBtn').prop('disabled', true); // Disable the button
        $('#submitBtnSpinner').removeClass('d-none'); // Show spinner

        $.ajax({
            type: form.attr('method'), // POST method from form
            url: url, // URL for submission
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#loading').css('display', 'none'); // Hide loading indicator
                if (response.success) {
                    toastr.success(response.message); // Show success message
                    window.setTimeout(function() {
                        window.location.href = "{{ route('gallery/list') }}";
                    }, 1000);
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
                    var error = $.parseJSON(err.responseText);
                    $.each(error.errors, function(key, val) {
                        $("#" + key + "_error").text(val); // Display validation errors
                    });
                }
            }
        });

        return false; // Prevent further event handling
    });
</script>

@endsection
