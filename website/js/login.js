$(function(){
    QC.Login({
        //插入按钮的节点id
        btnId:"qqLoginBtn"
    });
    $('#cellphone_number').blur(checkCellphone);
    $('#password').blur(checkPassword);
    // 手机号登陆
    $('#login').click(function(){
        $('#password').blur();
        $('#cellphone_number').blur();
        if ($('.input_error').length == 0) {
            $.ajax({
                type     : "POST",
                url      : getAppUrl() + "controllers/login_phone_action.php",
                data     : {"cellphone_number" : $('#cellphone_number').val(), "password" : $('#password').val()},
                dataType : "json",
                success  : function(data) {
                    if (data.msg == "success") {
                        window.location.href = window.location.href.replace('auto_login=true','');;
                    } else {
                        alert("JSON返回success，未知错误！");
                    }
                },
                error    : function(data) {
                    $('#error_msg').html(data.responseText);
                }
            });
        }
    });
    // 退出登录
    $('#logout').click(function(){
        // 退出QQ
        QC.Login.signOut();
        location.href = getBaseUrl() + 'application/controllers/logout_action.php';
    });
});
function checkCellphone() {
    if (is_cellphone_number($(this).val())) {
        $(this).removeClass("input_error");
        $('#error_msg').html('&nbsp');
    } else {
        $(this).addClass("input_error");
        $('#error_msg').html('请输入正确的手机号码！');
    }
}
function checkPassword() {
    if ($(this).val()) {
        $(this).removeClass("input_error");
        $('#error_msg').html('&nbsp');
    } else {
        $(this).addClass("input_error");
        $('#error_msg').html('请输入密码！');
    }
}