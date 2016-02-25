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
        var recommendCasas = getRecommendCasaIdsAsStr();
        $("#recommendCasas").val(recommendCasas);
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

    // Selection add and remove
    $('body').on('click', '#casa_move_right', function(){
        $('#casa_select_left select option').each(function(){
            if ($(this).prop('selected')) {
                $('#casa_select_right select').append($(this));
            }
        });
    });
    $('body').on('click', '#casa_move_left', function(){
        $('#casa_select_right select option').each(function(){
            if ($(this).prop('selected')) {
                $('#casa_select_left select').append($(this));
            }
        });
    });
});
/**
 * Collect casa ids in casa_select_right as string.
 * return eg. 1,4,15 etc.
 */
function getRecommendCasaIdsAsStr() {
    var select_casa_ids_str = "";
    var select_casa_ids = [];
    $('#casa_select_right select option').each(function(){
        select_casa_ids.push($(this).val());
    });
    for (var i=0; i<select_casa_ids.length; i++) {
        select_casa_ids_str += "," + select_casa_ids[i];
    }
    if (select_casa_ids_str) select_casa_ids_str = select_casa_ids_str.substring(1);
    return select_casa_ids_str;
}