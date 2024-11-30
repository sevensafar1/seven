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
</style>

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <!-- <h6 class="mb-4">Update Email and Password</h6> -->
                <form id="ChangePassword" action="{{route('password/update')}}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>
                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="text-danger" id="password_error"></span>
                    </div>

                   
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit
                        <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', 'form#ChangePassword', function(event) {
        event.preventDefault(); // Prevent default form submission
        $('#loading').css('display', ''); // Show loading indicator (if applicable)

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
                        window.location.href = "{{route('user.list')}}"; 
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
