<x-appadmin-layout>
    <div class="content-wrapper">
        
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6"><h3 class="mb-0">{{ __('Menu') }}</h3></div>
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Menu</li>
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
                            <form method="POST" action="{{ route('admin.menu.create') }}">
                                @csrf

                                <div class="card-header">
                                    <h3 class="card-title"> {{ __('Add Menu') }}</h3>
                                </div>
                        
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title" class="col-form-label">Menu Title</label>
                                            <input type="text" id="title" name="title" value="{{ old('title') }}" class="@error('title') is-invalid @enderror form-control" placeholder="Home" required />
                                            @error('title')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="col-form-label">Menu Name</label>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control" placeholder="home" required />
                                            @error('name')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="parent_id" class="col-form-label">Parent Menu</label>
                                            <select id="parent_id" name="parent_id" class="form-select">
                                                <option value="0">{{ __('Default Menu') }}</option>

                                                {!! getMenuOptions(0, '', old('parent_id')) !!}
                                             
                                                    
                                             </select>
                                            @error('menu')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="displayorder" class="col-form-label">Display Order</label>
                                            <input type="number" id="displayorder" name="displayorder" value="{{ old('displayorder', 1) }}" class="@error('displayorder') is-invalid @enderror form-control" placeholder="1" maxlength="3" required />
                                            @error('displayorder')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="menutype" class="col-form-label">Select Menu to Display</label>
                                            <select id="menutype" name="menutype" class="form-select">
                                                <option value="0" {{ (old('menutype') == '0') ? 'selected' : '' }}>Default Menu</option>
                                                <option value="1" {{ (old('menutype') == '1') ? 'selected' : '' }}>Show in Main Menu</option>
                                                <option value="2" {{ (old('menutype') == '2') ? 'selected' : '' }}>Show in Footer Menu</option>
                                            </select>
                                            @error('menutype')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="link_type" class="col-form-label">Select Link Type</label>
                                            <select id="link_type" name="link_type" class="form-select">
                                                <option value="S" {{ (old('link_type') == 'S') ? 'selected' : '' }}>Self</option>
                                                <option value="N" {{ (old('link_type') == 'N') ? 'selected' : '' }}>New Page</option>
                                                <option value="T" {{ (old('link_type') == 'T') ? 'selected' : '' }}>Open in New Tab</option>
                                            </select>
                                            @error('link_type')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div> 
                                        
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="description" class="col-form-label">Description</label>
                                            <input type="text" id="description" name="description" class="form-control" placeholder="Description"   />
                                        </div> 
                                        <div class="col-md-6">
                                            <label for="classname" class="col-form-label">Select Menu Style Class</label>
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
                                            <label for="status" class="col-form-label">Select Menu Status</label>
                                            <select id="status" name="status" class="form-select">
                                                <option value="P" {{ (old('status') == 'P') ? 'selected' : '' }}>Published</option>
                                                <option value="U" {{ (old('status') == 'U') ? 'selected' : '' }}>UnPublished</option>
                                            </select>
                                            @error('status')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
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
 


 
