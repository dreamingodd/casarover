$(function(){
    $('.nav_tab').click(function(){
        if ($(this).hasClass('received')) {
            $('.nav_tab').removeClass('active');
            $(this).addClass('active');
            $('table').hide();
            $('.received').show();
        } else if ($(this).hasClass('unreceived')) {
            $('.nav_tab').removeClass('active');
            $(this).addClass('active');
            $('table').hide();
            $('.unreceived').show();
        }
    });
    $('.btn_del').click(function(){
        var id = $(this).attr('data-id');
        if (confirm('确实要删除该内容吗?')) {
            location.href = '../../application/controllers/reward_action.php?id=' + id + '&action=delete';
        }
    });
});