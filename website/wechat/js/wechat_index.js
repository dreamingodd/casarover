$(function(){
    // 头部slider
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    // slider比例控制
    setTimeout(adjust_height($('.slides li'), 2.2), 50);
    $(window).resize(adjust_height($('.slides li'), 2.2));
    // Tab选择
    var type = $('#type').val();
    if (type == 1) {
        $('.nav_one').removeClass('active');
        $('.series').addClass('active');
    } else if (type == 2) {
        $('.nav_one').removeClass('active');
        $('.scenery').addClass('active');
    } else if (type == 3) {
        $('.nav_one').removeClass('active');
        $('.theme').addClass('active');
    }
    $('.wechat_container ul li').click(function(){
        $('.wechat_container ul li').removeClass('active');
        $(this).addClass('active');
        $('.article_list').hide();
        if ($(this).hasClass('type1')) {
            $('#list1').show();
        } else if ($(this).hasClass('type2')) {
            $('#list2').show();
        }
    });
});

/**
 * Slider links.
 * 轮播图的链接地址。
 */
function goto_link1() {
    // 花千骨
    location.href = "http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=400490584&idx=1&sn=7e3bb395148a1f9a3675c63108a29266&scene=4#wechat_redirect";
}
function goto_link2() {
    // 三舍
    location.href = "http://mp.weixin.qq.com/s?__biz=MzI3MDA4NjAxNQ==&mid=400724251&idx=1&sn=d1a03a31daf29a04f03e60d8389cda93&scene=4#wechat_redirect";
}