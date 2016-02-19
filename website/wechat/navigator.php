<?php include_once 'WechatSeriesDao.php';?>
<div class="flexslider">
    <ul class="slides">
        <li onclick="goto_link1()"
                style="background:url('http://7xp9p2.com1.z0.glb.clouddn.com/banner-01.jpg') ; background-size:100% 100%; "></li>
        <li onclick="goto_link2()"
                style="background:url('http://7xp9p2.com1.z0.glb.clouddn.com/banner-02.jpg') ; background-size:100% 100%; "></li>
    </ul>
</div>
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav nav-justified">
            <li role="presentation" class="scenery nav_one">
                <a href="wechat_index.php?type=2">民宿风采</a>
            </li>
            <li role="presentation" class="series dropdown nav_one">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">探庐系列<span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php 
                    $seriesDao = new WechatSeriesDao();
                    $series_list = $seriesDao->getAll();
                    while ($row = mysql_fetch_array($series_list)) {
                        if ($row['type'] == 1) {
                    ?>
                            <li><a href="wechat_index.php?type=1&series=<?php echo $row['id']?>">
                                <?php echo $row['name']?>
                            </a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </li>
            <li role="presentation" class="theme nav_one">
                <a href="wechat_index.php?type=3">主题民宿</a>
            </li>
            <!-- add back after OSS is installed.
            <li role="presentation" class="nav_one">
                <a href="../">探庐驿站</a> 
            </li>
             -->
        </ul>
    </div>
</div>