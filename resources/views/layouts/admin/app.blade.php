<!DOCTYPE html>

<html lang="en">



<head>

<meta charset="utf-8">

    <title>sevensafar - Admin</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="keywords">

    <meta content="" name="description">

    <meta name="csrf-token" content="{{ csrf_token() }}">



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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet"> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

</head>



<body>

 

@include('layouts.admin.header')

            <!-- Include Sidebar -->

                @include('layouts.admin.sidebar')



            <!-- Main Content -->

                @yield('content')

       



       



      





       

    </div>



    <!-- JavaScript Libraries -->

     



 <!-- JavaScript Libraries -->



    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{asset('public/admin/lib/chart/chart.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/easing/easing.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/waypoints/waypoints.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/tempusdominus/js/moment.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>

    <script src="{{asset('public/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Template Javascript -->

    <script src="{{asset('public/admin/js/main.js')}}"></script>

   

</body>



</html>