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
                <p class="login-box-msg">Sign in to start your session</p>
                
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" class="form-control {{ ($errors->get('email')) ? 'is-invalid' : '' }}" 
                            placeholder="Username" required autofocus autocomplete="username" 
                            value="{{old('email')}}" id="email" name="email"/>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                            </div> 
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control {{ ($errors->get('password')) ? 'is-invalid' : '' }}" 
                            placeholder="Password" id="password" name="password" required autocomplete="current-password"/>

                        <div class="input-group-append">
                            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me"  />
                            <label class="form-check-label" for="remember_me"> Remember Me </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success">Sign In</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>
                
                <!-- /.social-auth-links -->
                <p class="mb-1">
                    <a href="{{ route('admin.password.request') }}">I forgot my password</a>
                </p>
                
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>
</x-guestadmin-layout>
