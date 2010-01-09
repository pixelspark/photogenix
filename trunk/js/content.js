var  PhotoFrame = new function() {
	var hours = 0;
	var minutes = 0;
	var displayTimer = null;
	var clockTimer = null;
	var displayInterval = 5000;
	
	this.CreateRequest = function() {
		if(window.XMLHttpRequest) { 
			return new XMLHttpRequest();
		}
		else if(window.ActiveXObject) {
			return new ActiveXObject("Microsoft.XMLHTTP");
  		}
	}
	
	this.UpdatePicture = function() {
		var $oldBackground = $('#background img');
		var $newBackground = $(new Image());
		
		$newBackground.load(function () {
			$(this).hide();
			$('#background').append($newBackground);
			$(this).fadeIn('medium', function() { 
				$oldBackground.remove();
			});
		});
		
		var path = 'random_picture.php?rand=' + Math.random();
		$newBackground.attr('src', path);
	}
	
	this.UpdateContent = function() {
		if(PhotoFrame.displayTimer!=null) {
			window.clearTimeout(PhotoFrame.displayTimer);
			PhotoFrame.displayTimer = null;
		}
		var http = PhotoFrame.CreateRequest();
		
		http.open("GET", "update.php", true);
		
		http.onreadystatechange = function() {
			if(http.readyState==4) {
				if(http.status==200) {
					var data = new Function("return "+http.responseText)();
					PhotoFrame.LoadScreen(data);
					PhotoFrame.UpdatePicture();
				}
				PhotoFrame.displayTimer = window.setTimeout(function() { PhotoFrame.UpdateContent(); }, PhotoFrame.displayInterval);
			}
		}

		try {
			http.send(null);
		}
	    	catch(e) {
	        	alert(e);
		}
	}
	
	this.UpdateTime = function() {
		var date = new Date();
		
		if (PhotoFrame.clockTimer!=null) {
			clearTimeout(PhotoFrame.clockTimer);
			PhotoFrame.clockTimer = null;
		}
		PhotoFrame.clockTimer = setTimeout(function() { PhotoFrame.UpdateTime() }, 5000);
		if (date.getMinutes() != PhotoFrame.minutes) {
			PhotoFrame.UpdateMinutes();
		}
	}
	
	this.UpdateMinutes = function () {
		var date = new Date();
		PhotoFrame.minutes = date.getMinutes();
		
		var $oldMinutes = $('#minutes > .number');
		var $newMintues = $('<div></div>');
		var strMinutes = '' + PhotoFrame.minutes;
		if(strMinutes.length < 2) strMinutes = '0' + strMinutes;
		
		$newMintues.addClass('number');
		$newMintues.text(strMinutes);
		$newMintues.css('top', '120px');
		$('#minutes').append($newMintues);
		$newMintues.animate({
			top: "0px"
		}, "medium", null, function() {
			if (date.getHours() != PhotoFrame.hours) {
				PhotoFrame.UpdateHours();
			}
		});
		$oldMinutes.fadeOut("medium", function() {
			$(this).remove();
		});
	}
	
	this.UpdateHours = function () {
		var date = new Date();
		PhotoFrame.hours = date.getHours();
		
		var $oldHours = $('#hours > .number');
		var $newHours = $('<div></div>');
		
		$newHours.addClass('number');
		$newHours.text(''+PhotoFrame.hours);
		$newHours.css('top', '120px');
		$('#hours').append($newHours);
		$newHours.animate({
			top: "0px"
		}, "medium");
		$oldHours.fadeOut("medium", function() {
			$(this).remove();
		});
	}
	
	this.LoadScreen = function(data) {
		data.hideBar = data.hideBar=="true";
		data.hideTicker = data.hideTicker=="true";
		data.hideBackground = data.hideBackground=="true";		
		
		document.getElementById('overlay').style.display = data.hideBar?"none":"block";
		document.getElementById('quotes').style.display = data.hideBar?"none":"block";
		document.getElementById('ticker').style.display = data.hideTicker?"none":"block";
		document.getElementById('quotes').innerHTML = data.quotes;
		document.getElementById('ticker').innerHTML = data.marqueeText;
		document.getElementById('ticker-overlay').style.display = data.hideTicker?"none":"block";
		document.getElementById('popup').innerHTML = data.popupText;
		document.getElementById('background').style.display = data.hideBackground?"none":"block";
		PhotoFrame.displayInterval = data.runTime;	
	}
	
	this.Start = function() {
		PhotoFrame.UpdateContent();
		PhotoFrame.UpdateTime();
	}

	this.SetDisplayInterval = function(x) {
		this.displayInterval = x;
	}
}
