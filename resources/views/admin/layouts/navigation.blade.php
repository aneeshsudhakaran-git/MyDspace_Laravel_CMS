<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <!--begin::Brand Image-->
        <img src="{{ asset('admin_asset/assets/img/logo.png') }}" alt="MyDspace Logo" class="brand-image opacity-75 shadow">
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">MyDspace 1.0</span>
        <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (request()->routeIs('admin.dashboard')) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                        Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">CONTENT MANAGEMENT</li>
                <li class="nav-item  {{ ( request()->is('admin/menu') || request()->is('admin/menu/*') || 
                                request()->is('admin/category') || request()->is('admin/category/*') || 
                                 request()->is('admin/site_enquiry') || request()->is('admin/site_enquiry/*') || 
                                request()->is('admin/content') || request()->is('admin/content/*')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                        Site Pages
                        <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.menu') }}" class="nav-link {{ ( request()->is('admin/menu')  || request()->is('admin/menu/*') ) ? 'active' : '' }}">
                                <i class="nav-icon bi bi-menu-button"></i>
                                <p>{{ __('Menu') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}" class="nav-link {{ ( request()->is('admin/category') || request()->is('admin/category/*')) ? 'active' : '' }}">
                                <i class="nav-icon bi bi-bookmark-check"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.content') }}" class="nav-link {{ ( request()->is('admin/content') || request()->is('admin/content/*')) ? 'active' : '' }}">
                                <i class="nav-icon bi bi-journal-richtext"></i>
                                <p>Contents</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.site_enquiry') }}" class="nav-link {{ (request()->routeIs('admin.site_enquiry') || request()->is('admin/site_enquiry/*')) ? 'active' : '' }}">
                                <i class="nav-icon bi bi-envelope-arrow-down"></i>
                                <p>Site Enquiry</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">SETTINGS</li>
                <li class="nav-item">
                    <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ (request()->routeIs('admin.profile.edit')) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>{{ __('My Profile') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.siteconfiguration') }}" class="nav-link {{ (request()->routeIs('admin.siteconfiguration')  || request()->is('admin/siteconfiguration/*')) ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Site Configuration</p>
                    </a>
                </li>
                <li class="nav-item ">&nbsp;</li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}" class="nav-link p-0 d-block">
                        @csrf
                        <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="nav-icon bi bi-box-arrow-in-left"></i>
                            <p>
                            {{ __('Log Out') }}
                            </p>
                        </a>
                    </form>
                </li>
                
                
                
            </ul>
        <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->