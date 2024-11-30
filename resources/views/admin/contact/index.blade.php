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
.table td span.pending {
    background-color: #ffa012;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
.table td span.success {
    background-color: #096e17;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
.table td span.callagain {
    background-color: #008c7f;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
.table td span.notinterested {
    background-color: #e30000;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
.table td span.underprocess {
    background-color: #e3b200;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
.table td span.priceissues {
    background-color: #8f00e3;
    padding: 3px 10px;
    border-radius: 30px;
    font-size: 14px;
    color: #fff;
}
</style>

 <!-- Table Start -->
 <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
           
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($enquiry)
                        @foreach($enquiry as $key=> $data)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$data->name}}</td>
                            <td>{{$data->phone}}</td>
                            <td>{{$data->email}}</td>
                            <td>
                                @if($data->status == '0')
                                    <span class="pending status" data-id="{{ $data->id }}">Pending</span>
                                @elseif($data->status == '1')
                                    <span class="success status" data-id="{{ $data->id }}">Success</span>
                                @elseif($data->status == '2')
                                    <span class="callagain status" data-id="{{ $data->id }}">Call again</span>
                                @elseif($data->status == '3')
                                    <span class="notinterested status" data-id="{{ $data->id }}">Not Interested</span>
                                @elseif($data->status == '4')
                                    <span class="underprocess status" data-id="{{ $data->id }}">Under Process</span>
                                @elseif($data->status == '5')
                                    <span class="priceissues status" data-id="{{ $data->id }}">Price Issue</span>
                                @else
                                @endif
                            </td>
                            <td>
                                 <!-- Edit Button -->
                                 <a href="{{ route('enquiry.edit', $data->id) }}" class="btn edit-button" title="Edit">
                                    <i class="fas fa-edit"></i>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script>
    $(document).ready(function() {
    
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            
            var packageTypeId = $(this).data('id'); // Get the category ID
            var url = '{{ url("package-type/delete") }}/' + packageTypeId; // Define the URL

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
                            id: packageTypeId 
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'The Package Type has been deleted.',
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