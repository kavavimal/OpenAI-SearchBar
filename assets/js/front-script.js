jQuery(document).ready(function ($) {
    $('#submit_ai_search_bar').on('click', function (e) {
        e.preventDefault();
        var search_data = $('#input_ai_search_bar').val();
        var ai_search_bar_key = $('#ai_search_bar_key').val();
        $('#search_result').hide();
        $('.CodeMirror').remove();
        $('#search_result').val('');
        if (ai_search_bar_key != '') {
            $.ajax({
                url: 'https://api.openai.com/v1/chat/completions',
                beforeSend: function (xhr) {
                    $('#loading').show();
                    xhr.setRequestHeader(
                        'Authorization',
                        'Bearer  ' + ai_search_bar_key
                    );
                },
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                processData: false,
                data: JSON.stringify({
                    model: 'gpt-3.5-turbo',
                    messages: [
                        {
                            role: 'user',
                            content: search_data,
                        },
                    ],
                }),
                success: function (data) {
                    console.log(data);
                    $('.CodeMirror').css('opacity', '1');
                    $('.code').val(data.choices[0]['message'].content);
                    function codemirror(sel) {
                        return Array.apply(
                            null,
                            document.querySelectorAll(sel)
                        );
                    }
                    codemirror('.code').forEach(function (editorEl) {
                        CodeMirror.fromTextArea(editorEl, {
                            lineNumbers: false,
                            mode: 'htmlmixed',
                        });
                    });
                },
                complete: function () {
                    $('#loading').hide();
                },
                error: function () {
                    $('.CodeMirror').css('opacity', '0');
                    alert('Cannot get data');
                },
            });
        } else {
            $('.code').val('Please Enter ChatGPT API Key First.');
            function codemirror(sel) {
                return Array.apply(null, document.querySelectorAll(sel));
            }
            codemirror('.code').forEach(function (editorEl) {
                CodeMirror.fromTextArea(editorEl, {
                    lineNumbers: false,
                    mode: 'htmlmixed',
                });
            });
        }
    });
});
