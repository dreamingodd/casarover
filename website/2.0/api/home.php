<?php

/***
 * 首页动态加载数据
 *
 ***/

$c = $_GET['c'];

$route = new Home();

$route->recom('1');

class Home{
    public function recom($city)
    {
        //通过$city 对城市是数据进行查询
        $title = '花千谷';
        $shortMess = '这个是对民宿的一句话介绍';
        $shortMess2 = '这个是第二种的';
        $pic = 'assets/images/fang.jpg';
        //数据格式
        $kuan = compact('title','shortMess2','pic');
        $room = compact('title','shortMess','pic');
        $data = array($kuan,$room,$room,$room,$room,$room);

        echo json_encode($data);
    }
}