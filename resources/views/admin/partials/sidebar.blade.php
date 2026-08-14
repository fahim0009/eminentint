<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img  src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img  src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="" height="25">
            </span>
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img  src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img  src="{{ asset('uploads/company/' . $company->company_logo) }}" alt="" height="25">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item d-none">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-share-line"></i> <span data-key="t-multi-level">Multi Level</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-level-1.1"> Level 1.1 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAccount"
                                    data-key="t-level-1.2"> Level
                                    1.2
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-2.1">
                                                Level 2.1 </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCrm" class="nav-link"
                                                data-bs-toggle="collapse" role="button"
                                                aria-expanded="false" aria-controls="sidebarCrm"
                                                data-key="t-level-2.2"> Level 2.2
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link"
                                                            data-key="t-level-3.1"> Level 3.1
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link"
                                                            data-key="t-level-3.2"> Level 3.2
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @php
                    $productActive = Route::is(
                        'allempladv',
                        'allrecstep',
                        'alltrackrec',
                    );
                @endphp

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $productActive ? 'active' : '' }}" 
                      href="#sidebarAllProducts" data-bs-toggle="collapse" role="button"
                      aria-expanded="{{ $productActive ? 'true' : 'false' }}" 
                      aria-controls="sidebarAllProducts">
                        <i class="ri-shopping-bag-3-line"></i> <span>Employers Zone</span>
                    </a>

                    <div class="collapse menu-dropdown {{ $productActive ? 'show' : '' }}" id="sidebarAllProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('allempladv') }}" 
                                  class="nav-link {{ Route::is('allempladv') ? 'active' : '' }}">Employer Adv</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allrecstep') }}" 
                                  class="nav-link {{ Route::is('allrecstep') ? 'active' : '' }}">Recruitment</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('alltrackrec') }}" 
                                  class="nav-link {{ Route::is('alltrackrec') ? 'active' : '' }}">Track Record</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contacts.index') }}" class="nav-link {{ Route::is('contacts.index') ? 'active' : '' }}">
                        <i class="ri-mail-open-line"></i>
                        <span>Contact Messages</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                        <i class="ri-user-3-line"></i>
                        <span>Customers</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.index') }}" class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}">
                        <i class="ri-user-3-line"></i>
                        <span>Admin</span>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a href="{{ route('alljoblisting') }}" class="nav-link {{ Route::is('alljoblisting') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>Job List</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('allcountry') }}" class="nav-link {{ Route::is('allcountry') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>Country</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('alllicense') }}" class="nav-link {{ Route::is('alllicense') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>License</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('allgallerycat') }}" class="nav-link {{ Route::is('allgallerycat') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>Gallery Category</span>
                    </a>
                </li>
                
                
                <li class="nav-item">
                    <a href="{{ route('allgallery') }}" class="nav-link {{ Route::is('allgallery') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>Galleries</span>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a href="{{ route('allindustry') }}" class="nav-link {{ Route::is('allindustry') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>Industry</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('allservice') }}" class="nav-link {{ Route::is('allservice') ? 'active' : '' }}">
                        <i class="ri-image-line"></i>
                        <span>Services</span>
                    </a>
                </li>

                @php
                    $settingsRoute = Route::is(
                        'admin.companyDetails',
                        'admin.company.seo-meta',
                        'allmilestone',
                        'admin.privacy-policy',
                        'admin.terms-and-conditions',
                        'faq.index',
                        'admin.mail-body',
                        'sections.index',
                        'about.index',
                        'allslider',
                        'admin.home-footer',
                        'admin.copyright'
                    );
                @endphp

                <li class="nav-item">
                    <a class="nav-link menu-link {{ $settingsRoute ? 'active' : '' }}" 
                      href="#sidebarSettings" data-bs-toggle="collapse" role="button" 
                      aria-expanded="{{ $settingsRoute ? 'true' : 'false' }}" 
                      aria-controls="sidebarSettings">
                        <i class="ri-settings-3-line"></i> <span>Settings</span>
                    </a>

                    <div class="collapse menu-dropdown {{ $settingsRoute ? 'show' : '' }}" id="sidebarSettings">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.companyDetails') }}" 
                                  class="nav-link {{ Route::is('admin.companyDetails') ? 'active' : '' }}">Company Details</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.company.seo-meta') }}" 
                                  class="nav-link {{ Route::is('admin.company.seo-meta') ? 'active' : '' }}">SEO</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allmilestone') }}" 
                                  class="nav-link {{ Route::is('allmilestone') ? 'active' : '' }}">Milestone</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about.index') }}" 
                                  class="nav-link {{ Route::is('about.index') ? 'active' : '' }}">About Page</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.privacy-policy') }}" 
                                  class="nav-link {{ Route::is('admin.privacy-policy') ? 'active' : '' }}">Privacy Policy</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.terms-and-conditions') }}" 
                                  class="nav-link {{ Route::is('admin.terms-and-conditions') ? 'active' : '' }}">Terms & Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.mail-body') }}" 
                                  class="nav-link {{ Route::is('admin.mail-body') ? 'active' : '' }}">Mail Body</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.home-footer') }}" 
                                  class="nav-link {{ Route::is('admin.home-footer') ? 'active' : '' }}">Home Footer</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.copyright') }}" 
                                  class="nav-link {{ Route::is('admin.copyright') ? 'active' : '' }}">Copyright</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('sections.index') }}" 
                                  class="nav-link {{ Route::is('sections.index') ? 'active' : '' }}">Section Settings</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('faq.index') }}" 
                                  class="nav-link {{ Route::is('faq.index') ? 'active' : '' }}">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('hero.index') }}" 
                                  class="nav-link {{ Route::is('hero.index') ? 'active' : '' }}">Hero Section
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('allherostat') }}" 
                                  class="nav-link {{ Route::is('allherostat') ? 'active' : '' }}">Hero State
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>