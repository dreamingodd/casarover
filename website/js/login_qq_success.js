var access_token;
$(function(){
    // Parse hash "GET" variables, 解析hash GET参数
    access_token = getHashVals(location.hash)['access_token'];
    if (access_token) {
        // Ajax获取openid
        /* 失败原因还不清楚
        $.ajax({
            type:"GET",
            url: "https://graph.qq.com/oauth2.0/me?access_token=" + access_token + "&callback=?",
            dataType:"jsonp",
            error:function(){
                alert("请求openid超时或失败！");
                location.href = "error.php?info=请求openid超时或失败！";
            }
        });
        */
        $.getJSON("https://graph.qq.com/oauth2.0/me?access_token=" + access_token
                + "&callback=?", function(data){
            console.log(data);
        });
    } else {
        location.href = "error.php?info=获取access_token失败！";
    }
});

/**
 * 请求openid的回调函数.
 * 几层的ajax call的嵌套，感觉有些不妥。
 * Data from QQ is processed here, QQ返回值处理在此处理
 */
function callback(data) {
    if (data.error) {
        location.href = "error.php?info=获取access_token失败！&nbsp;Error Message:"
                + data.error + '-' + data.error_description;
    } else {
        var openid = data.openid;
        //从页面收集OpenAPI必要的参数。get_user_info不需要输入参数，因此paras中没有参数
        var paras = {};
        //用JS SDK调用OpenAPI
        QC.api("get_user_info", paras)
            //指定接口访问成功的接收函数，s为成功返回Response对象
            .success(function(s){
                //成功回调，通过s.data获取OpenAPI的返回数据
                $.ajax({
                    type:"POST",
                    url: getAppUrl() + "controllers/login_qq_action.php",
                    dataType:"json",
                    data:{"openid":openid,"nickname":s.data.nickname,"gender":s.data.gender,
                            "filepath":s.data.figureurl_qq_1,"access_token":access_token},
                    success:function(data){
                        console.log(data);
                        window.opener.location.reload(true);
                        window.close();
                    },
                    error:function(data){
                        console.log(data.responseText);
                        location.href = "error.php?info=" + data.responseText;
                    }
                });
            })
            //指定接口访问失败的接收函数，f为失败返回Response对象
            .error(function(f){
                location.href = "error.php?info=获取QQ用户信息失败！&nbsp;Error Message:"
                    + f.data.ret + '-' + f.data.msg;
            })
            //指定接口完成请求后的接收函数，c为完成请求返回Response对象
            .complete(function(c){
                console.log(new Date() + " - get_user_info finished.");
        });
    }
}