<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/constant.php';?>
<?php 
//Create a database connect		创建一个数据库连接
$connect = @mysql_connect(DB_HOST, DB_USER, DB_PWD) or die("Could not connected MySQL.".mysql_error());

//Select a database to use		选择一个数据库使用
$db = @mysql_select_db(DB_NAME,$connect) or die("Could not select the database.".mysql_error());

mysql_query("set names 'utf8'");
?>