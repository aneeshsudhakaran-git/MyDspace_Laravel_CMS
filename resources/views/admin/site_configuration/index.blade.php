@pushOnce('scripts')
    <script src="{{ asset('/admin_asset/js/content.js') }}"></script>
@endPushOnce

<x-appadmin-layout>
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">{{ __('Site Configuration') }}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Site Configuration') }}</li>
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
            @session('success')
            <div class="alert alert-success ml-2 mr-2 alert-dismissible fade show" role="alert">
                <i class="bi bi-check2-square"></i>
                {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession

            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Site Configuration List</h3> 
                            
                            <div class="card-tools">
                                <form method="GET" action="{{ route('admin.siteconfiguration') }}" class="frmListFilter">
                                    <div class="float-end">
                                        <div class="input-group m-0">
                                            <input type="text" id="search" name="search" value="{{ old('search', $search ) }}" class="form-control" placeholder="Enter Search Text..." />
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-secondary">Search</button>
                                            </span>

                                            <span class="input-group-append ms-2 me-3">
                                                <input class="btn btn-outline-secondary frmResetButton" type="reset" value="Reset" />
                                            </span>
                                        </div>
                                        
                                    </div> 
                                </form>
                            </div>
                            
                        </div> 

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Config Title</th>
                                <th>config Name</th>
                                <th>Last Updated</th>
                                <th class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siteconfig as $config)
                            <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $config->config_title }}</td>
                                    <td>{{ $config->config_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($config->updated_at)->format('j F, Y g:i:s a') }} </td>
                                    <td class="text-end">
                                        <a class="btn btn-secondary btn-sm mr-2" href="{{ route('admin.siteconfiguration.edit', [$config->id, 'b' => base64_encode(url()->full())]) }}">  <i class="bi bi-pencil-square"></i> Edit | View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">There are no data.</td>
                                </tr>
                            @endforelse
                            
                                <tr>
                                    <td colspan="5">{!! $siteconfig->links() !!}</td>

                                </tr> 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div> 
    </section>
    <!-- /.content -->
</x-appadmin-layout>