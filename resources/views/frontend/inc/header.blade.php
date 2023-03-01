<header  class="site-header header-style-3 mobile-sider-drawer-menu">

    <div class="sticky-header main-bar-wraper  navbar-expand-lg">
        <div class="main-bar">  
                            
            <div class="container-fluid clearfix"> 
        
                <div class="logo-header">
                    <div class="logo-header-inner logo-header-one">
                        <a href="{{ route('homepage')}}">
                        <img src="{{ asset('assets/images/logo-dark.png')}}" alt="">
                        </a>
                    </div>
                </div>  
                
                <!-- NAV Toggle Button -->
                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar-first"></span>
                    <span class="icon-bar icon-bar-two"></span>
                    <span class="icon-bar icon-bar-three"></span>
                </button> 

                <!-- MAIN Vav -->
                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-center">

                    <ul class=" nav navbar-nav">
                        <li class="has-child"><a href="{{ route('homepage')}}">Home</a></li>
                        <li class="has-child"><a href="{{ route('frontend.job')}}">Jobs</a></li>

                        {{-- <li class="has-child"><a href="javascript:;">Employers</a>
                            <ul class="sub-menu">
                                <li><a href="employer-grid.html">Employers Grid</a></li>
                                <li><a href="employer-list.html">Employers List</a></li>
                                <li class="has-child"><a href="javascript:;">Employers Detail</a>
                                    <ul class="sub-menu">
                                        <li><a href="employer-detail.html">Detail 1</a>
                                        <li><a href="employer-detail-v2.html">Detail 2</a>
                                    </ul> 
                                </li>
                                <li><a href="employer-profile.html">Profile</a></li>
                                <li><a href="employer-resume.html">Resume</a></li>
                                <li><a href="employer-manage-jobs.html">Manage Jobs</a></li>
                                <li><a href="employer-post-job.html">Post A Jobs</a></li>
                                <li><a href="employer-transaction.html">Transaction</a></li>
                                <li><a href="candidate-grid.html">Browse Candidates</a></li>
                                <li><a href="employer-change-password.html">Change Password</a></li>
                                <li><a href="employer-account-fresher.html">Register Fresher</a></li>
                                <li><a href="employer-account-professional.html">Register Professionals</a></li>
                            </ul>                                                                 
                        </li>
                        <li class="has-child"><a href="javascript:;">Pages</a>
                            <ul class="sub-menu">
                                <li><a href="about-1.html">About Us</a></li> 
                                <li><a href="pricing.html">Pricing</a></li> 
                                <li><a href="error-404.html">Error-404</a></li>
                                <li><a href="faq.html">FAQ's</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                                <li><a href="under-maintenance.html">Under Maintenance</a></li>
                                <li><a href="coming-soon.html">Coming soon</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="after-login.html">After Login</a></li>
                                <li><a href="icons.html">Icons</a></li> 
                            </ul>                                                                
                        </li>
                        <li class="has-child"><a href="javascript:;">Candidates</a>
                            <ul class="sub-menu">
                                <li><a href="candidate-grid.html">Candidates Grid</a></li>
                                <li><a href="candidate-list.html">Candidates List</a></li>
                                <li class="has-child"><a href="javascript:;">Candidate Detail</a>
                                    <ul class="sub-menu">
                                        <li><a href="candidate-detail.html">Detail 1</a>
                                        <li><a href="candidate-detail-v2.html">Detail 2</a>
                                    </ul> 
                                </li>
                                <li><a href="candidate-dashboard.html">Dashboard</a></li>
                                <li><a href="candidate-profile.html">My Pfofile</a></li>
                                <li><a href="candidate-jobs-applied.html">Applied Jobs</a></li>
                                <li><a href="candidate-my-resume.html">My Resume</a></li>
                                <li><a href="candidate-saved-jobs.html">Saved Jobs</a></li>
                                <li><a href="candidate-cv-manager.html">CV Manager</a></li>
                                <li><a href="candidate-job-alert.html">Job Alerts</a></li>
                                <li><a href="candidate-change-password.html">Change Passeord</a></li>
                                <li><a href="candidate-chat.html">Chat</a></li>
                            </ul>                                                                
                        </li> --}}

                        <li class="has-child"><a href="{{ route('frontend.blog')}}">Blog</a>
                        <li class="has-child"><a href="{{ route('frontend.country')}}">Country</a></li>
                                                           
                        </li>
                    </ul>

                </div>
                
                <!-- Header Right Section-->
                <div class="extra-nav header-2-nav">
                    
                        
                </div>                            
            
                                            
                
            </div>    
        
        
        </div>

        <!-- SITE Search -->
        <div id="search"> 
            <span class="close"></span>
            <form role="search" id="searchform" action="/search" method="get" class="radius-xl">
                <input class="form-control" value="" name="q" type="search" placeholder="Type to search"/>
                <span class="input-group-append">
                    <button type="button" class="search-btn">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </span>
            </form>
        </div> 
    </div>
    
</header>