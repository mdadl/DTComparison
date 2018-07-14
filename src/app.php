<?php
error_reporting(E_ERROR);
$default_timezone = date_default_timezone_get();

require("date_util.php");
require("util.php");

$date_util = new DateUtil();
$util = new Util();

$supported_functions = get_class_methods($date_util);
$supported_return_types = array("days"=>"days", "y"=>"years", "h"=>"hours", "i"=>"minutes", "s"=>"seconds");

if (sizeof($_SERVER['argv']) < 4 || sizeof($_SERVER['argv']) > 6) {
    echo "Argument mismatch\n";
    echo "Correct sytax: function_name datetime1 datetime2 [return_type [timezone]]\n";
    echo $util->supported_functions($supported_functions);
    echo $util->supported_return_type($supported_return_types);
    exit;
}

$function_name = $_SERVER['argv'][1];
if (!in_array($function_name, $supported_functions)) {
    echo "Unsupported function called.\n";
    echo $util->supported_functions($supported_functions);
    exit;
}

$return_type = '';
if (sizeof($_SERVER['argv']) >= 5) {
    $return_type = $_SERVER['argv'][4];
    if (!array_key_exists($return_type, $supported_return_types)) {
        echo $util->supported_return_type($supported_return_types);
        exit;
    }
}
else {
    $return_type = "days";
}
$timezone = $default_timezone;
if (sizeof($_SERVER['argv']) == 6) {
    $timezone = $_SERVER['argv'][5];
    $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
    if (!array_search($timezone, $tzlist)) {
        echo "Unsupported timezone entered.\n";
        exit;
    }
}
date_default_timezone_set($timezone);

$datetime1 = $_SERVER['argv'][2];
try {
    $datetime1 = new DateTime($datetime1);
} catch (Exception $e) {
    echo "Incorrect datetime1.\n";
    exit;
}

$datetime2 = $_SERVER['argv'][3];
try {
    $datetime2 = new DateTime($datetime2);
} catch (Exception $e) {
    echo "Incorrect datetime2.\n";
    exit;
}

echo $date_util->$function_name($datetime1, $datetime2, $return_type);
?>