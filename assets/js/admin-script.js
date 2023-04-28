jQuery(document).ready(function ($) {
    /**
     * check file type and size on class name file choose
     */
    $('.ai_search_bar_form input[name="submit"]').on('click', function (e) {
        e.preventDefault();
        var form_data = new FormData($(this).parents('.ai_search_bar_form')[0]);
        form_data.append('action', 'add_ai_search_bar_form');
        $.ajax({
            type: 'POST',
            url: request_globals.request_url,
            data: form_data,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.success == true) {
                    $('.ai_search_bar_form')[0].reset();
                    window.location.href = $('.ai_search_bar_form').attr(
                        'action'
                    );
                }
            },
        });
    });
});
