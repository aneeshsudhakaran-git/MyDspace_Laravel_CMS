<x-appadmin-layout>
        <div class="content-wrapper">
          
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">{{ __('Site Configuration') }}</h3></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Site Configuration</li>
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
                    <div class="col-md-6">
                    <div class="card card-secondary card-outline mb-4">
                            <form method="POST" action="{{ route('admin.siteconfiguration.edit', $config->id) }}">
                              @csrf

                                <div class="card-header">
                                    <h3 class="card-title"> {{ __('View | Edit Site Configuration') }}</h3>
                                </div>
                        
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="config_title" class="col-form-label">Config Title</label>
                                            <input type="text" 
                                            value="{{ $config->config_title}}"
                                            id="config_title" name="config_title" class="@error('config_title') is-invalid @enderror form-control" placeholder="home" required />
                                            @error('config_title')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="config_name" class="col-form-label">Config Name</label>
                                            <input type="text" 
                                                value="{{ $config->config_name}}"
                                                id="config_name" name="config_name" class="form-control" placeholder="home" disabled readonly />
                                        </div>
                                         
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="config_value" class="col-form-label">Description</label>
                                            <textarea id="config_value" name="config_value" rows="10"
                                                class="@error('config_value') is-invalid @enderror form-control" placeholder="Config Value">{{ $config->config_value }}</textarea>
                                            @error('config_value')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror

                                            <div class="callout callout-danger p-2 mt-3">
                                                <h5>Warning: </h5>
                                                <p class="fs-6">Changing site configuration values can impact functionality. Proceed with caution.</p>
                                            </div>
                                        </div>
                                        
                                    </div>  
                                </div>

                                <!-- /.card-body -->
                                <div class="card-footer text-end">
                                    <input type="hidden" name="b" value="{{ request()->query('b') }}" />
                                    <a href="{{ base64_decode(request()->query('b')) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button> 
                                </div>
                            </form>
                    
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>

</x-appadmin-layout>
 


 
