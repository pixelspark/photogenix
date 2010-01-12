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
?>
<?php error_reporting(E_ALL); require("config.php"); ?>
<html>
	<head>
		<title><?php echo $DisplayName ?></title>
		<link rel="stylesheet" href="default.css" type="text/css" />   
		<link rel="stylesheet" href="content/default.css" type="text/css" />

		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="js/content.js"></script>

		<script type="text/javascript">
			$(document).ready(function(){
				PhotoFrame.SetDisplayInterval(<?php echo($Settings["display.interval"]); ?>);
				PhotoFrame.Start();
			});
		</script>    
	</head>
  	<body>
		<div id="container">
			<div id="popup"></div>
			<div id="ticker-overlay"></div>
			<marquee id="ticker" scrollamount="6" behaviour="alternate" scrolldelay="60" class="ticker"></marquee>
			<div id="background"></div>
			<div id="overlay">
				<div id="clock">
					<div class="holder" id="hours"></div>
					<div class="holder" id="minutes"></div>
				</div>      
			</div>		
			<div id="quotes"></div>
		</div>
	</body>
</html>
