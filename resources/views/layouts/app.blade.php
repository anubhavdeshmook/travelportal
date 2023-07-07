<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" media="all" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">

    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.multiselect.css') }}" rel="stylesheet">

    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <script>
         function openNav() {
            document.getElementById("myNav").style.width = "100%"; 
          }
          
          function closeNav() {
            document.getElementById("myNav").style.width = "0%";
          }
      </script>  
    <script src="{{ asset('js/owl.carousel-min.js') }}"></script> 
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <!--<script src="{{ asset('js/custom.js') }}"></script>-->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/jquery.multiselect.js') }}"></script>
    

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



        
</head>
    <body>
    <?php  
    $routeAction = explode('@',\Route::currentRouteAction());

    $add_innner_header_class = '';
    if(isset($routeAction[1]) && $routeAction[1] != 'index')
    {
        $add_innner_header_class = 'inner-header';
    }

    ?>
        <div class="header-outer <?php echo $add_innner_header_class;?>">
            <!-- header -->
                @include('layouts.elements.header')
            <!-- header -->

            @if(!empty($routeAction[1]) && $routeAction[1] == 'index')
            <!-- banner-section -->
                @include('layouts.elements.banner')
            <!-- banner-section -->
            @endif
            
        </div>

        @yield('content')

        <!-- footer -->
            @include('layouts.elements.footer')
        <!-- footer -->
    </body>
</html>
