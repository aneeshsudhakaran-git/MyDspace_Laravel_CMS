
@pushOnce('scripts')
    <script src="{{ asset('/admin_asset/js/content.js') }}"></script>
@endPushOnce

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
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
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
                @session('success')
                <div class="alert alert-success ml-2 mr-2 alert-dismissible fade show" role="alert">
                    <i class="bi bi-check2-square"></i>
                    {{ $value }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession
                
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Enquiry List</h3>

                            <div class="card-tools">
                                <form method="GET" action="{{ route('admin.site_enquiry') }}" class="frmListFilter">
                                    
                                    <div class="float-end">
                                        <div class="input-group m-0">
                                            <input type="text" id="search" name="search" value="{{ old('search' , $search ) }}" class="form-control" placeholder="Enter Search Text..." />
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-secondary">Search</button>
                                            </span>

                                            <span class="input-group-append ms-2 me-3">
                                                <input class="btn btn-outline-secondary frmResetButton" type="reset" value="Reset" />
                                            </span>
                                        </div>
                                    </div> 
                                    <div class="float-end me-3">
                                            <select id="status" name="status" class="form-select">
                                                <option value="0">Select Status</option>

                                                <option value="R" {{ $status == 'R' ? 'selected' : '' }}>Read</option>
                                                <option value="U" {{ $status == 'U' ? 'selected' : '' }}>UnRead</option>
                                            </select>

                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>IP</th>
                                        <th>Status</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($enquiry as $enq)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td scope="row">{{ ++$i }}</td>
                                        <td width="20%">{{ $enq->name }}
                                            <p>{{ $enq->email }}</p>
                                            <p>{{ $enq->phone }}</p>
                                        </td>
                                        <td width="20%">{{ $enq->subject }}</td>
                                        <td width="20%" class="text-wrap">{{ substr($enq->description, 0, 50) . (strlen($enq->description) > 50 ? '...' : '') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($enq->created_at)->format('j F, Y g:i:s a') }} </td>
                                        <td width="10%" >{{ $enq->ip }} </td>
                                        <td>{!! ($enq->status == 'U') ? '<span class="badge text-bg-secondary">UnRead</span>' : '<span class="badge text-bg-success">Read</span>' !!}</td>
                                        <td class="text-end">
                                            <a class="btn btn-secondary btn-sm mr-2" href="{{ route('admin.site_enquiry.edit', [$enq->id, 'b' => base64_encode(url()->full()) ]) }}"> View</a> 
                                            <a class="btn btn-danger btn-sm"
                                            onclick="return confirm('{{ __('Are you sure you want to delete?') }}')"
                                            href="{{ route('admin.site_enquiry.delete', [$enq->id, 'b' => base64_encode(url()->full()) ] ) }}"> Delete</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">There are no data.</td>
                                    </tr>
                                @endforelse
                                
                                    <tr>
                                        <td colspan="8">{!! $enquiry->links() !!}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
          </div>
        </div>
    </section>
  <!-- /.content -->
</x-appadmin-layout>