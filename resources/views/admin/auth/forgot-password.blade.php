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
            <p class="login-box-msg">        
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
            
            <form method="POST" action="{{ route('admin.password.email') }}">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" class="form-control {{ ($errors->get('email')) ? 'is-invalid' : '' }}" 
                        placeholder="email" required autofocus autocomplete="email" 
                        value="{{old('email')}}" id="email" name="email"/>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        </div> 
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                 
                <!--begin::Row-->
                <div class="row">
                     
                    <div class="col-12">
                        <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">{{ __('Email Password Reset Link') }}</button>
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
