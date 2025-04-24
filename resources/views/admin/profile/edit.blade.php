<x-appadmin-layout>
        <div class="content-wrapper">
          
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{ __('Profile') }}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Profile') }}</li>
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
                <div class="row mb-2">
                    <div class="col-md-5"> 
                            @include('admin.profile.partials.update-profile-information-form') 
                            @include('admin.profile.partials.update-password-form')
                    </div> 
                </div> 

            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>

</x-appadmin-layout>
 