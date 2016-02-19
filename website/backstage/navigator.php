<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<input type="hidden" id="backstage_url" value="<?php echo getUrl(); ?>"/>
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav nav-pills nav-justified">
            <li role="presentation" class="dropdown home">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">首页管理<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="not_complete" href="<?php echo getBaseUrl()?>website/backstage/huge_pics_edit.php">轮播图</a></li>
                    <li><a class="not_complete" href="<?php echo getBaseUrl()?>website/backstage/theme_list.php" >主题推荐</a></li>
                </ul>
            </li>
            <li role="presentation" class="area">
                <a href="<?php echo getBaseUrl()?>website/backstage/area_list.php">区域管理</a>
            </li>
            <li role="presentation" class="casa">
                <a href="<?php echo getBaseUrl()?>website/backstage/casa_list.php">民宿管理</a>
            </li>
            <li role="presentation" class="dropdown wechat">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">微信管理<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="not_complete" href="<?php echo getBaseUrl()?>website/wechat/wechat_huge_pics_edit.php">轮播图</a></li>
                    <li><a href="<?php echo getBaseUrl()?>website/wechat/wechat_series_list.php">探庐系列-子标题</a></li>
                    <li><a href="<?php echo getBaseUrl()?>website/wechat/wechat_article_list.php?type=1">探庐系列</a></li>
                    <li><a href="<?php echo getBaseUrl()?>website/wechat/wechat_article_list.php?type=2">民宿风采</a></li>
                    <li><a href="<?php echo getBaseUrl()?>website/wechat/wechat_article_list.php?type=3">主题民宿</a></li>
                </ul>
            </li>
            <!-- 
            <li role="presentation" class="reward">
                <a href="reward_list.php">领奖操作</a>
            </li>
             -->
            <li role="presentation" class="clean not_complete">
                <a href="<?php echo getBaseUrl()?>website/backstage/clean_cache.php">清空缓存</a>
            </li>
            <li role="presentation" class="logout">
                <a href="<?php echo getBaseUrl()?>application/controllers/logout_action.php?location=backstage">退出</a>
            </li>
        </ul>
    </div>
</div>