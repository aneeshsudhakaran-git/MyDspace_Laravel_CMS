@pushOnce('scripts')
    <script src="{{ asset('/admin_asset/plugins/tinymce/tinymce.min.js') }}"></script>
    
    <!-- Include Dropzone -->
    <script src="{{ asset('/admin_asset/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('/admin_asset/js/mediamanager.js') }}"></script>
@endPushOnce

@push('styles')
    <link rel="stylesheet" href="{{ asset('/admin_asset/plugins/dropzone/dropzone.min.css') }}" >
@endpush

<x-appadmin-layout>
    <div class="content-wrapper">
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
            @session('error')
            <div class="alert alert-danger ml-2 mr-2 alert-dismissible fade show" role="alert">
                <i class="bi bi-check2-square"></i>
                {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endsession

                <form method="POST" action="{{ route('admin.content.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-md-5">
                            <div class="card card-secondary card-outline mb-4">
                                
                                    <div class="card-header">
                                        <h3 class="card-title"> {{ __('Add Content') }}</h3>
                                    </div>
                            
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="title" class="col-form-label">Title</label>
                                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror form-control" placeholder="Home" required />
                                                @error('title')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                        
                                            <div class="col-md-6">
                                                <label for="category" class="col-form-label">Select Category</label>
                                                <select id="category" name="category" class="form-select">
                                                    <option value="">Select Category</option>

                                                    @foreach($category as $key => $value)
                                                        <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('category')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="menu" class="col-form-label">Select Menu</label>
                                                <select id="menu" name="menu" class="form-select">
                                                    <option value="0">Select Menu</option>
                                                    {!! getContentMenuOptions(0, '', old('menu') ) !!}
                                                </select>
                                                @error('menu')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="content_section" class="col-form-label">Content Section</label>
                                                <select id="content_section" name="content_section" class="form-select">
                                                <option value="1" {{ old('content_section') == '1' ? 'selected' : '' }}>Main Content</option>
                                                <option value="2" {{ old('content_section') == '2' ? 'selected' : '' }}>Footer Content</option>
                                                </select>
                                                @error('content_section')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="download_file_title" class="col-form-label">Download File Title</label>
                                                <input type="text" id="download_file_title" name="download_file_title" value="{{ old('download_file_title') }}" class="form-control" placeholder="Download File" />
                                                @error('download_file_title')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        
                                            <div class="col-md-6">
                                                <label for="download_file" class="col-form-label">Download File (pdf only)</label>

                                                <div class="input-group @error('download_file') is-invalid @enderror ">
                                                    <input type="file" class="form-control" id="download_file" name="download_file">
                                                </div>
                                                @error('download_file')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div> 
                                            <div class="col-md-6">
                                                <label for="status" class="col-form-label">Select Content Style</label>
                                                <select id="classname" name="classname" class="form-select">
                                                    <option value="0">Select Style</option>
                                                
                                                    @foreach($classnames as $key => $value)
                                                        <option value="{{ $key }}" {{ ($key == old('classname'))  ? 'selected' : '' }}>
                                                            {{ $value }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('classname')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="status" class="col-form-label">Select Status</label>
                                                <select id="status" name="status" class="form-select">
                                                    <option value="P" {{ old('status') == 'P' ? 'selected' : '' }}>Published</option>
                                                    <option value="U" {{ old('status') == 'U' ? 'selected' : '' }}>UnPublished</option>
                                                </select>
                                                @error('status')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="displayorder" class="col-form-label">Display Order</label>
                                                <input type="number" id="displayorder" name="displayorder" value="{{ old('displayorder', 1) }}"  class="@error('displayorder') is-invalid @enderror form-control" placeholder="1" maxlength="3" required />
                                                @error('displayorder')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <div class="pt-5">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" value="1" id="featured" name="featured" {{ old('featured') == '1' ? 'checked="checked"' : '' }}>
                                                        <label class="custom-control-label" for="featured">Set as Featured Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row border-top mt-3">
                                            <div class="col-md-6">
                                                <label for="image" class="col-form-label">Image <span class="badge text-bg-light">[ For SEO ]</span> </label>

                                                <div class="input-group @error('image') is-invalid @enderror ">
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                                @error('image')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label for="short_description" class="col-form-label">Short Description <span class="badge text-bg-light">[ For SEO ]</span> </label>
                                                <textarea id="short_description" rows="5" name="short_description" class="form-control" placeholder="Short Description" >{{ old('short_description')  }}</textarea>
                                                @error('short_description')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                        </div>  
                                    </div>

                                
                                
                        
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card card-secondary card-outline mb-4">
                                
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row"> 
                                        <div class="col-md-12">
                                            <label for="description" class="col-form-label">Contents</label>
                                            <textarea id="description" rows="21" name="description" class="@error('description') is-invalid @enderror form-control wyswygEditor" placeholder="Description" >{{ old('description')  }}</textarea>
                                            @error('description')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror

                                            <button id="openMediaManager" type="button" class="btn btn-light btn-sm border mt-2 float-end"><i class="bi bi-images"></i> {{ __('Open Media Manager') }}</button>

                                        </div>

                                        
                                        
                                    </div>  
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-end">
                                    <input type="hidden" name="b" value="{{ request()->query('b') }}" />
                                    <a href="{{ base64_decode(request()->query('b')) }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    @include('admin.media.mediamanager')


</x-appadmin-layout>
