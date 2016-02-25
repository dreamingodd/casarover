<?php header("Content-Type: text/html; charset=utf-8");?>
<?php
/**
 * Print object in original format.
 * @param Object $sth
 */
function print_w($sth) {
    echo '<pre>';
    var_dump($sth);
  echo '</pre>';
}
function remove_slash($str) {
    return str_replace("\\", "", $str);
}
function getUrl($uri='') {
    $baseUrl = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
    $baseUrl .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
    $baseUrl .= isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : dirname(getenv('SCRIPT_NAME'));
    return $baseUrl.'/'.$uri;
}
function getCurrentUrl() {
    return 'http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST']
            .(($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443)
            ? '' : ':'.$_SERVER['SERVER_PORT']).$_SERVER['REQUEST_URI'];
}
function getBaseUrl() {
    $current_url = getUrl();
    $base_url = "";
    if (strpos($current_url, 'casarover/')) {
        $strs = split('casarover/', $current_url);
        $base_url = $strs[0].'casarover/';
    } else {
        $base_url = $current_url;
    }
    return $base_url;
}
function encodeIdComma(Array $ids) {
    $ids_str = "";
    for ($i = 0; $i < count($ids); $i++) {
        if ($i == 0) {
            $ids_str = $ids[i];
        }
        $ids_str += "," + $ids[i];
    }
    return $ids_str;
}
function decodeIdComma($ids_str) {
    $idArray = array();
    if (!empty($ids_str)) {
        $idArray = split(",", $ids_str);
    }
    return $idArray;
}
/**
 * Remove elements whose attr==val from an array.
 * @arr array
 * @attr attribute name
 * @val attribute value
 */
function arrayRemoveElements($arr, $attr, $val) {
    $new_array = array();
    foreach ($arr as $e) {
        if ($e->$attr != $val) {
            array_push($new_array, $e);
        }
    }
    return $new_array;
}
/**
 * TODO
 * Sort object array by an attribute of object.
 * @param Array $arr original array
 * @param String $attr_name
 * @return sorted array 排序完成的数组:
 */
function arraySortByAttr(Array $arr, $attr_name) {
    $sorted_array = array();
    
    return $sorted_array;
}
function compareCasaByCode($casa1, $casa2) {
    return compareCasaCode($casa1->code, $casa2->code);
}
function compareCasaCode($c1, $c2) {
    if (!strstr($c1, "-")) {
        return -1;
    }
    if (!strstr($c2, "-")) {
        return 1;
    }
    $c1_nums = split("-", $c1);
    $c2_nums = split("-", $c2);
    $c1_city = $c1_nums[0];
    $c1_casa = $c1_nums[1];
    $c2_city = $c2_nums[0];
    $c2_casa = $c2_nums[1];
    if ($c1_city < $c2_city) {
        return -1;
    } else if ($c1_city > $c2_city) {
        return 1;
    } else {
        if ($c1_casa < $c2_casa) {
            return -1;
        } else if ($c1_casa > $c2_casa) {
            return 1;
        } else return 0;
    }
}
?>
