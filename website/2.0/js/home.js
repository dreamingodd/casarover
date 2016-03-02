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
	$("#test").click(function(){
		var items = [
			          { message: '第一个',short:"这个是介绍" },
			          { message: '第二个',short:"这个是第二个介绍" }
			        ];
		new Vue({
			  el: '#theme',
			  data: {
			    items:items 
			  }
			})
	})
})