$(function(){
    // 获取验证码倒计时
    var countdown = 120;
    // url
    var appUrl = getAppUrl();
    // 伪按钮
    $('#get-code-dummy').hide();
    $('#get-code-dummy').css('cursor', 'wait');
    $('#get-code-dummy').css('color', '#aaaaaa');
    // click to send the verification code. 点击获取验证码
    $('#get-code').click(function(){
        // check celllphone number
        $('#cellphone_number').blur();
        if ($('#cellphone_number').hasClass('input_error')) {
            alert("请填写正确的手机号码！");
        } else {
            // Request sending needs interval. Countdown and disable the button.
            $('#get-code-dummy').html(countdown);
            $('#get-code').hide();
            $('#get-code-dummy').show();
            setTimeout(function(){
                $('#get-code-dummy').html(countdown - 1);
                if (countdown > 1) {
                    countdown -= 1;
                    setTimeout(arguments.callee, 1000);
                } else {
                    $('#get-code-dummy').hide();
                    $('#get-code').show();
                    countdown = 120;
                }
            }, 1000);
            // ajax request generating the verify code and send it to user's cellphone.
            $.ajax({
                type:"POST",
                url: appUrl + "controllers/send_verify_action.php?cellphone_number=" + $('#cellphone_number').val(),
                data:"",
                dataType:"json",
                success:function(data) {
                    console.log(data);
                },
                error:function(data) {
                    alert('获取验证码失败！\n' + data.responseText);
                }
            });
        }
    });
    // check the user-input format.
    $('#cellphone_number').blur(checkCellphone);
    $('#verify_code').blur(checkVerifyCode);
    $('#password').blur(checkPassword);
    $('#register').click(function(){
        $('#cellphone_number').blur();
        $('#verify_code').blur();
        $('#password').blur();
        if ($('.input_error').length == 0) {
            var form = $('#register_form');
            form.prop('action', appUrl + 'controllers/register_action.php');
            form.submit();
        } else {
            if ($('#cellphone_number').hasClass('input_error')) alert('请输入正确的手机号码！');
            if ($('#verify_code').hasClass('input_error')) alert('请填写正确的验证码（六位数字）！');
            if ($('#password').hasClass('input_error')) alert('请输入符合规则的密码！');
        }
    });
});
function checkCellphone() {
    if (is_cellphone_number($(this).val())) {
        $(this).removeClass("input_error");
    } else {
        $(this).addClass("input_error");
    }
}
function checkVerifyCode(){
    if (is_legal_verify_code($(this).val())) {
        $(this).removeClass("input_error");
    } else {
        $(this).addClass("input_error");
    }
}
function checkPassword(){
    if (is_legal_password($(this).val())) {
        $(this).removeClass("input_error");
    } else {
        $(this).addClass("input_error");
    }
}