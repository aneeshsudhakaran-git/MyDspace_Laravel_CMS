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
        <div class="col-sm-6"><h3 class="mb-0">{{ __('Category') }}</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Category') }}</li>
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
                    <h3 class="card-title mt-1">{{ __('Category List') }}</h3>
                    <form method="GET" action="{{ route('admin.category') }}" class="frmListFilter">
                      <div class="card-tools"> 
                          <div class="float-end">
                            <a href="{{ route('admin.category.create', ['b' => base64_encode(url()->full()) ]); }}" class="btn btn-md btn-secondary" >
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
                        
                      </div>
                    </form>
                  </div>
                          <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                          <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th class="text-center">Display Order</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                            <th>Status</th>
                            <th scope="col" class="text-end"></th>
                          </tr>
                      </thead>
                      <form method="POST" action="{{ route('admin.category.updateorder') }}">
                        @csrf
                        <tbody>
                          @forelse ($categories as $category)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $category->category }}</td>
                                <td class="text-break text-wrap">{{ $category->description }}</td>
                                <td class="text-center">    
                                  <input
                                      type="number"
                                      name="orders[{{ $category->id }}]"
                                      class="form-control form-control-sm d-inline @error('orders.{$category->id}') is-invalid @enderror"
                                      value="{{ old('orders.{$category->id}', $category->displayorder) }}"
                                      style="width: 80px;"
                                      min="1"
                                        
                                  >

                                    @error("orders.{$category->id}")
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    
                                </td>
                                <td>{{ \Carbon\Carbon::parse($category->created_at)->format('j F, Y g:i:s a') }} </td>
                                <td>{{ \Carbon\Carbon::parse($category->updated_at)->format('j F, Y g:i:s a') }} </td>
                                <td>{!! ($category->status == 'P') ? '<span class="badge text-bg-success">Published</span>' : '<span class="badge bg-light text-dark">UnPublished</span>' !!}</td>
                                <td class="text-end">
                                  <a class="btn btn-secondary btn-sm mr-2" href="{{ route('admin.category.edit', [$category->id, 'b' => base64_encode(url()->full())]) }}"> <i class="bi bi-pencil-square"></i> Edit</a>
                                  <a class="btn btn-danger btn-sm" 
                                  onclick="return confirm('{{ __('Are you sure you want to delete?') }}')"
                                  href="{{ route('admin.category.delete', [$category->id, 'b' => base64_encode(url()->full())] ) }}"> <i class="bi bi-x-square"></i> Delete</a>
                                </td>
                              </tr>
                            @empty
                                <tr>
                                    <td colspan="8">There are no data.</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-center"><button type="submit" class="btn btn-secondary btn-sm mb-2"><i class="bi bi-arrow-clockwise"></i> Update Order</button></td>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="8">{!! $categories->links() !!}</td>

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