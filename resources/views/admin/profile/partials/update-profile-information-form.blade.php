<section>
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success ml-2 mr-2 alert-dismissible fade show" role="alert">
            <i class="bi bi-check2-square"></i>
            {{ __('Profile Information Saved.') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-secondary card-outline mb-4">
        
        <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
            @csrf
        </form> 
        <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="card-header">
                <h3 class="card-title">{{ __('Profile Information') }}</h3>
            </div>
 
            <!-- /.card-header -->
            <div class="card-body">
                <p class="callout callout-info p-2">
                    {{ __("Update your account's profile information and email address.") }} <br/>
                </p>

                <div class="row">
                    @if($user->image)
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="float-start">
                                <img src="{{ asset('storage/profile-images/'.$user->image) }}" alt="" title="profile-image" width="80" class="user-image rounded shadow" />
                            </div>
                            <div class="float-start ms-3 mt-4">
                                <div class="flex items-center mb-2">
                                    <input id="del_image" name="del_image" type="checkbox" value="1" class="">
                                    <label for="del_image" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delete Image</label>
                                </div> 
                            </div>
                            <div class="clear-both"></div> 
                        </div>
                    </div>
                    @endif

                    <div class="col-md-6">
                        <label for="image" class="col-form-label" >{{__('Upload Profile Image')}}</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="image" name="image">
                            <label class="input-group-text" for="image">Upload</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="col-form-label">{{__('Name')}}</label>
                        <input id="name" name="name" type="text" class="form-control {{ ($errors->get('name')) ? 'is-invalid' : '' }}" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        
                        @error('name')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="col-md-6">
                        <label for="email" class="col-form-label" >{{__('Email')}} </label>
                        <input id="email" name="email" type="email" class="form-control {{ ($errors->get('email')) ? 'is-invalid' : '' }}" value="{{old('email', $user->email)}}" required autocomplete="username" />
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                </div> 

                <div class="row">
                    <div class="col-md-6">
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    
                    </div>
                </div>

                <div class="callout callout-danger p-2 mt-3">
                    <h5>Warning: </h5>
                    <p class="fs-6">{{ __(" Email Used as username. Be careful when updating this email.") }}</p>
                </div>
                
            </div>
            

            <!-- /.card-body -->
            <div class="card-footer text-end">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                <button type="submit" class="btn btn-success">{{ __('Save') }}</button> 
            </div>
        </form>
    </div>

</section>
