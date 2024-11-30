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

                <h6 class="mb-4">State</h6>

                <form id="packageForm" action="{{route('city/save')}}" method="POST" enctype="multipart/form-data">

                @csrf 
                   
               
                    <!-- Package Type -->
                    <div class="mb-3">

                        <label for="package_type" class="form-label">State</label>

                        <select class="form-select" id="state" name="state" >

                        <option value="">----- Select type ------- </option>

                            @if($states)

                                @foreach($states as $type)

                                    <option value="{{$type->id}}">{{$type->state}} </option>

                                @endforeach

                            @endif

                            

                        </select>
                        <span class="text-danger" id="state_error"></span>

                    </div>
                    <div class="mb-3">

                        <label for="exampleInputEmail1" class="form-label">City name</label>

                        <input type="text" class="form-control" id="city" name="city" >

                        <span class="text-danger" id="city_error"></span>

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


       

        $(document).on('submit', '#packageForm', function(event) {

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