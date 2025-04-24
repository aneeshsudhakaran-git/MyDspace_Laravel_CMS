<x-appadmin-layout>

  <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{ __('Dashboard') }}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
                </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->

    <!-- Main content -->
    <section class="content"> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-secondary card-outline mb-4">
                        <!--begin::Body-->
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-secondary shadow-sm">
                                            <i class="bi bi-menu-button"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <a href="{{ route('admin.menu') }}" class="nav-link">
                                                    {{ __('Menu') }}
                                                </a>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-secondary shadow-sm">
                                            <i class="bi bi-bookmark-check"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <a href="{{ route('admin.category') }}" class="nav-link">
                                                    {{ __('Category') }}
                                                </a>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->

                                <!-- <div class="clearfix hidden-md-up"></div> -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-secondary shadow-sm">
                                            <i class="bi bi-journal-richtext"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <a href="{{ route('admin.content') }}" class="nav-link">
                                                    {{ __('Contents') }}
                                                </a>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-secondary shadow-sm">
                                            <i class="bi bi-envelope-arrow-down"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <a href="{{ route('admin.site_enquiry') }}" class="nav-link">
                                                    {{ __('Site Enquiry') }}
                                                </a>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-secondary shadow-sm">
                                            <i class="bi bi-person-lines-fill"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <a href="{{ route('admin.profile.edit') }}" class="nav-link">
                                                    {{ __('My Profile') }}
                                                </a>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-secondary shadow-sm">
                                            <i class="bi bi-gear"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <a href="{{ route('admin.siteconfiguration') }}" class="nav-link">
                                                    {{ __('Site Configuration') }}
                                                </a>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                
                                <!-- /.col -->
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="info-box">
                                        <span class="info-box-icon text-bg-danger shadow-sm">
                                            <i class="bi bi-box-arrow-in-left"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text fs-4">
                                                <form method="POST" action="{{ route('admin.logout') }}" class="nav-link p-0 d-block">
                                                    @csrf
                                                    <a href="{{ route('admin.logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form> 
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>

                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>
            
        </div>

    </section>
    <!-- /.content -->
</x-appadmin-layout>

 