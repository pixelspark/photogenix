<?php
/*
* Photogenix, custom photoframe software
* Copyright (C) 2009-2010
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

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
