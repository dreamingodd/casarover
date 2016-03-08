$(function(){
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
    // Pocess after clicking form submit. 表单提交
    $('#submit').click(function(){
        var submit = true;
        if (!$('.hidden_photo') || !$('.hidden_photo').val()) {
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
            var filepath = $('.hidden_photo').val();
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