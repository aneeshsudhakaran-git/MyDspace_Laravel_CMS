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
                <div class="col-sm-6"><h3 class="mb-0">{{ __('Contents') }}</h3></div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Contents') }}</li>
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
                            <h3 class="card-title mt-1">{{ __('Content List') }}</h3>

                            <div class="card-tools">
                                <form method="GET" action="{{ route('admin.content') }}" class="frmListFilter">
                                    <div class="float-end">
                                        <a href="{{ route('admin.content.create', ['b' => base64_encode(url()->full()) ]); }}" class="btn btn-md btn-secondary me-3" >
                                            <i class="nav-icon bi bi-plus-square me-1" aria-hidden="true"></i> Add New
                                        </a>
                                    </div> 

                                    <div class="float-end me-3">
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
                                        <select  id="catid" name="catid" class="form-select">
                                            <option value="0">Select Category</option>

                                            @foreach($category as $key => $value)
                                                <option value="{{ $key }}" {{ ($key == $catid)? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="float-end me-3">
                                        <select id="menuid" name="menuid" class="form-select">
                                            <option value="0">Select Menu</option>
                                            {!! getMenuOptions(0, '', $menuid) !!}
                                        </select>
                                    </div>

                                    <div class="float-end me-3">
                                        <select id="contentsection" name="contentsection" class="form-select">
                                        <option value="0">Select Content Section</option>
                                        <option value="1" {{ $contentsection == '1' ? 'selected' : '' }}>Main Content</option>
                                        <option value="2" {{ $contentsection == '2' ? 'selected' : '' }}>Footer Content</option>
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
                                    <th class="text-center">Display Order</th>
                                    <th>Created</th>
                                    <th>Last Updated</th>
                                    <th>Status</th>
                                    <th class="text-end"></th>
                                </tr>
                            </thead>
                            <form method="POST" action="{{ route('admin.content.updateorder') }}">
                                @csrf
                            <tbody>
                                @forelse ($contents as $content)
                                    <tr>
                                        <td scope="row">{{ ++$i }}</td>
                                        <td class="text-break text-wrap">{{ $content->title }}
                                            <p>{{ substr($content->short_description, 0, 40) . (strlen($content->short_description) > 40 ? '...' : '') }}</p>
                                        
                                        </td>
                                        <td class="text-center">    
                                            <input
                                                type="number"
                                                name="orders[{{ $content->id }}]"
                                                class="form-control form-control-sm d-inline @error('orders.{$content->id}') is-invalid @enderror"
                                                value="{{ old('orders.{$content->id}', $content->displayorder) }}"
                                                style="width: 80px;"
                                                min="1"
                                            >

                                            @error("orders.{$content->id}")
                                                <div class="invalid-feedback d-block">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($content->created_at)->format('j F, Y g:i:s a') }} </td>
                                        <td>{{ \Carbon\Carbon::parse($content->updated_at)->format('j F, Y g:i:s a') }} </td>
                                        <td>
                                            {!! ($content->status == 'P') ? '<span class="badge text-bg-success">Published</span>' : '<span class="badge text-bg-secondary">UnPublished</span>' !!}
                                            {!! ($content->featured == 1) ? '<span class="badge text-bg-info pr-2 pl-2"> Featured </span>' : '' !!}
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-secondary btn-sm mr-2" href="{{ route('admin.content.edit', [$content->id, 'b' => base64_encode(url()->full())]) }}"> <i class="bi bi-pencil-square"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" 
                                            onclick="return confirm('{{ __('Are you sure you want to delete?') }}')"
                                            href="{{ route('admin.content.delete', [$content->id, 'b' => base64_encode(url()->full())] ) }}"> <i class="bi bi-x-square"></i> Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">There are no data.</td>
                                    </tr>
                                @endforelse
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="text-center"><button type="submit" class="btn btn-secondary btn-sm mb-2"><i class="bi bi-arrow-clockwise"></i> Update Order</button></td>
                                        <td colspan="4"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">{!! $contents->links() !!}</td>

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
        <!-- /.content -->
    </section>

</x-appadmin-layout>