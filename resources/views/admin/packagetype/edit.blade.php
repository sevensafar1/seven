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
                <form id="packageTypeUpdate" action="{{route('package-type/update')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Package Name</label>
                        <input type="hidden" class="form-control" id="update_id" name="update_id" value="{{$data->slug}}">
                        <input type="text" class="form-control" id="name" name="package_name" value="{{$data->package_name}}">
                        <span class="text-danger" id="package_name_error"></span>
                    </div>
                 
                    <div class="mb-3">
                        <label for="arrival_status" class="form-label">Status</label>
                        <select class="form-control" id="arrival_status" name="status" >
                            <option value=""  selected>Select Status</option>
                            <option value="1" {{ isset($data->status) && $data->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ isset($data->status) && $data->status == 0 ? 'selected' : '' }}>Inactive</option>
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
<script>
    $(document).on('submit', 'form#packageTypeUpdate', function(event) {
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
                    window.location.href = "{{route('package/type')}}"; 
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
</script>

@endsection