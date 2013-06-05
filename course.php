<html>
<head>
<title><?php echo "IT Extended Diploma Level 3 - Whiteboard";?></title>
<link href="CSS/course.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
<script>
function load(){
	for(var i = 0; i < document.getElementsByClassName('expand').length; i++){
		temp = document.getElementsByClassName('expand').item(i);
		temp.innerHTML = "<h3 id='expandtitle' align='center'>" + temp.id + "</h3>" + temp.innerHTML;
		var s = temp.getAttribute('score');
		var scorefinal = "unitu";
		if(s != "U"){
			scorefinal = "unitp";
			if(s == null){
				s = "U";
				scorefinal = "unitu";
			}
		}
		temp.innerHTML = "<div class='unitgrade' id='" + scorefinal + "'>" + s + "</div>" + temp.innerHTML;
		temp.setAttribute('onclick', 'expand(' + i + ',true)');
	}
}
function expand(id, operation){
	if (operation == false){
		document.getElementsByClassName('expand').item(id).style.height = "40px";
		document.getElementsByClassName('expand').item(id).setAttribute('onclick', 'expand(' + id + ',true)');
	}
	else{
		document.getElementsByClassName('expand').item(id).style.height = "auto";
		document.getElementsByClassName('expand').item(id).setAttribute('onclick', 'expand(' + id + ',false)');
	}
}
</script>
</head>
<body onload="load()">
	<div id="IDPanel"> Matthew James 
		<li>Tracking Sheet</li>
		<li>Email</li>
		<li>Other Links</li>
		<li>Change Password</li>
		<li>Log-out</li>
	</div>
<div id="content">
	<h2 align="center"> IT Extended Diploma Level 3</h2>
	<div class="expand" id="Unit 2 - Computer Systems" score="U">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"  id="Unit 6 - Computer Systems" score="P">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"   id="Unit 14 - Computer Systems" score="M">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"   id="Unit 28 - Computer Systems" score="D">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
	<div class="expand"  id="Unit 21 - Computer Systems" score="U">
		<p> Assignments</p>
		<p> Upload Area</p>
		<p class="upload"> upload area 1</p>
		<p> <a href="">More information on this course.</a></p>
	</div>
</div>
</body>
</html>