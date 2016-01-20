$(function () {
    $("#true-name").val($("#name").val());
    var pic_name = $("#preview-head").children().attr("name");
    $("#true-headpic").val(pic_name);

    // 防止后退数据不刷新
    $("#true-somepic").val('');
    $("#submit_btn").click(function () {
        $("#true-name").val($("#name").val());
        // 对四张图片进行收集
        var picdata ='';
        $("#preview").children('img').each(function() {
            var data = $(this).attr("name");
            picdata = picdata + data + ';';
        });
        $("#true-somepic").val(picdata);
    });
    $('body').on('click','.del', function() {
        $(this).next().remove();
        $(this).remove();
    });
    $("#del").on("click",function() {
        $("#preview").children('img').each(function  () {
            $(this).before('<span class="del btn btn-default" >删除</span>');
        });
    });
    // 多图上传
    $('#photoimg').off('click').on('change', function(){
        var btn = $("#up_btn");
        $("#imageform").ajaxForm({
            target: '#preview', 
            beforeSubmit:function(){
                btn.hide();
            }, 
            success:function(){
                $(this).children('span').each(function () {
                    $(this).remove();
                });
                btn.show();
            }, 
            error:function(){
                btn.show();
        } }).submit();
    });

    // 首图
    $('#photoimghead').off('click').on('change', function(){
            var btn = $("#up_btn-head");
            $("#imageform-head").ajaxForm({
                target: '#preview-head', 
                beforeSubmit:function(){
                    $("#preview-head").children().remove();
                    btn.hide();
                }, 
                success:function(){
                    $(".done").css("display","none");
                    var pic_name = $("#preview-head").children().attr("name");
                    $("#true-headpic").val(pic_name);
                    btn.show();
                }, 
                error:function(){
                    btn.show();
            } }).submit();
        });
});
