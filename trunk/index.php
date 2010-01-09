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
