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
        flex-wrap: wrap;
        gap: 10px;
    }
</style>

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Gallery</h6>

                <form id="galleryForm" action="{{route('banner/save')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title Input -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <span class="text-danger" id="title_error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                        <span class="text-danger" id="slug_error"></span>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <span class="text-danger" id="description_error"></span>
                    </div>

                   

                    <!-- Single Image Input -->
                    <div class="mb-3">
                        <label for="single_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="text-danger" id="image_error"></span>
                    </div>

                 

                    <div class="mb-3" id="preview-container"></div>

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
                        window.location.href = "{{route('banner/list')}}";
                    }, 1000);
                }
                $('#submitBtn').prop('disabled', false);
                $('#submitBtnSpinner').addClass('d-none');
            },
            error: function(err) {
                $('#loading').css('display', 'none');
                setTimeout(function() {
                    $('#submitBtn').prop('disabled', false);
                    $('#submitBtnSpinner').addClass('d-none');
                }, 3000);
                if (err.status === 422) {
                    $('#loading').css('display', 'none');
                    var error = $.parseJSON(err.responseText);
                    $.each(error.errors, function(key, val) {
                        $("#" + key + "_error").text(val);
                    });
                }
            }
        });
        return false;
    });
</script>

@endsection
