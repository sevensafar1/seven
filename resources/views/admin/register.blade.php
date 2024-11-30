<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <title>sevensafar</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="keywords">

    <meta content="" name="description">



    <!-- Favicon -->

    <link href="img/favicon.ico" rel="icon">



    <!-- Google Web Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    

    <!-- Icon Font Stylesheet -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Libraries Stylesheet -->

    <link href="{{asset('public/admin/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <link href="{{asset('public/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />



    <!-- Customized Bootstrap Stylesheet -->

    <link href="{{asset('public/admin/css/bootstrap.min.css')}}" rel="stylesheet">



    <!-- Template Stylesheet -->

    <link href="{{asset('public/admin/css/style.css')}}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

</head>



<body>

    <div class="container-xxl position-relative bg-white d-flex p-0">

        <!-- Spinner Start -->

        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">

            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">

                <span class="sr-only">Loading...</span>

            </div>

        </div>

        <!-- Spinner End -->



        <!-- Sign Up Start -->

        <div class="container-fluid">

            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">

                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">

                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">

                        <div class="d-flex align-items-center justify-content-between mb-3">

                            <h3>Sign Up</h3>

                        </div>



                        <form id="registerForm" action="{{ route('register') }}" method="POST">

                            @csrf 

                            

                            <div class="form-floating mb-3">

                                <input type="text" class="form-control" id="username" name="name" placeholder="Username">

                                <label for="username">Username</label>

                                <span id="username_error" class="text-danger"></span>

                            </div>



                           



                            <div class="form-floating mb-3">

                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">

                                <label for="email">Email address</label>

                                <span id="email_error" class="text-danger"></span>

                            </div>



                            <div class="form-floating mb-4">

                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                                <label for="password">Password</label>

                                <span id="password_error" class="text-danger"></span>

                            </div>



                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>

                        </form>



                        <p class="text-center mb-0">Already have an Account? <a href="{{route('login')}}">Sign In</a></p>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- JavaScript Libraries -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>



    <!-- Additional Libraries (required after jQuery is loaded) -->

    <script src="{{asset('public/admin/lib/chart/chart.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/easing/easing.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/waypoints/waypoints.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/tempusdominus/js/moment.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>



    <!-- Custom Template Javascript -->

    <script src="{{asset('public/admin/js/main.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <!-- Custom jQuery Form Submission Script -->

    <script>

        $(document).on('submit', 'form#registerForm', function(event) {

            event.preventDefault(); // Prevent default form submission

            $('#loading').css('display', ''); // Show loading indicator

            var form = $(this);

            var data = new FormData($(this)[0]); // Gather form data

            var url = form.attr("action"); // Get form action URL



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

                        toastr.success(response.success); // Show success message

                        window.setTimeout(function() {

                             // Redirect on success

                        }, 2000);

                    }

                },

                error: function(err) {

                    if (err.status === 422) { // Handle validation errors

                        $('#loading').css('display', 'none');

                        var error = $.parseJSON(err.responseText);

                        $.each(error.errors, function(key, val) {

                            $("#" + key + "_error").text(val); // Display validation error

                        });

                    }

                }

            });



            event.stopImmediatePropagation();

            return false; // Prevent further event handling

        });

    </script>

</body>



</html>

