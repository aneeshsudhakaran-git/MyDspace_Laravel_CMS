<x-appadmin-layout>
  <div class="content-wrapper">
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
                <div class="row">
                    <div class="col-md-6">
                      <div class="card card-secondary card-outline mb-4">
                          <form method="POST" action="{{ route('admin.category.edit', $category->id) }}">
                              @csrf

                                <div class="card-header">
                                    <h3 class="card-title"> {{ __('Edit Category') }}</h3>
                                </div>
                        
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="category" class="col-form-label">Category</label>
                                              <input type="text"
                                               value="{{ $category->category }}"
                                               id="category" name="category" class="@error('category') is-invalid @enderror form-control" placeholder="Category" required />
                                              @error('category')
                                                  <div class="form-text text-danger">{{ $message }}</div>
                                              @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label for="description" class="col-form-label">Description</label>
                                              <input type="text"
                                              value="{{ $category->description }}"
                                              id="description" name="description" class="form-control"   />
                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="displayorder" class="col-form-label">Display Order</label>
                                                <input type="number" 
                                                value="{{ $category->displayorder }}"
                                                id="displayorder" name="displayorder" class="@error('displayorder') is-invalid @enderror form-control" placeholder="1" maxlength="3" required />
                                                @error('displayorder')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status" class="col-form-label">Select Category Status</label>
                                                <select id="status" name="status" class="form-control">
                                                  <option value="P" {{ ($category->status == 'P') ? 'selected' : '' }}>Published</option>
                                                  <option value="U"  {{ ($category->status == 'U') ? 'selected' : '' }}>UnPublished</option>
                                                </select>
                                                @error('status')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
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
 