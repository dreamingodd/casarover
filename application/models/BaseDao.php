<?php
class BaseDao {
    /**
     * Check if the value has slash(\) or single quote(').
     * Strip slashes and escape quotes.
     * Add single quotes for string value ('value');
     * @param $input value
     * @return decorated value, 处理后的value值
     */
    function check_input($value) {
        // remove slashes
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // add single quote if it's not numeric
        if (!is_numeric($value)) {
            $value = "'" . mysql_real_escape_string($value) . "'";
        }
        return $value;
    }
}
?>