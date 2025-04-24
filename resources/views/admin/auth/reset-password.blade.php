<x-guestadmin-layout>
    
    <div class="login-page">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        
        <div class="login-box">
            <div class="login-logo">
                <a href="/admin/login"><b>Admin Panel</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                <p class="login-box-msg">Reset your password</p>
                
                <form method="POST" action="{{ route('admin.password.store') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="input-group mb-3">
                        <input type="email" class="form-control {{ ($errors->get('email')) ? 'is-invalid' : '' }}" 
                            placeholder="Username" required autofocus autocomplete="username" 
                            value="{{ old('email', $request->email) }}" id="email" name="email"/>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                            </div> 
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control {{ ($errors->get('password')) ? 'is-invalid' : '' }}" 
                            placeholder="New Password" id="password" name="password" required autocomplete="current-password"/>

                        <div class="input-group-append">
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control {{ ($errors->get('password_confirmation')) ? 'is-invalid' : '' }}" 
                            placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" required autocomplete="current-password"/>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>


                    <!--begin::Row-->
                    <div class="row"> 
                        <!-- /.col -->
                        <div class="col">
                            <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">{{ __('Reset Password') }}</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>
                
                
                
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
  
</x-guestadmin-layout>
