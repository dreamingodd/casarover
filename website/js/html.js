$(document).ready(function(){
    // 关于我们页面slider
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });

    var type = $('#type').val();
    $('.cate').css('display','none');
    $('.'+type).css('display','block');
});//end document