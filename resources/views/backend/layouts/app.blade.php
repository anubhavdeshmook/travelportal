<!DOCTYPE html>
<html dir="ltr" lang="en">
@include('backend.layouts.head')

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
	@include('backend.layouts.nav')	
	@include('backend.layouts.sidebar')
    {{-- @include('backend.layouts.breadcrumb') --}}
	@yield('content')
	@include('backend.layouts.footer')
</body>

</html>