require.config({
    paths : {
        "jquery" : "../../js/integration/jquery.min",
        "bootstrap" : "../../js/integration/bootstrap.min",
        "json2" : "../../js/integration/json2",
        "domready" : "../../js/integration/domready",
        "oss_uploader" : "../oss/lib/plupload-2.1.2/js/plupload.full.min",
    },
    shim : {
        bootstrap : {  
            deps : [ 'jquery' ],  
            exports : 'bootstrap'  
        },
        OssPhotoTool : {
            deps : ['oss_uploader', 'bootstrap'],
            exprots : 'OssPhotoTool'
        }
    }
});
require(["domready!", "jquery", "bootstrap", "json2", "common", "oss_uploader", "OssPhotoUploader"],
        function(domready, $, bootstrap, json2, common, oss_uploader, OssTool){

    // 图片路径
    var photo_path = '../../../photo/';
    // 图片上传from
    var html_photo_form =
            '<form class="photo-form" id="photo_upload_form" action="../../application/controllers/photo_upload_action.php"'
            + '    method="post" enctype="multipart/form-data">'
            + '  <div class="col-lg-12 vertical5">'
            // input's name will be the key of file object in FILES
            + '    <input type="file" id="fileupload" name="photo">'
            + '  </div>' + '</form>';
    var html_main_photo_form =
            '<form class="photo-form" id="main_photo_upload_form" action="../../application/controllers/photo_upload_action.php" method="post" enctype="multipart/form-data">'
            +    '<div class="col-lg-12 vertical5">'
            +        '<input type="file" id="mainupload" name="photo">'
            +    '</div>'
            +'</form>';
    // 图片展示元素html
    var html_img =
            '<div class="photo-wrapper" style="position:relative;float:left">'
            + '  <img style="max-width:393px;" class="photo img-rounded">'
            + '  <span class="img-remove glyphicon glyphicon-remove" style="position:absolute;z-index:2;opacity:0.7;top:0;font-size:40px;"></span>'
            + '</div>';
    // content空的内容 元素div
    var html_content = 
        '<div class="content">'
        +   '<div class="name col-lg-2 vertical5">'
        +      '<input type="text" class="form-control" aria-describedby="sizing-addon3" />'
        +   '</div>'
        +   '<div class="col-lg-10 vertical5">'
        +       '<button type="button" class="btn btn-info add-photo">添加图片</button>&nbsp;'
        +       '<button type="button" class="btn btn-info add_content">插入内容</button>&nbsp;'
        +       '<button type="button" class="btn btn-info del_content">删除内容</button>'
        +   '</div>'
        +   '<div class="text col-lg-12 vertical5">'
        +       '<textarea rows="3" cols="150"></textarea>'
        +   '</div>'
        +'</div>';

    /* Mode confirmation: ADD or EDIT */
    var casa_id = $('#casa_id').val();
    if (casa_id) {
        $('title').html('探庐者后台-编辑民宿');
        $('h3').html('后台管理-编辑民宿');
        $('#casa_content_template').remove();
        // 显示图片
        $('.hidden_photo').each(function(){
            var filepath = $(this).val();
            showImg(filepath, $(this), true);
        });
    } else {
        $('.main-photo').append($(html_main_photo_form));
    }

    // content 显示设置 替换"<br/>"为"\n", 当然上传的时候也做了相反的替换
    $('textarea').each(function() {
        $(this).html(common.BRtoLF($(this).html()));
    });

    /* 添加和删除内容功能 */
    $('body').on('click', '.add_content', function(){
        $(this).parent().parent().after($(html_content));
    });
    $('body').on('click', '.del_content', function(){
        $(this).parent().parent().remove();
    });

    /* Below are uploading IMAGE related. */
    // 内容部分-上传图片绑定ajax事件
    $('body').on('change', '#fileupload', function() {
        $("#photo_upload_form").ajaxSubmit({
            dataType : 'json',
            success : function(data) {
                console.log('img upload success');
                showImg(data.filename, $('#photo_upload_form'));
            },
            error : function(xhr) {
                console.log(xhr.responseText);
                alert('上传失败，ajax返回error，' + xhr.responseText + '，如有疑问请咨询开发人员！');
            }
        });
    });
    // 民宿主图-上传图片绑定ajax事件
    $('body').on('change', '#mainupload', function() {
        $("#main_photo_upload_form").ajaxSubmit({
            dataType : 'json',
            success : function(data) {
                console.log('img upload success');
                showImg(data.filename, $('#main_photo_upload_form'), true);
            },
            error : function(xhr) {
                console.log(xhr.responseText);
                alert('上传失败，ajax返回error，' + xhr.responseText + '，如有疑问请咨询开发人员！');
            }
        });
    });
    // click '添加图片' event, 显示提交图片的form
    $('body').on('click','.add-photo', function() {
        $('#photo_upload_form').remove();
        $(this).parent().after($(html_photo_form));
    });
    // click image remove div(button)
    $('body').on('click', '.img-remove', function() {
        if ($(this).parent().parent().hasClass('main-photo')) {
            $(this).parent().after($(html_main_photo_form));
        }
        $.ajax({
            url:'../../application/controllers/photo_upload_action.php?action=delete&filename='
                    + $(this).attr('filename'),
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

    /* Below are TAG editing related. */
    // 点击标签事件
    $('.tags span').click(function() {
        if ($(this).hasClass('label-default')) {
            $(this).removeClass('label-default');
            $(this).addClass('label-info');
        } else if ($(this).hasClass('label-info')) {
            $(this).removeClass('label-info');
            $(this).addClass('label-default');
        }
    });

    /* Below are area select related */
    $('#cities').hide();
    $('#districts').hide();
    var areas_json = $('#areas_json').val();
    var areas = JSON.parse(areas_json);
    for ( var id in areas) {
        var area = areas[id];
        var li = createAreaLi(area);
        $('#province_ul').append(li);
    }
    $('body').on(
            'click',
            '#area_div li',
            function() {
                var id = $(this).attr('db_id');
                var parentid = $(this).attr('parentid');
                var islast = $(this).attr('islast');
                $(this).parent().parent().children('.btn').children(
                        '.area_text').html($(this).html());
                // 点击省, 数据库里1是中国
                if (parentid == 1) {
                    $('#districts').hide();
                    $('#city_ul').html('');
                    $('#cities .area_text').html('市');
                    var province = areas[id];
                    for ( var city_id in province.sub_areas) {
                        var city = province.sub_areas[city_id];
                        var li = createAreaLi(city);
                        $('#city_ul').append(li);
                    }
                    $('#cities').show();
                }
                // 点击叶子节点
                else if (islast == 1) {
                    $('#area').val(id);
                    $('#area_fullname').remove();
                }
                // 点击市(上海这种地方的区进入上面那个判断)
                else {
                    $('#district_ul').html('');
                    var city = areas[parentid].sub_areas[id];
                    for ( var district_id in city.sub_areas) {
                        var district = city.sub_areas[district_id];
                        var li = createAreaLi(district);
                        $('#district_ul').append(li);
                    }
                    $('#districts').show();
                }
            });

    /* Below are the casa form submitting related. */
    /*
     * 民宿对象 Casa: name, code, area(int) tags[](int), user_tags[] contents[]
     * Content: name, content, photos[]
     */
    // 点击提交
    $('#submit_btn').click(function() {
        // 1.构建民宿对象
        var casa = createCasa();
        if (!casa)
            return;
        // 2.解析页面必选标签
        casa.tags = collectTags();
        // 3.解析自定义标签
        casa.user_tags = collectUserTags();
        // 4.解析内容模块
        casa.contents = collectContents();
        // 5.提交
        $('#casa_JSON_str').val(JSON.stringify(casa));
        $('#casa_form').submit();
    });

    /**
     * 将一个区域对象转换成一个li DOM节点.
     * 
     * @param area
     *            省/市/区
     * @returns
     */
    function createAreaLi(area) {
        var li = $("<li></li>");
        li.attr('db_id', area.id);
        li.attr('islast', area.islast);
        li.attr('parentid', area.parentid);
        li.html(area.name);
        return li;
    }
    
    /**
     * 创建民宿对象
     * @returns casa object
     */
    function createCasa() {
        var casa = {};
        casa.id = $('#casa_id').val();
        casa.name = $.trim($('#name').val());
        casa.code = $.trim($('#code').val());
        casa.area = Number($.trim($('#area').val()));
        casa.link = $('#link').val();
        casa.main_photo = $('#main_img').attr('filename');
        if (!casa.name || !casa.code || !casa.area || !casa.main_photo) {
            alert('民宿名称、编码、地区、默认图片均不能为空！');
            return;
        }
        return casa;
    }
    /**
     * 从页面收集被点击过的标签（蓝色）.
     * @returns 标签集合
     */
    function collectTags() {
        tags = [];
        $('.tags span').each(function() {
            if ($(this).hasClass('label-info')) {
                tags.push(Number($(this).attr('db_id')));
            }
        });
        return tags;
    }
    /**
     * 转换text input's value to 自定义标签集合.
     * @returns 自定义标签集合
     */
    function collectUserTags() {
        user_tags = [];
        // 替换英文逗号
        if ($('#user_tags').val()) {
            user_tags_str = $('#user_tags').val().replace(new RegExp(',', 'gm'),
                    '，');
            user_tags = user_tags_str.split('，');
            for ( var i = 0; i < user_tags.length; i++) {
                user_tags[i] = $.trim(user_tags[i]);
            }
        }
        return user_tags;
    }
    function collectContents() {
        contents = [];
        $('.content').each(function() {
            var content = {};
            content.name = $(this).children('.name').children(0).val();
            content.text = $(this).children('.text').children(0).val();
            content.text = common.LFtoBR(content.text);
            content.photos = [];
            $(this).children('.photo-wrapper').each(function() {
                content.photos.push($(this).children('.photo').attr('filename'));
            });
            contents.push(content);
        });
        return contents;
    }
    /**
     * show the uploaded or existed image and hide the form DOM.
     * @filename String image name
     * @param Object form DOM
     * @isMain boolean either it is casa main image or not
     */
    function showImg(filename, dom, isMain) {
        var dom_img = $(html_img);
        dom_img.children(0).prop('src', photo_path + filename);
        dom_img.children(0).attr('filename', filename);
        if (isMain) dom_img.children(0).attr('id', 'main_img');
        if (dom) {
            // display image which is just uploaded
            dom.after(dom_img); 
            // remove upload img button(form)
            dom.remove();
        }
    }
});
