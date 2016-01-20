$(document).ready(function(){

    //定位改变
    $(window).scroll(function(){
        var screenT = $(window).scrollTop();
        if(screenT > 650){
            $(".nav_line").removeClass("nav");
            $(".nav_line").addClass("change-nav");
        };
        if(screenT < 160){
            $(".nav_line").removeClass("change-nav");
            $(".nav_line").addClass("nav");
        };
    });

    //casa右侧滚动变化
    // 这个数字是不能固定的
    $(window).scroll(function(){
        var screenT = $(window).scrollTop();
        for(var i = 0; i < 6; i++){
            var kv = $('#m_'+i).offset().top;
            if(kv >= screenT){
                $('.circle').removeClass("circle_activ");
                $("#c_p_"+i).addClass("circle_activ");
                break;
            };
        };
    });
    // 缓慢滑动效果
    $('#nav').onePageNav({
        currentClass: 'current',
        changeHash: false,
        scrollSpeed: 750,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',
        begin: function() {
            //I get fired when the animation is starting
        },
        end: function() {
            //I get fired when the animation is ending
        },
        scrollChange: function($currentListItem) {
            //I get fired when you enter a section and I pass the list item of the section
        }
    });

});//end document