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
            <a href="{{route('city.create')}}" class="btn btn-primary">Add City</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">State</th>
                            <th scope="col">City</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($lists)
                        @foreach($lists as $key=> $data)

                        @php 
                        $state=getState($data->state_id); 
                        @endphp
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{ $state->state ? $state->state : 'None' }}</td>
                            <td>
                                {{ $data->city }}
                            </td>
                            <td>
                               
                                <a href="#"  class="delete-btn" data-id="{{ $data->id }}" title="Delete">
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
            <!-- Table End -->
<script>
    $(document).ready(function() {
        // Handle delete button click event
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            
            var city = $(this).data('id'); // Get the category ID
            var url = '{{ url("city/delete") }}/' + city; // Define the URL

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
                            id: city 
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                ' City has been deleted.',
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
    });
</script>

@endsection
