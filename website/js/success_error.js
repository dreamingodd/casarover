$(function(){
    // Hide buttons
    $('button').hide();
    if ($('#type').val()) {
        var types = $('#type').val().split(" ");
        for (var i in types) {
            $('.' + types[i]).show();
        }
    } else {
        $('.back').show();
    }
    $('#go_back').click(function(){
        history.go(-1);
    });
    $('#go_back').click(function(){
        location.href = getWebUrl();
    });
    if ($('#countdown').val()) {
        $('#countdown_current').html($('#countdown').val());
        setTimeout(function(){
            var countdown_current = $('#countdown_current').html();
            $('#get-code-dummy').html(countdown - 1);
            if (countdown_current > 0) {
                $('#countdown_current').html(countdown_current - 1);
                setTimeout(arguments.callee, 1000);
            } else {
                location.href = $('#redirect_url').val();
            }
        }, 1000);
    }
});