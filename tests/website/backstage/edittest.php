<?php
echo $_POST['title'];
echo "<hr>";
echo $_POST['titlepic'];
echo "<hr>";
echo $_POST['coordinate'];
echo "<hr>";
echo $_POST['tier'];
echo "<hr>";
var_dump($_POST['raiders_content']);
var_dump($_POST['content_message']);

$k = $_POST['content_message'];
preg_match_all('/<img.*\/>/iUs', $k, $out);
// var_dump($out);
// echo count($out);
echo count($out[0]);
if (count($out[0])<4 ) {
	echo "数量不足";
	exit();
}
for ($i=0; $i < count($out[0]); $i++) { 
	// echo "<hr>";
	// echo $out[0][$i];
}

// $str='“欢迎查看美女图片<img src="images/new/h1.jpg" width="450" height="210" />哈哈！<img src="images/new/h1.jpg" width="450" height="210" />”';
// // echo $str;
// preg_match_all('/<img.*\/>/iUs', $str, $out);
// print_r($out);

// $img=$out[0][0];
// echo $img;
?>