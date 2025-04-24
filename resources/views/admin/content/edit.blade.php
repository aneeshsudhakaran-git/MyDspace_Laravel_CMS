@pushOnce('scripts')
    <script src="{{ asset('/admin_asset/plugins/tinymce/tinymce.min.js') }}"></script>
    
    <!-- Include Dropzone -->
    <script src="{{ asset('/admin_asset/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('/admin_asset/js/mediamanager.js?a=11') }}"></script>
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
                <form method="POST" action="{{ route('admin.content.edit', $content->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card card-secondary card-outline mb-4">

                                <div class="card-header">
                                    <h3 class="card-title"> {{ __('Edit Content') }}</h3>
                                </div>
                            
                                    <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title" class="col-form-label">Title</label>
                                            <input type="text" id="title" name="title" 
                                            value="{{ $content->title }}" class="@error('title') is-invalid @enderror form-control" placeholder="Home" required />
                                            @error('title')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="category" class="col-form-label">Select Category</label>
                                            <select id="category" name="category" class="form-select">
                                                <option value="">Select Category</option>

                                                @foreach($category as $key => $value)
                                                    <option value="{{ $key }}" {{ ($content->category) == $key ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('category')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="menu" class="col-form-label" >Select Menu</label>
                                            <select id="menu" name="menu" class="@error('menu') is-invalid @enderror form-select" required>
                                                <option value="0">Select Menu</option>
                                                {!! getContentMenuOptions(0, '', $content->menu ) !!}
                                            </select>
                                            @error('menu')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="content_section" class="col-form-label">Content Section</label>
                                            <select id="content_section" name="content_section" class="form-select">
                                            <option value="1" {{ $content->content_section == 1 ? 'selected' : '' }}>Main Content</option>
                                            <option value="2" {{ $content->content_section == 2 ? 'selected' : '' }}>Footer Content</option>
                                            </select>
                                            @error('content_section')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="download_file_title" class="col-form-label">Download File Title</label>
                                            <input type="text" id="download_file_title" name="download_file_title" value="{{ $content->download_file_title }}" class="form-control" placeholder="Download File" />
                                            @error('download_file_title')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="download_file" class="col-form-label">Download File (pdf only)</label>

                                            <div class="input-group @error('image') is-invalid @enderror ">
                                                    <input type="file" class="form-control" id="download_file" name="download_file">
                                            </div>
                                            @error('download_file')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> 
                                        <div class="col-md-6">
                                            @if($content->download_file)
                                                <div class="form-group">
                                                    <div class="float-start mt-5">
                                                        <a href="{{ asset('storage/content_files/'.$content->download_file)}}" alt="" title="content file" target="_blank">Download File </a>
                                                    </div>
                                                    <div class="float-start ms-3 mt-5">
                                                        <div class="flex items-center">
                                                            <input id="del_file" name="del_file" type="checkbox" value="1" class="">
                                                            <label for="del_file" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delete File</label>
                                                        </div> 
                                                    </div>
                                                    <div class="clear-both"></div> 
                                                </div>
                                            @endif
                                        </div>

                                        
                                        <div class="col-md-6">
                                            <label for="classname" class="col-form-label">Select Content Style Class</label>
                                            <select id="classname" name="classname" class="form-select">
                                                <option value="0">Select Style</option>
                                            
                                                @foreach($classnames as $key => $value)
                                                <option value="{{ $key }}" {{ ($key == $content->classname)  ? 'selected' : '' }}>
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
                                                <option value="P" {{ $content->status == 'P' ? 'selected' : '' }}>Published</option>
                                                <option value="U" {{ $content->status == 'U' ? 'selected' : '' }}>UnPublished</option>
                                            </select>
                                            @error('status')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="displayorder" class="col-form-label">Display Order</label>
                                            <input type="number" 
                                            value="{{ $content->displayorder }}"
                                            id="displayorder" name="displayorder" class="@error('displayorder') is-invalid @enderror form-control" placeholder="1" maxlength="3" required />
                                            @error('displayorder')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group pt-5">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="featured" name="featured" {{ $content->featured == '1' ? 'checked="checked"' : '' }}>
                                                    <label class="custom-control-label" for="featured">Set as Featured Content</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-top mt-3">
                                        <div class="col-md-6">
                                            <label for="image" class="col-form-label">Image <span class="badge text-bg-light">[ For SEO ]</span></label>

                                            <div class="input-group @error('image') is-invalid @enderror ">
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                            @error('image')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            @if($content->image)
                                                <div class="form-group">
                                                    <div class="float-start">
                                                        <img src="{{ asset('storage/contentimages/'.$content->image)}}" alt="" title="contentimages" width="80" class="rounded" />
                                                    </div>
                                                    <div class="float-start ms-3 mt-4">
                                                        <div class="flex items-center mb-4">
                                                            <input id="del_image" name="del_image" type="checkbox" value="1" class="">
                                                            <label for="del_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delete Image</label>
                                                        </div> 
                                                    </div>
                                                    <div class="clear-both"></div> 
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="short_description" class="col-form-label">Short Description <span class="badge text-bg-light">[ For SEO ]</span></label>
                                            <textarea id="short_description" name="short_description" class="form-control" placeholder="Short Description" >{{ $content->short_description }}</textarea>
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
                                            <label for="description" class="col-form-label">Description</label>
                                            <textarea id="description" name="description" rows="21" class="@error('description') is-invalid @enderror form-control wyswygEditor" placeholder="Description" >{{ $content->description }}</textarea>
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
 
