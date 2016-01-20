$(document).ready(function(){

    // 自动显示登陆框
    if ($('#auto_login').val()) {
        $('#mModal').modal('show');
    }
    // 首页 tab切换
    $('#theme-two').click(function(){
        //theme-two
        $('.theme-one').css('display','none');
        $('.theme-two').css('display','block');
        $('#theme-two').addClass("content_tab_active");
        $('#theme-one').removeClass("content_tab_active");
    });
    $('#theme-one').click(function(){
        //theme-two
        $('.theme-two').css('display','none');
        $('.theme-one').css('display','block');
        $('#theme-two').removeClass("content_tab_active");
        $('#theme-one').addClass("content_tab_active");
    });

    // 首页头部slider
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });

    // map指示
    var MouseEvent = function(e){
        this.x = e.pageX;
        this.y = e.pageY;
    };
    var Mouse = function(e){
        var kdheight =  jQuery(document).scrollTop();
        mouse = new MouseEvent(e);
        leftpos = mouse.x+5;
        toppos = mouse.y-kdheight;
    };
    $("#31,#64,#25,#7,#2,#13,#18,#39,city-info").hover(function(e){
        Mouse(e);
        $(".showinfo").css({top:toppos,left:leftpos}).fadeIn(100);
        },function(){
            $(".showinfo").hide();
        });
    $("#31,#64,#25,#7,#2,#13,#18,#39").css('cursor','pointer');
    // city click
   var tagnum = document.getElementsByTagName('path').length;
   for (var i = 0; i < tagnum; i++) {
       document.getElementsByTagName('path')[i].onclick=function() {
       window.location.href='city_search.php?area_id='+this.id;
       };
   };
   // 轮播图比例问题
   setTimeout(adjust_height($('.slides li'), 2.2), 50);
   $(window).resize(adjust_height($('.slides li'), 2.2));
   // 主题推荐的图片比例
   // adjust_casa_thumbnail();
});