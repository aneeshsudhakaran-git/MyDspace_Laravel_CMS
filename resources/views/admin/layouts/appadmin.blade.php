<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AdminLTE v4 | Dashboard</title>

    <!-- Favicons -->
    <link href="{{ asset('admin_asset/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('admin_asset/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="MyDspace | Dashboard" />
    <meta name="author" content="MyDspace" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('/admin_asset/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
    
   

    @stack('styles')  {{-- This will include styles when pushed --}}


  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary" data-baseurl="{{ url('/') }}">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer"></i> Dashboard</a></li>
            <li class="nav-item d-none d-md-block"><a href="{{ route('home') }}" class="nav-link" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Site Preview</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              @if(isset(Auth::user()->image) &&  Auth::user()->image != '')
                <img
                  src="{{ asset('storage/profile-images/'.Auth::user()->image ) }}"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                @else
                    <i class="bi bi-person-circle user-image fs-5"></i>
                @endif
                <span class="d-none d-md-inline">{{ Auth::user()->name }} </span> <i class="bi bi-caret-down-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-secondary">
                  @if(isset(Auth::user()->image) &&  Auth::user()->image != '')
                  <img
                    src="{{ asset('storage/profile-images/'.Auth::user()->image ) }}"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  @else
                    <i class="bi bi-person-circle fs-1"></i>
                  @endif
                  <p>
                    {{ Auth::user()->name }}
                    <small>Member since  {{ Auth::user()->created_at->format('F Y') }}</small>
                  </p>
                </li>
                <!--end::User Image-->
                
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-secondary mb-2">
                    <i class="nav-icon bi bi-person-lines-fill"></i> {{ __('My Profile') }}
                  </a>

                  <form method="POST" action="{{ route('admin.logout') }}" class="float-end p-0 d-block">
                      @csrf
                      <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger mb-2" onclick="event.preventDefault(); this.closest('form').submit();">
                          <i class="nav-icon bi bi-box-arrow-in-left"></i> {{ __('Log Out') }}
                      </a>
                  </form>
                  
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      
      <!-- Main Sidebar Container -->
      @include('admin.layouts.navigation')

      <!--begin::App Main-->
      <main class="app-main">
        
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
           
          {{ $slot }}



           
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
 
 
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline"> 
          <!--end::To the end-->
          <!--begin::Copyright-->
          <strong>
            Copyright &copy; {{ date("Y") }} &nbsp;
            <a href="https://mydspace.in" class="text-decoration-none">MyDspace.in</a>.
          </strong>
          All rights reserved.
          <!--end::Copyright-->
        </div>
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
   
    <!-- jQuery -->
    <script src="{{ asset('admin_asset/plugins/jquery/jquery.min.js') }}"></script>

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('/admin_asset/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
        
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
      
    @stack('scripts') {{-- This will include scripts when pushed --}}
  </body>
  <!--end::Body-->
</html>
