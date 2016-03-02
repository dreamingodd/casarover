<!-- QQ登陆需要JS SDK支持 -->
<script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js"
        data-appid="101273381" data-redirecturi="http://www.casarover.com/casarover/website/login_qq_success.php" charset="utf-8"></script>
<script src="js/login.js"></script>
<!-- 登陆模态框 -->
<div class="modal fade" id="mModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog login-modal">
        <div class="modal-content">
            <div class="modal-header login-header-m"></div>
            <form class="login_form" method="post">
                <div class="form-group login-input-m">
                    <input id="cellphone_number" type="text" class="form-control" placeholder="手机号">
                </div>
                <div class="form-group login-input-m">
                    <input id="password" type="password" class="form-control" placeholder="密码">
                </div>
                <div id="error_msg" class="checkbox login-checkbox-m" style="color:red;">&nbsp;</div>
                <div class="logn_sub">
                    <input id="login" type="button" class="btn btn-default btn-block btn-bgc" value="登录">
                </div>
            </form>
            <div class="modal-footer">
                <div class="modal-footer-bot">
                    <div class="login-more">更多方式登录</div>
                    <div class="content-qq">
                        <span id="qqLoginBtn"></span>
                        <!-- <a href=""><img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/qq.png" alt=""></a> -->
                    </div>
                    <!-- 
                    <div class="content-weixin">
                        <a href=""><img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/weixin.png" alt=""></a>
                    </div>
                     -->
                </div>
                <div class="clear"></div>
                <div class="login-more-bottom" style="text-align: center">
                    <a href="" class="forget" target="_blank">忘记密码</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="">注册新账号</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end模态框 -->