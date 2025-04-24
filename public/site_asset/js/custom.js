let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
let contacturl = $('body').data('contacturl');

$(document).ready(function () {
    
    $(document).on('submit', '#contactForm', function(e) {
        e.preventDefault();

        var $form = $(this);

        // Check if the hidden input already exists
        if ($form.find('input[name="_token"]').length === 0) {
            $form.prepend(
                $('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: csrfToken
                })
            );
        }

        var formData = $form.serialize();

        // Show loading
        $form.find('.loading').show();
        $form.find('.error-message').hide();
        $form.find('.sent-message').hide();

        let $url = contacturl;

        $.ajax({
            url: $url,
            type: 'POST',
            data: formData,
            success: function (response) {
                $form.find('.loading').hide();
                $form.find('.sent-message').show().text('Your message has been sent. Thank you!');
                $form[0].reset();
            },
            error: function (xhr) {
                $form.find('.loading').hide();
                let errorMsg = 'Something went wrong. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                $form.find('.error-message').show().text(errorMsg);
            }
        });
    });

});