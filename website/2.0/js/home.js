$(document).ready(function(){
	$('.flexslider').flexslider({
	    directionNav: true,
	    pauseOnAction: false
	});
	$('.search-input input').click(function(){
		$('.search-place').css('display','block');
	})
	$('.search-input input').blur(function(){
		$('.search-place').css('display','none');
	})
})