<body onresize="resizeCanvas()">
	<canvas id="all" width="1000px" height="900px"></canvas>
</body>
<style type="text/css">
	body {
		background: #333;
	}

	#all {
		display: block;
		margin: 100px auto;
	}

	@font-face {
		font-family: "bebas";
		src: url("http://jasonmsu.com/uploads/fonts/BebasNeue.otf");
	}
</style>

<?php 
//header("content-type: application/x-javascript");
echo "<script>
	var svalue = 0;
	var mvalue = 0;
	var gvalue = 0;
	window.onload = function drawing(){
		var allthings = document.getElementById(\"all\");
		var stx = allthings.getContext(\"2d\");
		
		if(allthings.width != window.innerWidth)
		{
			if(window.innerWidth > 600)
				allthings.width = window.innerWidth - 200;
			else 
				allthings.width = 400;
		}
		
		if(allthings.height != window.innerHeight)
		{
			if(window.innerHeight > 560)
				allthings.height = window.innerHeight - 200;
			else
				allthings.width = 360
		}
		
		var sW = all.width;
		var sH = all.height;
		
		var sredraw_loop;
		
		var scolor = \"silver\";
		var sbgcolor = \"#222\";
		var stext = \" \";
		
		var mcolor = \"purple\";
		var mbgcolor = \"#222\";
		var mtext = \" \";
		
		var gcolor = \"gold\";
		var gbgcolor = \"#222\";
		var gtext = \" \";
		
		var allText = \" \";
		var data = new Array();
		var txtFile = new XMLHttpRequest();
		var stext_width;
		var mtext_width;
		var gtext_width;
		
		var currTime = new Date();
		var currHours = 0;
		var currMinutes = 0;
		var currSeconds = 0;
		var timeString = \"\";
		
		function init() {
			stx.clearRect(0, 0, all.width/2, all.height/2);
			stx.font = \"50px bebas\";
			
			if(window.svalue == 0)
				stext = \"DUE\";
			else if(window.svalue < 0)
				stext = \"NOT SCHEDULED\";
			else
				stext = window.svalue + \" minutes\";
				
			if(window.mvalue == 0)
				mtext = \"DUE\";
			else if(window.mvalue < 0)
				mtext = \"NOT SCHEDULED\";
			else
				mtext = window.mvalue + \" minutes\";
			
			if(window.gvalue == 0)
				gtext = \"DUE\";
			else if(window.gvalue < 0)
				gtext = \"NOT SCHEDULED\";
			else
				gtext = window.gvalue + \" minutes\";
			
			stext_width = stx.measureText(stext).width;
			mtext_width = stx.measureText(mtext).width;
			gtext_width = stx.measureText(gtext).width;
			
			stx.fillStyle = scolor;
			stx.fillText(\"Silver\", 0, 40);
			stx.fillText(stext, 40, 80);
			
			stx.fillStyle = mcolor;
			stx.fillText(\"Illini\", 0, 160);
			stx.fillText(mtext, 40, 200);
			
			stx.fillStyle = gcolor;
			stx.fillText(\"Gold\", 0, 280);
			stx.fillText(gtext, 40, 320);
			drawTime();
		}
		
		function drawTime() {
			stx.clearRect(all.width/2, 0, all.width, 70);
			stx.font = \"50px bebas\";
			
			timeString = getTime();
			
			stx.fillStyle = \"white\";
			stx.fillText(timeString, all.width - stx.measureText(timeString).width, 40);
		}
		
		function getTime() {
			currTime = new Date();
			currHours = currTime.getHours();
			currMinutes = currTime.getMinutes();
			currSeconds = currTime.getSeconds();
			
			currMinutes = (currMinutes < 10 ? \"0\" : \"\") + currMinutes;
			currSeconds = (currSeconds < 10 ? \"0\" : \"\") + currSeconds;
		
			return currHours + \":\" + currMinutes + \":\" + currSeconds;
		}
			
		function draw() {
			getData();
			init();
		}
		
		function getData() {
			txtFile.open(\"GET\", \"python/time.txt\", false)
			txtFile.send();
			if(txtFile.status == 200) {
				allText = txtFile.responseText;
				console.log(allText);
				data = allText.split(\" \");
				window.svalue = data[0];
				window.mvalue = data[2];
				window.gvalue = data[1];
			}
		}
			
		
		draw();
		setTimeout(draw, 250);
		
		sredraw_loop = setInterval(draw, 15000);
		timeredraw_loop = setInterval(drawTime, 1000);
	}
	
	function resizeCanvas() {
		allthings = document.getElementById(\"all\");
		stx = allthings.getContext(\"2d\");
		
		var scolor = \"silver\";
		var sbgcolor = \"#222\";
		var stext = \" \";
		
		var mcolor = \"purple\";
		var mbgcolor = \"#222\";
		var mtext = \" \";
		
		var gcolor = \"gold\";
		var gbgcolor = \"#222\";
		var gtext = \" \";
		
		var stext_width;
		var mtext_width;
		var gtext_width;
		
		var currTime = new Date();
		var currHours = 0;
		var currMinutes = 0;
		var currSeconds = 0;
		var timeString = \"\";
		
		function draw() {
			init();
		}
		
		/*function getData() {
			txtFile.open(\"GET\", \"/python/time.txt\", false)
			txtFile.send();
			if(txtFile.status == 200) {
				allText = txtFile.responseText;
				console.log(allText);
				data = allText.split(' ');
				svalue = data[0];
				mvalue = data[2];
				gvalue = data[1];
			}
		}*/
		
		function init() {
			stx.clearRect(0, 0, all.width/2, all.height/2);
			stx.font = \"50px bebas\";
			
			if(window.svalue == 0)
				stext = \"DUE\";
			else if(window.svalue < 0)
				stext = \"NOT SCHEDULED\";
			else
				stext = window.svalue + \" minutes\";
				
			if(window.mvalue == 0)
				mtext = \"DUE\";
			else if(window.mvalue < 0)
				mtext = \"NOT SCHEDULED\";
			else
				mtext = window.mvalue + \" minutes\";
			
			if(window.gvalue == 0)
				gtext = \"DUE\";
			else if(window.gvalue < 0)
				gtext = \"NOT SCHEDULED\";
			else
				gtext = window.gvalue + \" minutes\";
			
			stext_width = stx.measureText(stext).width;
			mtext_width = stx.measureText(mtext).width;
			gtext_width = stx.measureText(gtext).width;
			
			stx.fillStyle = scolor;
			stx.fillText(\"Silver\", 0, 40);
			stx.fillText(stext, 40, 80);
			
			stx.fillStyle = mcolor;
			stx.fillText(\"Illini\", 0, 160);
			stx.fillText(mtext, 40, 200);
			
			stx.fillStyle = gcolor;
			stx.fillText(\"Gold\", 0, 280);
			stx.fillText(gtext, 40, 320);
			
			drawTime();
		}
		
		function drawTime() {
			stx.clearRect(all.width/2, 0, all.width, 70);
			stx.font = \"50px bebas\";
			
			timeString = getTime();
			
			stx.fillStyle = \"white\";
			stx.fillText(timeString, all.width - stx.measureText(timeString).width, 40);
		}
		
		function getTime() {
			currTime = new Date();
			currHours = currTime.getHours();
			currMinutes = currTime.getMinutes();
			currSeconds = currTime.getSeconds();
			
			currMinutes = (currMinutes < 10 ? \"0\" : \"\") + currMinutes;
			currSeconds = (currSeconds < 10 ? \"0\" : \"\") + currSeconds;
		
			return currHours + \":\" + currMinutes + \":\" + currSeconds;
		}
		
		if(allthings.width != window.innerWidth)
		{
			if(window.innerWidth > 600)
				allthings.width = window.innerWidth - 200;
			else 
				allthings.width = 400;
		}
		
		if(allthings.height != window.innerHeight)
		{
			if(window.innerHeight > 560)
				allthings.height = window.innerHeight - 200;
			else
				allthings.height = 360
		}
		
		draw();
	}	
</script>";
?>