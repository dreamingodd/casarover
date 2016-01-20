<?php 
$casa_sqls = "abc".file_get_contents('casa_backup_20151230.txt');
$position = 1;
$id_pairs = array();
$position = strpos($casa_sqls, "(");
while (!empty($position)) {
    $str = substr($casa_sqls, $position + 1, 15);
    $vals = split(",", $str);
    array_push($id_pairs, $vals[0].'-'.$vals[2]);
    $casa_sqls = substr($casa_sqls, $position + 1);
    $position = strpos($casa_sqls, "(");
}
$file = fopen('casa_attachment_recovery.sql', 'w');
foreach ($id_pairs as $pair) {
    echo $pair.'<br/>';
    $two_ids = split("-", $pair);
    // casa id
    $c_id = $two_ids[0];
    // attachment id
    $a_id = $two_ids[1];
    fwrite($file, "update casa set attachment_id=".$a_id." where id=".$c_id.";\r\n");
}
fclose($file);
?>