<?php
require_once("config.php");
header("Content-type: image/png");

$Photos = array();
$dir = opendir($Base.$PhotosDirectory);
while (($file = readdir($dir)) !== false) {
	if($file{0}!=".") {
		$Photos[] = $file;
	}
}
closedir($dir);

ini_set("display_errors","1");
$CurrentPhoto = $Photos[rand(0,count($Photos)-1)];
$fp = fopen($Base.$PhotosDirectory."/".$CurrentPhoto, "r");
fpassthru($fp);
fclose($fp);
?>
