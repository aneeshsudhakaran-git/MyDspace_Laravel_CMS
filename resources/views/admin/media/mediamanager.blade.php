<!-- Media Manager Modal -->
<div class="modal fade" id="mediaManagerModal" tabindex="-1" aria-labelledby="mediaManagerLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaManagerLabel">Media Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-success ml-2 mr-2 alert-dismissible fade mediaAlertBox d-none" role="alert">
                    <i class="bi bi-check2-square"></i>
                    <label class="mediaAlertBoxMsg"></label>
                    <button type="button" class="btn-close mediaAlertBoxClose" aria-label="Close"></button>
                </div>

                <!-- Dropzone for Image Upload -->
                <h4 class="text-start">Drop or click to upload files below.</h4>
                <form action="{{ route('admin.media.upload') }}" method="post" enctype="multipart/form-data" id="mediaDropzone" class="dropzone">
                    @csrf
                    <div class="dz-default dz-message">
                        <button class="dz-button" type="button"><h5><i class="bi bi-upload"></i> Drop files here or click to upload.</h5></button>
                    </div>
                    <div id="dropzonePreviewContainer" class="row"></div>
                </form>
                 
                <hr>
 
                <div class="input-group mb-3 w-50">
                    <input type="text" id="searchMedia" class="form-control" placeholder="Search by tag..." aria-label="Search by tag..." aria-describedby="clearButton">
                    <button class="btn btn-secondary" type="button" id="clearButton"><i class="bi bi-x-circle"></i></button>
                </div>

                <!-- Display Uploaded Images -->
                <div class=" mt-3" id="mediaList">
                    <!-- Images will be loaded here dynamically -->
                     
                    @include('admin.media.media_list', ['media' => $media])
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
