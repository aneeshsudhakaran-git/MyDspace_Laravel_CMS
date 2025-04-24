

let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
let baseURL = $('body').data('baseurl');
let $body = $('body');

Dropzone.autoDiscover = false;

$(document).ready(function () {
    
    // wyswygEditor
    if( $body.find('.wyswygEditor').length){
        tinymce.init({
            selector: '.wyswygEditor',
            plugins: 'code link image lists table', // Add other plugins as needed
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | link image | code',

            // This allows all tags and all attributes — completely unrestricted
            valid_elements: '*[*]',
            extended_valid_elements: '*[*]',

            // This prevents TinyMCE from converting or removing your custom tags
            verify_html: false,
            valid_children: '+body[style],+body[i],+body[a]',
            forced_root_block: '', // Optional: don't wrap in <p> tags

            // Optional: this keeps HTML characters as-is
            entity_encoding: 'raw',

            // Optional: use HTML5 tag schema
            schema: 'html5',

            // Optional: keeps empty tags like <i></i>
            remove_trailing_brs: false,
            remove_empty: false,
            protect: [
                /\<a[^>]*\><\/a>/g,
                /\<i[^>]*\><\/i>/g,
                /\<span[^>]*\><\/span>/g
              ], // protects empty <a, i, span> tags from being removed
            
            license_key: 'gpl'
        });
    }

    $body.on('click', '#openMediaManager--', function(){
        $imageUrl = "http://127.0.0.1:8000/admin_asset/assets/img/user2-160x160.jpg";
        if ($imageUrl) {
            tinymce.activeEditor.insertContent('<img src="' + $imageUrl + '" alt="Custom Image" style="max-width:100%;">');
        }

    });


    // Open Media Manager Modal
    $("#openMediaManager").on("click", function () {
        $("#mediaManagerModal").modal("show");
        loadMediaGallery(); // Load images when the modal is opened
    });

    // Load Media Gallery (AJAX)
    function loadMediaGallery() {
        $.ajax({
            url: baseURL+"/admin/media/medialist",
            type: "GET",
            dataType: "json",
            success: function (data) {
                let gallery = $("#mediaGallery");
                gallery.html(""); // Clear previous images

                $.each(data, function (index, media) {
                    let $file_path = baseURL +'/storage/'+ media.file_path;
                    let imageHtml = `
                        <div class="col-md-3">
                            <img src="${$file_path}" class="img-thumbnail media-image" data-src="${media.file_path}">
                        </div>`;
                    gallery.append(imageHtml);
                });
            }
        });
    }

    // fetchMedia
    function fetchMedia(page = 1, search = '') {
        $.ajax({
            url: baseURL+"/admin/media/medialist",
            data: { page: page, search: search },
            success: function (data) {
                $('#mediaList').html(data);
            }
        });
    }

    $(document).on('keyup','#searchMedia', function () {
        let search = $(this).val();
        fetchMedia(1, search);
    });

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let search = $('#searchMedia').val();
        fetchMedia(page, search);
    });

    $(document).on('change', '.tag-input', function () {
        let mediaId = $(this).data('id');
        let newTag = $(this).val();
    
        $.ajax({
            url: baseURL + "/admin/media/updatetag",
            type: "POST",
            data: {
                _token: csrfToken,
                id: mediaId,
                tag: newTag
            },
            success: function (response) {
                if (response.success) {
                    $(".mediaAlertBox")
                        .removeClass("d-none alert-danger")
                        .addClass("alert-success show")
                        .find(".mediaAlertBoxMsg").html("Tag updated successfully!");
                } else {
                    $(".mediaAlertBox")
                        .removeClass("d-none alert-success")
                        .addClass("alert-danger show")
                        .find(".mediaAlertBoxMsg").html("Failed to update tag! Please try again later!");
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    let errorMsg = Object.values(errors).flat().join("\n");
                    alert("Validation Error:\n" + errorMsg);
                } else {
                    alert("Error updating tag!");
                }
            }
        });
    });

    $('#clearButton').on('click', function () {
        $('#searchMedia').val('').focus(); // Clear input and refocus
        let search = $('#searchMedia').val();
        fetchMedia(1, search);
    });

    $(document).on('click', '.mediaAlertBoxClose', function () {
        const alertBox = $(this).closest('.mediaAlertBox');
        alertBox.removeClass('show').addClass('d-none');
    });

    $(document).on('click', '.delete-image', function () {
        let mediaId = $(this).data('id');
        let url = baseURL + "/admin/media/"+mediaId;
    
        if (confirm('Are you sure you want to delete this image?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {

                        $(".mediaAlertBox")
                        .removeClass("d-none alert-danger")
                        .addClass("alert-success show")
                        .find(".mediaAlertBoxMsg").html(response.message);

                        $('#searchMedia').val('').focus(); // Clear input and refocus
                        let search = $('#searchMedia').val();
                        fetchMedia(1, search);

                        $('#mediaManagerModal').focus();
                    }
                },
                error: function () {
                    alert('Failed to delete image. Please try again.');
                }
            });
        }
    });

    // Function to show success message
    function showAlert(message, type = 'success') {
        let alertBox = $('.mediaAlertBox');
        alertBox.removeClass('d-none alert-success alert-danger alert-info');
        alertBox.addClass('alert-' + type).addClass('show');
        $('.mediaAlertBoxMsg').text(message);
    }

    // Call directly instead of triggering click
    // $('#clearButton').trigger( "click" );   // load list after upload
    //url: baseURL + "/admin/media/upload",
    
    if (Dropzone.instances.length === 0) {
        let myDropzone = new Dropzone("body #mediaDropzone", {
            url: baseURL + "/admin/media/upload",
            paramName: "file",
            addRemoveLinks: false,
            dictDefaultMessage: "<h4><i class='bi bi-upload'></i> Drop files here or click to upload.</h4>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        myDropzone.on("success", function (file, response) {
            //$('.mediaAlertBoxMsg').text(response.msg);
            //$('.mediaAlertBox').removeClass('d-none alert-danger').addClass('alert-success show');

            $('#clearButton').trigger( "click" );   // load list after upload
        });

        myDropzone.on("error", function (file, response) {
            let message = "Upload failed";

            // Laravel returns JSON with errors array
            if (response && response.errors && Array.isArray(response.errors)) {
                message = response.errors.join(" ");
            }

            // If response is a plain string
            if (typeof response === "string") {
                message = response;
            }

            // If response is an object with message
            if (typeof response === "object" && response.message) {
                message = response.message;
            }

            // Update alert (optional)
            //$('.mediaAlertBoxMsg').text(message);
            //$('.mediaAlertBox').removeClass('d-none alert-success').addClass('alert-danger show');

            // Fix Dropzone's preview error message
            if (file.previewElement) {
                let errorDisplay = file.previewElement.querySelector("[data-dz-errormessage]");
                if (errorDisplay) {
                    errorDisplay.textContent = message;
                }
            }

            console.error("Upload error:", message);
        });

        myDropzone.on("complete", function (file) {
            console.log("Upload complete:", file);
        });
        
        // Handle Image Selection
        $body.on("click", ".media-image", function (e) {
            e.preventDefault();
            let $imageUrl = $(this).data("filename");
            let $imageTitle = $(this).data("title");

            // Insert the image into the active TinyMCE editor
            if ($imageUrl) {
                tinymce.activeEditor.insertContent('<img src="' + $imageUrl + '" alt="media-img" class="img-fluid" width="100%" height="100%" alt="'+$imageTitle+'" >');
            }
            //$('#mediaManagerModal').focus();
            $('#mediaManagerModal').modal('hide');
        });

        // focus on editor when modal closed
        $body.on('hide.bs.modal', '.mediaManagerModal', function (event) {
            //tinymce.activeEditor.focus();
        });

        $body.on('shown.bs.modal', '.mediaManagerModal', function (event) {
            $('#mediaDropzone').find('.dz-preview').remove();
        });

    }
});
