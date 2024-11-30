@extends('layouts.admin.app') 
@section('content')

<style>
button.edtbtn {
    border: none;
    background-color: #009cff;
    color: #fff;
    font-size: 12px;
    border-radius: 15px;
    padding: 3px 9px;
}
</style>
 <!-- Table Start -->
 <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
            <a href="{{route('hotel/create')}}" class="btn btn-primary">Add Hotel</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hotel Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Price</th>
                            <th scope="col">Location</th>
                            <th scope="col">Popular</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($hoteldata)

                            @foreach($hoteldata as $key=> $data)
                                @php  
                                $state=getState($data->state);
                                $city=getcity($data->city);  
                                @endphp
                            <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$data->name}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->price}}</td>
                            
                            <td>{{$city ? $city->city : 'city'}},  {{ $state ? $state->state : 'State' }}</td>
                            <td>
                                <!-- Checkbox for Popular status -->
                                <input type="checkbox" class="popular-checkbox" data-id="{{ $data->id }}">
                            </td>
                            <td>
                                <a href="{{ route('hotel/edit', $data->id) }}" class="" title="Edit">
                                    <button class="edtbtn">Edit</button>
                                </a>
                                <a href="#"  class="delete-hotel" data-id="{{ $data->id }}" title="Delete">
                                    <button class="edtbtn">Delete</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    <script>
$(document).ready(function() {

    // Handle delete button click event

    $('.delete-hotel').on('click', function(e) {

        

        e.preventDefault();

        

        var hotelId = $(this).data('id'); // Get the category ID

        var url = '/hotel/delete/' + hotelId; // Define the URL



        // Trigger SweetAlert for confirmation

        Swal.fire({

            title: 'Are you sure?',

            text: "You won't be able to revert this!",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#3085d6',

            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, delete it!'

        }).then((result) => {

            if (result.isConfirmed) {

                // If user confirms, proceed with the AJAX request

                $.ajax({

                    url: url,

                    type: 'post',

                    data: {

                        _token: '{{ csrf_token() }}',

                        id: hotelId 

                    },

                    success: function(response) {

                        Swal.fire(

                            'Deleted!',

                            'The Hotel has been deleted.',

                            'success'

                        ).then((result) => {

                            if (result.isConfirmed) {

                                // If user clicks 'OK', reload the page

                                window.location.reload();

                            }

                        });

                    },

                    error: function(xhr) {

                        Swal.fire(

                            'Error!',

                            'Something went wrong, please try again later.',

                            'error'

                        );

                    }

                });

            }

        });

    });
    $('.popular-checkbox').on('change', function() {
    var hotelId = $(this).data('id'); // Get the hotel ID
    var isChecked = $(this).is(':checked') ? 1 : 0; // Determine if it's checked (1) or not (0)

    // Send AJAX request to update the popular status
    $.ajax({
        url: "{{ secure_url(route('hotel.popular.update')) }}",
        type: 'post',
        data: {
            _token: '{{ csrf_token() }}',
            id: hotelId,
            package_sts: isChecked
        },
        success: function(response) {
            console.log(response);
            // Check if the response is a valid JSON object
            if (response && response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Status updated',
                    text: 'The popular status has been updated successfully.'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Something went wrong, please try again later.'
                });
            }
        },
        error: function(xhr, status, error) {
            console.log('AJAX Error:', xhr.responseText);  // Log the error for debugging
            if (xhr.responseJSON) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: xhr.responseJSON.message
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unknown error occurred. Please try again later.'
                });
            }
        }
    });
});




});

</script>



@endsection

