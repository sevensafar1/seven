@extends('layouts.admin.app') 
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Package</h6>
                <form id="enquiryEditForm" action="{{route('enquiry/update')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$enq->name}}" readonly>
                            <input type="hidden" name="update_id" value="{{$enq->id}}">
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{$enq->phone}}" readonly>
                            <span class="text-danger" id="address_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$enq->email}}" readonly>
                            <span class="text-danger" id="address_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Destination</label>
                            <input type="text" class="form-control" id="destination" name="destination" value="{{$enq->destination}}" readonly>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        @if($enq->package_id == null)
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Enquiry</label>
                            <input type="text" class="form-control" id="package" name="enquiry_type" value="{{$enq->enquiry_type}}" readonly>
                            <span class="text-danger" id="address_error"></span>
                        </div>
                        
                        @else
                        @php 
                            // Assuming you have a Package model to interact with the package table
                            $package = \App\Models\Package::select('name')->where(['id'=>$enq->package_id])->first(); // Fetch package by ID
                            @endphp
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Package</label>
                            <input type="text" class="form-control" id="package" name="package" value="{{ $package->name}}" readonly>
                            <span class="text-danger" id="address_error"></span>
                        </div>

                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Arrival Date</label>
                            <input type="text" class="form-control" id="arrival" name="arrival" value="{{$enq->arrival_date}}" readonly>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Departure Date</label>
                            <input type="text" class="form-control" id="departure" name="departure" value="{{$enq->departure_date}}" readonly>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> No. of Adult</label>
                            <input type="text" class="form-control" id="noofadult" name="noofadult" value="{{$enq->no_of_adult}}" readonly>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleInputEmail1" class="form-label"> No. of Children</label>
                            <input type="text" class="form-control" id="noofchild" name="noofchild" value="{{$enq->no_of_child}}" readonly>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" >
                                <option value="0"  {{ $enq->status == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1"  {{ $enq->status == 1 ? 'selected' : '' }}>Success</option>
                                <option value="2" {{ $enq->status == 2 ? 'selected' : '' }}>Call again</option>
                                <option value="3" {{ $enq->status == 3 ? 'selected' : '' }}>Not Interested</option>
                                <option value="4" {{ $enq->status == 4 ? 'selected' : '' }}>Under Process</option>
                                <option value="5" {{ $enq->status == 5 ? 'selected' : '' }}>Price Issue</option>
                               
                            </select>
                            <span class="text-danger" id="name_error"></span>
                        </div>
                        
                    </div>
                    

                    
                    
                    <button type="submit" class="btn btn-primary" id="submitBtn">Update
                    <span id="submitBtnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('submit', 'form#enquiryEditForm', function(event) {
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
                    window.location.href = "{{route('enquiry/list')}}"; 
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