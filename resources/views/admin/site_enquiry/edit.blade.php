<x-appadmin-layout>
    <!--begin::App Content Header-->
    <div class="app-content-header">
    <!--begin::Container-->
        <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0">{{ __('Site Enquiry') }}</h3></div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.site_enquiry') }}">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item active">{{ __('Site Enquiry') }}</li>
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
                <form method="POST" action="{{ route('admin.site_enquiry.edit', $enq->id) }}">
                        @csrf

                        <div class="card-header">
                            <h3 class="card-title"> {{ __('View Enquiry') }}</h3>
                        </div>
                
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label fs-5">Name</label>
                                        <div>{{ $enq->name }} </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="col-form-label fs-5">Email</label>
                                        <div>{{ $enq->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label fs-5">Phone</label>
                                        <div>{{ $enq->phone }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label fs-5">IP Address</label>
                                        <div>{{  $enq->ip }} </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label fs-5">Created</label>
                                        <div>{{ \Carbon\Carbon::parse($enq->created_at)->format('j F, Y g:i:s a') }} </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label fs-5">Seen On</label>
                                        <div>{{ \Carbon\Carbon::parse($enq->updated_at)->format('j F, Y g:i:s a') }} </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="col-form-label fs-5">Subject</label>
                                            <div>{{ $enq->subject }}</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label fs-5">Description</label>
                                        <div class="text-wrap">{{ $enq->description }}</div>
                                    </div>
                                </div>
                                
                            </div>  
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer text-end">
                            <a href="{{ base64_decode(request()->query('b')) }}" class="btn btn-secondary">Back</a>
                            <input type="hidden" name="b" value="{{ request()->query('b') }}" />

                        </div>
                    </form>
            
                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</x-appadmin-layout>
 


 
