$(function(){
    $('#wechat_article_1_btns').hide();
    $('#wechat_article_2_btns').hide();
    $('#casa_btns').hide();
    var show_type_id = "#" + $('#type').val() + "_btns";
    $(show_type_id).show();
});