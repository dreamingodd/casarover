<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php 
/**Test *****************************************************************************************************/
$a = new stdClass();
$b = new stdClass();
$c = new stdClass();
$d = new stdClass();
$e = new stdClass();
$f = new stdClass();
$a->name = 'a';
$a->attr2 = 2;
$b->name = 'b';
$b->attr2 = 4;
$c->name = 'c';
$c->attr2 = 2;
$d->name = 'd';
$d->attr2 = 2;
$e->name = 'e';
$e->attr2 = 4;
$f->name = 'f';
$f->attr2 = 1;
$arr = array();
array_push($arr, $a);
array_push($arr, $b);
array_push($arr, $c);
array_push($arr, $d);
array_push($arr, $e);
array_push($arr, $f);
$arr = arrayRemoveElements($arr, 'attr2', 1);
foreach ($arr as $e) {
    var_dump($e);
    echo '<br/>';
}
/*******************************************************************************************************/
?>