<!DOCTYPE html>
<html lang="en">
<style>
    a{
        color: #f2dede!important;
    }
    a:hover{
        color: #FFFFFF!important;
    }
    table{
        color: #FFFFFF!important;
    }
</style>

<head>

    <meta charset="utf-8">
    <meta name="author" content="templatemo">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Liberty NFT Marketplace - HTML CSS Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/templatemo-liberty-market.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <!--

    TemplateMo 577 Liberty Market

    https://templatemo.com/tm-577-liberty-market

    -->
</head>

<body>

<!-- ***** Preloader Start ***** -->
@include('frontend.preloader')
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
@include('frontend.header')
<!-- ***** Header Area End ***** -->

@yield('content')

@include('frontend.footer')


<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<script src="{{asset('assets/js/isotope.min.js')}}"></script>
<script src="{{asset('assets/js/owl-carousel.js')}}"></script>

<script src="{{asset('assets/js/tabs.js')}}"></script>
<script src="{{asset('assets/js/popup.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>

</body>
</html>
