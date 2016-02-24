<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/cache/AreaCache.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/services/AreaService.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/controllers/SessionController.php';?>
<?php 
    $areaCache = new AreaCache();
    $baseurl = getBaseUrl();
    $citydata = $areaCache->getCities();
?>
<input type="hidden" id="base_url" value="<?php echo getUrl()?>"/>
<input type="hidden" id="web_url" value="<?php echo getUrl(); ?>"/>
<div class="header hidden-xs">
    <div class="header-left">
        <a class="" href="<?php echo getUrl()?>">
            <img src="image/logo.png" alt="logo">
        </a>
        <div class="header-right">
            <div class="header-right-nav">
                <span id="wx">关注微信</span>
            </div>
    
            <!-- check whether user login or not. -->
            <?php 
            $sessionController = new SessionController();
            $user_json = $sessionController->getUserJson();
            if (empty($user_json)) {
            ?>
                <div class="header-right-nav">
                    <a href="" id="login_btn" data-toggle="modal" data-target="#mModal">登录</a>
                </div>
                <div class="header-right-nav">
                    <a href="register.php">注册</a>
                </div>
            <?php 
            } else {
                $user = json_decode($user_json);
            ?>
                <div class="header-right-nav">
                    <img alt="" src="">
                    <a href="person.php">
                        <?php echo $user->username?>
                    </a>
                </div>
                <div class="header-right-nav">
                    <a href="#" id="logout">退出</a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>
    <div id="wxImg" style="">
        <img src="image/qcode.jpg" width="100%" alt="">
    </div>
</div>
<div class="m-full" id="full-search" style="display:none;">
    <span class="glyphicon glyphicon-chevron-left back" aria-hidden="true"></span>
    <input type="text" class="form-control" placeholder="搜索或选择" >
    <span class="search">搜索</span>
    <div class="clear"></div>
    <div class="visible-xs">
      <ul class="m-citysearch">
        <?php foreach ($citydata as $value): ?>
            <li><a href="<?php echo $baseurl.'website/city_search.php?area_id='.$value->id ?>"><?php echo $value->name; ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
</div>
<nav class="navbar navbar-default visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" style="bacground:red" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo getUrl()?>"><img src="image/logo.png" height="100%" alt=""></a>
            <form action="" class="head-search" id="search">
                <input type="text" placeholder="选择目的地" class="form-control" readonly="readonly">
            </form>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">登录 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">注册</a></li>
            </ul>
        </div>
    </div>
</nav>
