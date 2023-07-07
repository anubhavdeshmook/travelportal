<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Personal</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Main </span>
                            </a>
                        </li>
                    </ul>
                </li>

            
                 
                   
                        <li class="sidebar-item">
                            <a href="{{ route('admin.email') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu"> Email Templates </span>
                            </a>
                        </li>              
                        <li class="sidebar-item ">
                            <a href="{{ route('admin.user') }}" class="sidebar-link">
                                <i class="fa fa-user"></i>
                                <span class="hide-menu"> Users </span>
                            </a>
                        </li>
                    

                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-database"></i>
                                <span class="hide-menu">Master </span>
                            </a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.destination') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Destination </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.destination.page') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Destination Page </span>
                                    </a>
                                </li>
                                

                                <li class="sidebar-item">
                                    <a href="{{ route('admin.currency') }}" class="sidebar-link">
                                        <i class="mdi mdi-adjust"></i>
                                        <span class="hide-menu"> Currency </span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                        <li class="sidebar-item ">
                            <a href="{{ route('admin.offers') }}" class="sidebar-link">
                                <i class="fa fa-gift"></i>
                                <span class="hide-menu"> Offer Manager </span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{ route('admin.commission') }}" class="sidebar-link">
                                <i class="fa fa-percent"></i>
                                <span class="hide-menu"> Commision Manager </span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{ route('admin.testimonials') }}" class="sidebar-link">
                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                <span class="hide-menu"> Testimonials Manager </span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="{{ route('admin.enquries') }}" class="sidebar-link">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                <span class="hide-menu"> Enquiry Manager </span>
                            </a>
                        </li>
                   
                        <li class="sidebar-item ">
                            <a href="{{ route('admin.booking') }}" class="sidebar-link">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                                <span class="hide-menu"> Booking </span>
                            </a>
                        </li>
              
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">