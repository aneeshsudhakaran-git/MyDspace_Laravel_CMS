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
                <div class="col-sm-6"><h3 class="mb-0">{{ __('Menu') }}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Menu') }}</li>
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
                        <h3 class="card-title mt-1">{{ __('Menu List') }}</h3>


                        <div class="card-tools">
                            <form method="GET" action="{{ route('admin.menu') }}" class="frmListFilter">
                                <div class="float-end">
                                    <a href="{{ route('admin.menu.create', ['b' => base64_encode(url()->full()) ]); }}" class="btn btn-md btn-secondary me-3" >
                                        <i class="nav-icon bi bi-plus-square me-1" aria-hidden="true"></i> Add New
                                    </a>
                                </div>
                                
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
                                <div class="float-end me-3">
                                    <select id="menutype" name="menutype" class="form-select">
                                    <option value="0" {{ ( old( 'menutype' ) == 0 || $menutype == 0 )  ? 'selected' : '' }}>Select All Menu</option>
                                    <option value="1" {{ ( old( 'menutype' ) == 1 || $menutype == 1 )  ? 'selected' : '' }}>Main Menu</option>
                                        <option value="2" {{ ( old( 'menutype' ) == 2 || $menutype == 2 )  ? 'selected' : '' }}>Footer Menu</option>
                                    </select>
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
                                <th>Title</th>
                                <th>Name</th>
                                <th>Parent Menu</th>
                                <th class="text-center">Link Type</th>
                                <th class="text-center">Display Order</th>
                                <th>Created</th>
                                <th>Last Updated</th>
                                <th>Status</th>
                                <th class="text-end"></th>
                            </tr>
                        </thead>
                        <form method="POST" action="{{ route('admin.menu.updateorder') }}">
                            @csrf
                            <tbody>
                                @forelse ($menus as $menu)
                                <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $menu->title }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ $menu->parent_menu_title }}</td>
                                        <td class="text-center">
                                            {!! ($menu->link_type == 'S') ? '<span class="badge rounded-pill text-bg-light">Self</span>' : '' !!} 
                                            {!! ($menu->link_type == 'N') ? '<span class="badge rounded-pill text-bg-secondary">New Page</span>' : '' !!}
                                            {!! ($menu->link_type == 'T') ? '<span class="badge rounded-pill text-bg-info">Open in New Tab</span>' : '' !!}
                                        </td>
                                        <td class="text-center">
                                            <input
                                                type="number"
                                                name="orders[{{ $menu->id }}]"
                                                class="form-control form-control-sm d-inline @error("orders.{$menu->id}") is-invalid @enderror"
                                                value="{{ old("orders.{$menu->id}", $menu->displayorder) }}"
                                                style="width: 80px;"
                                                min="1"
                                            >

                                            @error("orders.{$menu->id}")
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($menu->created_at)->format('j F, Y g:i:s a') }} </td>
                                        <td>{{ \Carbon\Carbon::parse($menu->updated_at)->format('j F, Y g:i:s a') }} </td>
                                        <td>
                                            <div>{!! ($menu->status == 'P') ? '<span class="badge text-bg-success">Published</span>' : '<span class="badge bg-light text-dark">UnPublished</span>' !!}</div>
                                            <div>{!! ($menu->menutype == 1) ? '<span class="badge text-bg-warning pr-2 pl-2"> Main Menu </span>' : '' !!}</div>
                                            <div>{!! ($menu->menutype == 2) ? '<span class="badge bg-dark pr-2 pl-2"> Footer Menu </span>' : '' !!}</div>
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-secondary btn-sm mr-2" href="{{ route('admin.menu.edit', [$menu->id, 'b' => base64_encode(url()->full())]) }}"> <i class="bi bi-pencil-square"></i> Edit</a> 
                                            <a class="btn btn-danger btn-sm" 
                                            onclick="return confirm('{{ __('Are you sure you want to delete?') }}')"
                                            href="{{ route('admin.menu.delete', [$menu->id, 'b' => base64_encode(url()->full())] ) }}"> <i class="bi bi-x-square"></i> Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr>
                                @endforelse
                                    <tr>
                                        <td colspan="5"></td>
                                        <td class="text-center"><button type="submit" class="btn btn-secondary btn-sm mb-2"><i class="bi bi-arrow-clockwise"></i> Update Order</button></td>
                                        <td colspan="4"></td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="10">{!! $menus->links() !!}</td>
                                    </tr> 
                                </tbody>
                            </form>
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