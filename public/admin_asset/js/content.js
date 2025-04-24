

let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
let baseURL = $('body').data('baseurl');
let $body = $('body');

$(document).ready(function () {
    
    // menu list
    $body.on('change', '#menutype', function() {
        $(".frmListFilter").trigger( "submit" );
    });

    // contents list
    $body.on('change', '#catid, #menuid, #contentsection', function() {
        $(".frmListFilter").trigger( "submit" );
    });

    // enquiry list
    $body.on('change', '#type_id, #status', function() {
        $(".frmListFilter").trigger( "submit" );
    });

    // wyswygEditor
    if( $body.find('.wyswygEditor').length){
        tinymce.init({
            selector: '.wyswygEditor',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist | ' +
            'removeformat | image link media',
            
            menubar: 'file edit view insert format tools table help',
            contextmenu: 'link image table',
            extended_valid_elements: 'input[name|type|class|id|value|placeholder|required]',
            license_key: 'gpl'
        });
    }

    $body.on('click', '#openMediaManager--', function(){
        $imageUrl = "http://127.0.0.1:8000/admin_asset/assets/img/user2-160x160.jpg";
        if ($imageUrl) {
            tinymce.activeEditor.insertContent('<img src="' + $imageUrl + '" alt="Custom Image" style="max-width:100%;">');
        }

    });

    // form reset search filter
    $body.on('click', '.frmResetButton', function(){
        $form = $(".frmListFilter");
        $form.find("#search").val("");
        $form.find(".form-select").length ? $form.find(".form-select").val("0") : '';
        $form.submit();
    });
    
});
