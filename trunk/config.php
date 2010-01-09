<?php
/* This file contains the installation settings for Photogenix. It defines the RSS feeds and loads the
default screen file.

Important: rename this file to config.php if you have changed the settings to match your environment */

/* This tells the software where it actually is on your server. If you have placed the php-files in /www/somedir,
set $Base to "/www/somedir/" (note the slash at the end). */
$Base = "/home/intermat/.html/intermate.nl/sites/wcwc/";
$DisplayName = "WCWC";
$ContentDirectory = "content";
$ScreensDirectory = $ContentDirectory."/screens";
$PhotosDirectory = $ContentDirectory."/photos";

/** RSS FEEDS **/
$RSS = array();
$RSS[] = array("url"=>"http://www.intermate.nl/rss.xml", "cache" => "intermate.nl.xml", "logo"=>"content/images/intermate.png");
/*$RSS[] = array("url"=>"http://w3.tue.nl/nl/rss.xml", "cache" => "tue.nl.xml", "logo"=>"content/images/intermate.png");*/

/** Screen content */
$Settings = array();
require_once("functions.inc.php");
LoadScreenSettings($Base.$ContentDirectory."/default.screen");
?>
