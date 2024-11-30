<!DOCTYPE html>

<html lang="en">



<head>

    <title>Sevensafar - Tour & Travels</title>
    <meta name="google-site-verification" content="WYLaoWmB_hrMvq5XMj-929IIz9AMBA_-iPBAeMcPLqY">

    <!--== META TAGS ==-->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- FAV ICON -->

    <link rel="shortcut icon" href="{{asset('public/front/image/favicon.png')}}">

    <!-- GOOGLE FONTS -->

    <link href="https://fonts.googleapis.com/css?family=Poppins%7CQuicksand:400,500,700" rel="stylesheet">

    <!-- FONT-AWESOME ICON CSS -->

    <link rel="stylesheet" href="{{asset('public/front/css/font-awesome.min.css')}}">

    <!--== ALL CSS FILES ==-->

    <link rel="stylesheet" href="{{asset('public/front/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/style.css?v=23.0')}}">

    <!-- <link rel="stylesheet" href="css/styles.css?v=4.0"> -->

    <link rel="stylesheet" href="{{asset('public/front/css/jquery-ui.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/mob.css')}}">

    <link rel="stylesheet" href="{{asset('public/front/css/animate.css')}}">

    <link rel="stylesheet" href="path/to/styles.css">


    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"

        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"

        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

    </script>
    <script src="{{asset('public/front/js/slick.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

   

</head>



<body>

<div id="preloader">

        <div id="status">&nbsp;</div>

    </div>

    <div class="pop-bg"></div>

    



    @include('layouts.front.header')





    @yield('content')





    @include('layouts.front.footer')

















    <!--========= Scripts ===========-->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="{{asset('public/front/js/jquery-latest.min.js')}}"></script>

    <script src="{{asset('public/front/js/bootstrap.js')}}"></script>

    <script src="{{asset('public/front/js/jquery-ui.js')}}"></script>

    <script src="{{asset('public/front/js/wow.min.js')}}"></script>

    <script src="{{asset('public/front/js/select-opt.js')}}"></script>

    <!-- <script src="{{asset('public/front/js/slick.js')}}"></script> -->

    <script src="{{asset('../public/front/js/custom.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>

$('.multiple-items').slick({
    dots: true,
    arrows: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    fade: true, // This allows smoother transitions between slides
    responsive: [{
        breakpoint: 992,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: false,
        }
    }]
});

    $('.tourpackage').slick({

        dots: true,

        arrows: false,

        infinite: false,

        slidesToShow: 2,

        slidesToScroll: 1,

        autoplay: true,

        autoplaySpeed: 3000,

        responsive: [{

            breakpoint: 992,

            settings: {

                slidesToShow: 1,

                slidesToScroll: 1,

                centerMode: false,

            }

        }]



    });



    $('.offerpackage').slick({

        dots: true,

        arrows: false,

        infinite: false,

        slidesToShow: 2,

        slidesToScroll: 1,

        autoplay: true,

        autoplaySpeed: 3000,

        responsive: [{

            breakpoint: 992,

            settings: {

                slidesToShow: 1,

                slidesToScroll: 1,

                centerMode: false,

            }

        }]



    });

    </script>



</body>



</html>