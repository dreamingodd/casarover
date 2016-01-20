$(function() {
    /* 添加或删除轮播图 */
    $('.add_huge_pic').click(function(){
        $('.huge_pics_div').append(newTemplate());
    });
    $('body').on('click', '.del_huge_pic', function(){
        $(this).parent().parent().remove();
    });
    /* 显示photo */
    $('.path_input').each(function(){
        if ($(this).val()) {
            $(this).after(newTemplateImg($(this).val()));
        }
    });
});
function newTemplate() {
    var template = $('#template');
    var newTemplate = template.clone();
    newTemplate.css('display', 'block');
    newTemplate.attr('id', '');
    return newTemplate;
}
function newTemplateForm() {
    var templateForm = $('#template_form');
    var newTemplateForm = templateForm.clone();
    newTemplateForm.css('display', 'block');
    newTemplateForm.attr('id', '');
    return newTemplateForm;
}
function newTemplateImg(path) {
    var templateImg = $('#template_img');
    var newTemplateImg = templateImg.clone();
    newTemplateImg.css('display', 'block');
    newTemplateImg.attr('id', '');
    newTemplateImg.children().attr('src', path);
    return newTemplateImg;
}