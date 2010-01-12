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

/* This loads settings from settings.txt, which can be changed from the admin. */
function LoadScreenSettings($path) {
        global $Settings;
        $data = file($path);
        foreach($data as $v) {
                $ispos = strpos($v,"=");
                $Settings[trim(substr($v,0,$ispos))] = str_replace("<<\\r\\n>>","\r\n",trim(substr($v,$ispos+1)));
        }
} 
  
/* Function to write settings to settings.txt. Do not touch if you're just changing settings */
function WriteScreenSettings($path) {
  global $Settings;
  global $Base;
    
  $fp = fopen($path, "w");
  foreach($Settings as $k=>$v) {
    $v = str_replace("\r\n", "<<\\r\\n>>",$v);
    fwrite($fp, $k."=".$v."\r\n");
  }
  fclose($fp);
} 

function JSONSerialize($data) {
    $json = "";
    if(is_array($data)) {
        $json .= "";
        $elements = "[ ";
        foreach($data as $v) {
            $elements .= JSONSerialize($v);
            $elements .= " ,";
        }
        $json .= substr($elements, 0, strlen($elements)-1);
        $json .= " ]";
    }
    else if(is_object($data)) {
        $json .= "{";
         $elements = "";
        foreach($data as $k=>$v) {
            $elements .= $k . ": ". JSONSerialize($v);
            $elements .= " ,";
        }
        $json .= substr($elements, 0, strlen($elements)-1);
        $json .= "}";
    }
    else {
        $json .= "\"".addslashes($data)."\"";
    }
    return $json;
}

function GetPictureFilter() {
  global $Settings;
  return explode(",",$Settings["cp.filter"]);
}

?>
