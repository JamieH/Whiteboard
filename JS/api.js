function loginAuth(){
$.get('moodle/api.php',{action: "auth"},  function(data) {
	if (data.indexOf('true') != -1)
	{
		console.log('Load was performed.');
		loopUnits();
	}
	else
	{
        $(".container:eq(1)").append('<h1> There has been an error. Make sure your moodle information is correct!</h1>');
	}

});
}

function loopUnits(){
$.get('moodle/api.php',{action: "listunits"}).done(function(data) {
            data = JSON.parse(data);
            $.each(data, function (index, item) {
           	$(".container:eq(1)").append('<div class="btn-group btn-block"><a class="btn btn-info btn-large btn-block btn-primary dropdown-toggle" data-toggle="dropdown" href="#">' + item + '<span class="caret"></span></a><ul class="dropdown-menu"><li onclick="removeall()"><span>Get Assignments</li></span><li><a href="#">View Resources</a></li><li><a href="#">Get Feedback</a></li></ul></div>');
                //console.log(item);
            	addUnit(item);
            });
            $('#remove').remove();
});
}

function removeall(){
	console.log("removing stuff")
	for(var i = 0; i < $('.well').length; i++){
		$('.well:eq(' + i + ')').remove();
	}
	for(var i = 0; i < $('h4').length; i++){
		$('h4:contains("Feedback")').remove();
	}
	for(var i = 0; i < $('div').length; i++){
		if($('div:eq(' + i + ')').attr('id') == "unit"){
			$('div:eq(' + i + ')').remove();
		}
	}
}
function addUnit(){
}

