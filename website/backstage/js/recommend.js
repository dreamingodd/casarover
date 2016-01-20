$(function(){
	$("#save").click(function(){
		var data ='';
		$(".form-control").each(function () {
			data = data+this.value+";";
		});
		var getUrl = "../../application/controllers/HomeController.php?c=create";
		$.ajax({
		type:'get',
		url: getUrl,
		data: {
			recomms:data,
		},
		success: function(data) {
			console.log(data);
		},
		dataType: 'text',
		error:function (data) {
			console.log(data);
		}
		});
	})

});