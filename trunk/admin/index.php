<?php
require_once("../config.php");
?>

<html>
  <head>
    <title><?php echo $Settings["display.name"] ?></title>
    <link rel="stylesheet" href="../default.css" type="text/css" />
    <style type="text/css">
    
      DIV.block {
        float:left;
        width:200px;
        background-color:Black;
        border:solid 1px #A0A0A0;
        -moz-border-radius:10px;
        z-index:0;
        padding:2px;
        margin:5px;
        color:White;
        font-size:10px;
      }
      
      DIV#settings {
        position:absolute;
        top:200px;
        left:40px;
      }
      
      DIV.block H4 {
        margin:0px;
        padding:0px;
        background-color:#FFCC00;
        border:solid 1px #FFCC00;
        -moz-border-radius:10px 10px 0px 0px;
        font-size:12px;
        color:Black;
        
      }
      
      A {
        color:#FFCC00;
      }
    </style>
  </head>
  
  <body>
    <div id="container">
      <img id="background" src="images/back.jpg"/>
      <div id="overlay">
        <div id="quotes">
          <h3 style="color:White;margin:10px;"><a href="../">WCWC</a> Instellingen</h3>
        </div>
      </div>
      
      <div id="settings">
        <div class="block">
          <h4>Balk</h4>
          
            <form action="set_setting.php" method="post">
              <input type="hidden" name="key" value="display.hide-bar"/>
              <input type="checkbox" name="value" value="true" <?php if($Settings["display.hide-bar"]=="true") {?> checked="checked" <?php } ?> /> Balk verbergen
              
              <input type="submit" value="Instellen" />
            </form>

            <form action="set_setting.php" method="post">
              <input type="hidden" name="key" value="display.hide-ticker"/>
              <input type="checkbox" name="value" value="true" <?php if($Settings["display.hide-ticker"]=="true") {?> checked="checked" <?php } ?> /> Ticker verbergen
              <input type="submit" value="Instellen" />
            </form>

            <form action="set_setting.php" method="post">
              <input type="hidden" name="key" value="content.ignore-campaigns"/>
              <input type="checkbox" name="value" value="true" <?php if($Settings["content.ignore-campaigns"]=="true") {?> checked="checked" <?php } ?> /> Promotiecampagnes negeren en deze instellingen forceren
              
              <input type="submit" value="Instellen" />
            </form>

        </div>

        <div class="block">
          <h4>Ticker</h4>
          
            <form action="set_setting.php" method="post">
              <input type="hidden" name="key" value="marquee.text"/>
              <textarea name="value" style="width:200px;height:400px;"><?php echo htmlentities($Settings["marquee.text"])?></textarea>              
              <input type="submit" value="Instellen" />
            </form>
        </div>

        <div class="block">
          <h4>Overlay HTML</h4>
          
            <form action="set_setting.php" method="post">
              <input type="hidden" name="key" value="popup.text"/>
              <textarea name="value" style="width:200px;height:400px;"><?php echo htmlentities($Settings["popup.text"])?></textarea>              
              <input type="submit" value="Instellen" />
            </form>
        </div>


      </div>
    </div>
  </body>
</html>
