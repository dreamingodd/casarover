$(document).ready(function(){
	var appUrl = getAppUrl();
	$("#change-name").click(function() {
		$(".name").addClass("name-change");
	})
	$("#change-phone").click(function() {
		$(".phone").addClass("phone-change");
	})

	$('#get-code').click(function() {
		var phone = $("#true-phone").val();
		var postUrl = appUrl+'controllers/UserController.php?c=checkphone'
        $.ajax({
        type:'post',
        url: postUrl,
        data: {
            phone:phone
        },
        success: function(data) {
            console.log(data.msg);
            if (data.msg == 'no') {
            	alert("手机号已被注册");
            };
        },
        dataType: 'json',
        error:function (data) {
        	console.log(data);
            // alert("something is wrong");
        }
        });
	})
	$.ms_DatePicker({
	          YearSelector: ".sel_year",
	          MonthSelector: ".sel_month",
	          DaySelector: ".sel_day"
	  });
	$.ms_DatePicker();
})