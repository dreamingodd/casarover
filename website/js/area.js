$(document).ready(function(){
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });

      var imgHei = 0;
      var imgWid = 0;
      var big = 1.1;
      $('.house-d-pic img').animate({width: 400}, 0);
      $('.house-d-pic').mouseover(function(){
        imgWid = $(this).find("img").width();
        imgHei = $(this).find("img").height();
        var imgWid2 = 0;
        var imgHei2 = 0;
        imgWid2 = imgWid * big;
        imgHei2 = imgHei * big;
        gridimage = $(this).find('img');
        gridimage.stop().animate({width: imgWid2,height:imgHei2,"margin-top":"-27px","margin-left":"-27px"}, 900);
    }).mouseout(function(){
        gridimage.stop().animate({width: imgWid,height:imgHei,"margin-top":"0","margin-left":"0"}, 900);
      });
});//end document