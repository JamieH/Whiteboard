function loadafterlogin(){
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
	IDPanelPlacement();
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
function IDPanelPlacement(){
	var p = $('#content');
	var cloc = p.offset();
	$('#IDPanel').css({top: cloc.top});
}
function Login(){
			var valueUsername = $("#username").val()
			var valuePassword = $("#password").val()
			document.getElementById('footnote').innerHTML = "Logging In.";
			
			$.post('login.php', { username: valueUsername, password: valuePassword }).done(function(data)
			{
				console.log(data);

				if(data.indexOf("true") !== -1)
				{
					document.getElementById('footnote').innerHTML = "Logged In.";
					document.getElementById('login').style.opacity = 0;
					document.getElementsByTagName('h1').item(0).opacity = 0;
					setTimeout(function() 
					{
						window.location = "course.php";
					}, 1000);
				}


				setTimeout(function() {
					var o = document.getElementById('login');
					o.style.left = window.innerWidth / 2 - 125 + 10;
					setTimeout(function() {
						o.style.left = window.innerWidth / 2 - 125 - 10;
						setTimeout(function() {
							o.style.left = window.innerWidth / 2 - 125;
						}, 220);
					document.getElementById('footnote').innerHTML = "Login Failed.";
					document.getElementById('footnote').style.color = 'red';
					setTimeout(function() {
						document.getElementById('footnote').innerHTML = "Developed by Jamie Hankins & Matthew James";
						document.getElementById('footnote').style.color = 'rgba(90,90,90,0.5)';
						}, 1500);
					}, 220);
				}, 2000);
				
			});
			return false;
	}
	function loginload(){
		var o = document.getElementById('login');
		o.style.left = window.innerWidth / 2 - 125;
	}