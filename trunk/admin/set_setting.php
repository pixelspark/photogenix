<?php
require_once("../config.php");

$key = isset($_REQUEST['key'])?$_REQUEST['key']:"";
$value = isset($_REQUEST['value'])?$_REQUEST['value']:"";

if(strlen(trim($key))<1) {
	header("Location: index.php");   
}

$Settings[trim($key)] = trim($value);
WriteScreenSettings($Base.$ContentDirectory."/default.screen");
header("Location: index.php");   
?>
