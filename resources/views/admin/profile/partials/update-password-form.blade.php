<section>
    @if (session('status') === 'password-updated')
        <div class="alert alert-success ml-2 mr-2 alert-dismissible fade show" role="alert">
            <i class="bi bi-check2-square"></i>
            {{ __('Password Updated.') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card card-secondary card-outline mb-4">
        <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="card-header">
                <h3 class="card-title"> {{ __('Update Password') }}</h3>
            </div>
 
            <!-- /.card-header -->
            <div class="card-body">
                <p class="callout callout-info p-2">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
                </p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="update_password_current_password" class="col-form-label">{{__('Current Password')}}</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="form-control {{ ($errors->updatePassword->get('current_password')) ? 'is-invalid' : '' }}" required autocomplete="current-password" />

                            @error('current_password', 'updatePassword')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="update_password_password" class="col-form-label" >{{__('New Password')}}</label>
                            <input id="update_password_password" name="password" type="password" class="form-control {{ ($errors->updatePassword->get('password')) ? 'is-invalid' : '' }}" required autocomplete="new-password" />
                            
                            @error('current_password', 'updatePassword')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="update_password_password_confirmation" class="col-form-label">{{__('Confirm Password')}}</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control {{ ($errors->updatePassword->get('password_confirmation')) ? 'is-invalid' : '' }}" required autocomplete="new-password" />
                            
                            @error('current_password', 'updatePassword')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
