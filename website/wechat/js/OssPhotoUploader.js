require.config({
    paths : {
        "oss_uploader" : "../../js/integration/oss_plupload.full.min",
        "jquery":"../../js/integration/jquery.min",
        "bootstrap":"../../js/integration/bootstrap.min",
        "domready":"../../js/integration/domready"
    },
    shim : {
        bootstrap : {  
            deps : [ 'jquery' ],  
            exports : 'bootstrap'
        }
    }
});
require(['jquery', 'bootstrap', 'oss_uploader', 'domready!'], function($, bootstrap, oss_uploader, domready){
    var accessid = '';
    var host = '';
    var policyBase64 = '';
    var signature = '';
    var key = '';
    var expire = 0;
    var now = timestamp = Date.parse(new Date()) / 1000;
    var limit_size = 1024000;
    var target_folder = "test";
    var uploader = null;

    var oss_uploader_html =
        '<button id="selectfiles" class="oss_uploader btn btn-default btn-sm">选择文件</button>'
        + '<button id="postfiles" class="oss_uploader btn btn-default btn-sm">开始上传</button>';
    // 调出图片选项
    $('body').on('click', '.oss_button .show_uploader', function(){
        $('.oss_uploader').remove();
        $(this).after($(oss_uploader_html));
        uploader = createUploader();
        uploader.init();
        uploader.seq = 0;
        // 删除所有进度条
        $('.progress').parent().remove();
    });
    // 显示图片
    $('.oss_hidden_input .hidden_photo').each(function(){
        var src = $(this).parent().parent().attr('oss_address') + "/" 
                + $(this).parent().parent().attr('target_folder') + "/" 
                + $(this).val();
        $(this).parent().next().append(
                $('<img class="img-thumbnail col-lg-3" style="height:200px;"'
                        + 'title="双击删除" src="'+src+'"/>')
        );
    });
    // 图片删除
    $('body').on('dblclick', '.oss_photo img', function(){
        index = $(this).parent().children().index($(this));
        $(this).parent().prev().children().eq(index).remove();
        $(this).remove();
    });
    /**
     * private method
     * 图片添加
     * */
    function addImg(photoName) {
        // add hidden input
        $('#postfiles').parent().next().append(
                $('<input type="hidden" class="hidden_photo" value="' + photoName + '"/>')
        );
        // add photo displayment
        var src = $('#postfiles').parent().parent().attr('oss_address') + '/'
                + $('#postfiles').parent().parent().attr('target_folder') + '/' + photoName;
        $('#postfiles').parent().next().next().append(
                $('<img class="img-thumbnail col-lg-3" style="height:200px;"'
                        + 'title="双击删除" src="'+src+'"/>')
        );
    }

    /**private method*/
    function isPhoto(file) {
        var filename = file.name;
        var types = ["jpg","gif","bmp","jpeg","png","JPG","GIF","BMP","JPEG","PNG"];
        if (filename) {
            if (filename.lastIndexOf(".") > 0) {
                var filetype = filename.split('.')[filename.split('.').length - 1];
                for (var key in types) {
                    var type = types[key];
                    if (type == filetype) {
                        return true;
                    }
                }
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**private method*/
    function smallThanLimitSize(file) {
        var filesize = file.origSize;
        if ($('#selectfiles').parent().parent().attr('limit_size')) {
            limit_size = 1000 * $('#selectfiles').parent().parent().attr('limit_size');
        }
        if (filesize <= limit_size) return true;
        return false;
    }

    /**private method
     * @param index for photos uploaded in the same time
     * */
    function generateFilename(originFileName) {
        if (originFileName.lastIndexOf(".") > 0) {
            var filetype = originFileName.split('.')[originFileName.split('.').length - 1];
            var date = new Date();
            var dateTimeStr = formatDate(date, "yyyyMMdd-hhmmss-S");
//            var ms = formatDate(date, "-S");
//            ms = ms.length < 4 ? (ms.length < 3 ? ms + "00" : ms + "0") : ms;
//            dateTimeStr += ms.length;
            var prefix = $('#selectfiles').parent().parent().attr('file_prefix');
            if (!prefix) prefix = "test";
            var rand = Math.round(Math.random() * Math.pow(10, 4));
            return prefix + "_" + dateTimeStr + "r" + rand + "." + filetype;
        }
        return null;
    }

    /**private method*/
    function formatDate(date, fmt) {
        // 对Date的扩展，将 Date 转化为指定格式的String 
        // 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符， 
        // 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字) 
        // 例子： 
        // (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423 
        // (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18 
        var o = { 
            "M+" : date.getMonth()+1,                 //月份 
            "d+" : date.getDate(),                    //日 
            "h+" : date.getHours(),                   //小时 
            "m+" : date.getMinutes(),                 //分 
            "s+" : date.getSeconds(),                 //秒 
            "q+" : Math.floor((date.getMonth()+3)/3), //季度 
            "S"  : date.getMilliseconds()             //毫秒 
        }; 
        if(/(y+)/.test(fmt)) {
            fmt=fmt.replace(RegExp.$1, (date.getFullYear()+"").substr(4 - RegExp.$1.length)); 
        }
        for(var k in o) {
            if (new RegExp("("+ k +")").test(fmt)) 
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length==1) ? (o[k]) : (("00"+ o[k]).substr((""+ o[k]).length))); 
        }
        return fmt; 
    }

    /**set request to get signature.
     * */
    function send_request() {
        var xmlhttp = null;
        if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        if (xmlhttp!=null) {
            if ($('#selectfiles').parent().parent().attr('target_folder')) {
                target_folder = $('#selectfiles').parent().parent().attr('target_folder');
            }
            var params = 'target_folder=' + target_folder;
            var phpUrl = "";
            if ($('.oss_photo_tool').attr('php_path')) {
                phpUrl = $('.oss_photo_tool').attr('php_path');
            } else {
                phpUrl = './oss/php/get.php?'+params;
            }
            xmlhttp.open( "GET", phpUrl, false );
            xmlhttp.send( null );
            return xmlhttp.responseText;
        }
        else {
            alert("Your browser does not support XMLHTTP.");
        }
    };

    function get_signature() {
        //可以判断当前expire是否超过了当前时间,如果超过了当前时间,就重新取一下.3s 做为缓冲
        now = timestamp = Date.parse(new Date()) / 1000; 
        console.log('get_signature ...');
        console.log('expire:' + expire.toString());
        console.log('now:', + now.toString());
        // re-acquire forever, 'cause I need set_upload_param to run every time to change the file name.
        //if (expire < now + 3) {
            console.log('get new sign');
            body = send_request();
            var obj = eval ("(" + body + ")");
            host = obj['host'];
            policyBase64 = obj['policy'];
            accessid = obj['accessid'];
            signature = obj['signature'];
            expire = parseInt(obj['expire']);
            key = obj['dir'];
            return true;
        //}
//        return false;
    };

    /**
     * This method is invoked by upload's methods.
     */
    function set_upload_param(up) {
        var ret = get_signature();
        if (ret == true) {
            var filename = '${filename}';
            if (uploader.seq < up.files.length) {
                filename = up.files[uploader.seq].name;
                filename = generateFilename(filename);
                // change the filename in the files, used in diplaying photo display.
                up.files[uploader.seq].name = filename;
            }
            new_multipart_params = {
                    'key' : key + filename,
                    'policy': policyBase64,
                    'OSSAccessKeyId': accessid, 
                    'success_action_status' : '200', //让服务端返回200,不然，默认会返回204
                    'signature': signature,
            };

            up.setOption({
                'url': host,
                'multipart_params': new_multipart_params
            });

            console.log('reset uploader');
        }
    };

    function createUploader() {
        return new plupload.Uploader({

            runtimes : 'html5,flash,silverlight,html4',
            browse_button : 'selectfiles', 
            flash_swf_url : '../oss/lib/plupload-2.1.2/js/Moxie.swf',
            silverlight_xap_url : '../oss/lib/plupload-2.1.2/js/Moxie.xap',

            url : 'http://oss.aliyuncs.com',

            init: {
                PostInit: function() {
                    $('#postfiles').click(function(e) {
                        set_upload_param(uploader);
                        uploader.start();
                        return false;
                    });
                },

                FilesAdded: function(up, files) {
                    var checkedFiles = new Array();
                    for (var i = 0; i < files.length; i++) {
                        // check the file type
                        var file = files[i];
                        if (!isPhoto(file)) {
                            alert(file.name + "--格式不支持！");
                            $('#postfiles').parent().children().first().siblings().remove();
                        }
                        // check the file size
                        if (!smallThanLimitSize(file)) {
                            alert(file.name + "--图片大小超过限定大小！");
                            $('#postfiles').parent().children().first().siblings().remove();
                        }
                        checkedFiles.push(file);
                    }
                    plupload.each(checkedFiles, function(file) {
                        $('#postfiles').parent().append($('<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ')<b></b>'
                        + '<div class="progress" style="width:300px;"><div class="progress-bar progress-bar-success progress-bar-striped active"'
                        + ' role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div>'
                        + '</div>'));
                    });
                },

                UploadProgress: function(up, file) {
                    var d = document.getElementById(file.id);
                    d.getElementsByTagName('b')[0].innerHTML =
                            '&nbsp;<span>' + (file.percent == 100 ? 99:file.percent) + "%</span>";
                    var prog = d.getElementsByTagName('div')[0];
                    var progBar = prog.getElementsByTagName('div')[0];
                    progBar.style.width= 3*file.percent+'px';
                    progBar.setAttribute('aria-valuenow', file.percent);
                },

                FileUploaded: function(up, file, info) {
                    console.log('uploaded');
                    console.log(file);
                    if (info.status >= 200 || info.status < 200) {
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '100%';
                        addImg(up.files[up.seq].name);
                        up.seq++;
                    } else {
                        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = info.response;
                    }
                    set_upload_param(up);
                },

                Error: function(up, err) {
                    set_upload_param(up);
                    console.log(err.response);
                    //document.getElementById('console').appendChild(document.createTextNode("\nError xml:" + err.response));
                }
            }
        });
    }

});
