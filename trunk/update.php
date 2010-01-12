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

ini_set("display_errors","On");
require_once("config.php");
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ALL|E_NOTICE);

$newsRSS = "";
$CacheDir = "cache/";
$LineLength = 40;

$ReturnData = new stdClass();
$QuotesData = "";

// choose a RSS host
$Site = $RSS[rand(0,count($RSS)-1)];

// load news file if older than 15 minutes
$time = file_exists($CacheDir.$Site["cache"])?filemtime($CacheDir.$Site["cache"]):0;
if($time<time()-15*60 || true) {
  $fp = fopen($CacheDir.$Site["cache"], "w");
  try {
    $hrp = new HTTPRequest($Site["url"]);
    $hrp->send();
  }
  catch(HttpException $x) { 
    echo $x;
  }
  
  $newsRSS = $hrp->getResponseBody();
  fwrite($fp, $newsRSS);
  fclose($fp);
}
else {
  $newsRSS = file_get_contents($CacheDir.$Site["cache"]);
}

$news = simplexml_load_string(trim($newsRSS));

$QuotesData .= "<img src=\"".$Site["logo"]."\" id='content-logo'/>";
$QuotesData .= "<ul>";
$i = 1;

foreach($news->channel->item as $k=>$it) {
if($i>4) break;
  $desc = "";
  $it->description = preg_replace("/\<([^\<\>]+)\>/ui", "", $it->description);
  if(strlen($it->title)<$LineLength-6 && strlen($it->description)>2) {
    $desc = substr($it->description, 0, $LineLength-strlen($it->title)-6)."...";
  }
  
  $QuotesData .= "<li><div>";
  if($it->title["bold"]=="yes") {
    $QuotesData .= "<b>".htmlentities($it->title)."</b>";
  }
  else {
    $QuotesData .= "".htmlentities($it->title)."";
  }
  $QuotesData .= /* "<span>".htmlentities($desc)."</span> */  "</div></li>";
  if($i%2==0) {
    $QuotesData .= "</ul><ul>";
  }
  $i++;
}

$QuotesData .= "</ul>";
$ReturnData->quotes = str_replace("\n","",$QuotesData);

// Choose a random campaign to load
$Screens = array();
$dir = opendir($Base.$ScreensDirectory);
while (($file = readdir($dir)) !== false) {
        if($file{0}!=".") {
                $Screens[] = $file;
        }
}
closedir($dir);

if(!isset($Settings["content.ignore-campaigns"]) || $Settings["content.ignore-campaigns"]!="true") {
	$CurrentScreen = $Screens[rand(0,count($Screens)-1)];
	LoadScreenSettings($Base.$ScreensDirectory."/".$CurrentScreen);
}

// General settings
$ReturnData->hideBar = $Settings["display.hide-bar"];
$ReturnData->hideTicker = $Settings["display.hide-ticker"];
$ReturnData->hideBackground = $Settings["display.hide-background"];
$ReturnData->marqueeText = $Settings["marquee.text"];
$ReturnData->popupText = str_replace("\r\n","",$Settings["popup.text"]);
$ReturnData->runTime = $Settings["runtime"];
echo JSONSerialize($ReturnData);
?>
