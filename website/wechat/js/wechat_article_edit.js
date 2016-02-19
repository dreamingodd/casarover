$(function(){
    /* Below are uploading IMAGE related. */
    // 内容部分-上传图片绑定ajax事件
    $('body').on('change', '#fileupload', upload_photo('#template_upload_form', 36));
    // Display the photo after it is uploaded. 显示图片或图片上传Form
    $('.hidden_photo').each(function(){
        var filepath = $(this).val();
        if (filepath) {
            showPhoto(filepath, $(this), false);
        } else {
            $(this).after(newTemplateUploadForm());
        }
    });
    // 一级标题选择 Choose Type.
    //// Collect series from html doms.
    var series_list = collectSeriesList();
    $('.type_li').click(function() {
        $('.type_text').html($(this).html());
        $('#type').val($(this).attr('db_id'));
        fillSeriesUl(series_list, $(this).attr('db_id'));
    });
    $('.type_li').each(function(){
        var type_id = $('#type').val();
        if (type_id == $(this).attr('db_id')) {
            $('.type_text').html($(this).html());
        }
    });
    // 二级标题选择 Choose series
    //// 根据type确定series, show series list which belongs to the pre-selected type.
    if ($('#type').val()) {
        fillSeriesUl(series_list, $('#type').val());
    }
    //// Pre-selected series.
    if ($('#series').val()) {
        var series = null;
        for (var i = 0; i < series_list.length; i++) {
            if ($('#series').val() == series_list[i].id) {
                series = series_list[i];
            }
        }
        if (series) {
            $('.series_text').html(series.name);
            $('#series').val(series.id);
        }
    }
    //// Select series.
    $('.series_li').click(function(){
        $('.series_text').html($(this).html());
        $('#series').val($(this).attr('db_id'));
    });
    // 点击图片删除事件，click image remove div(button).
    $('body').on('click', '.img-remove', function() {
        $(this).parent().after(newTemplateUploadForm());
        $.ajax({
            url:'../../application/controllers/photo_upload_action.php?action=delete&filename='
                    + $(this).attr('filepath'),
            type:'get',
            data:{},
            dataType:'json',
            success:function(data){
                console.log(data.msg);
            },
            error:function(data){
                console.log(data);
                alert('服务器删除失败！对用户不会有影响，如图片不存在，请忽略。其他情况请提示开发人员，谢谢！');
            }
        });
        $(this).parent().remove();
    });
    // Pocess after clicking form submit. 表单提交
    $('#submit').click(function(){
        var submit = true;
        if (!$('img') || !$('img').attr('filepath')) {
            submit = false;
            alert('请上传图片！');
        }
        if (!$('#address').val()) {
            submit = false;
            alert('请输入链接！');
        }
        if (!$('#title').val()) {
            submit = false;
            alert('请输入标题！');
        }
        if (!$('#brief').val()) {
            submit = false;
            alert('请输入简介！');
        }
        if (submit) {
            var filepath = $('img').attr('filepath');
            var form = $('#wechat_article_form');
            form.attr('action', form.attr('action') + '?filepath=' + filepath);
            form.submit();
        }
    });
});

function collectSeriesList() {
    var series_list = [];
    $('#series_list').children().each(function(){
        var series = {};
        series.id = $(this).attr('db_id');
        series.name = $(this).attr('name');
        series.type = $(this).attr('type');
        series_list.push(series);
    });
    return series_list;
}
function fillSeriesUl(series_list, type) {
    $('#series_ul').children().remove();
    for (var i = 0; i < series_list.length; i++) {
        var series = series_list[i];
        if (type == series.type) {
            var li = $('<li class="series_li"></li>');
            li.html(series.name);
            li.attr('db_id', series.id);
            $('#series_ul').append(li);
        }
    }
}