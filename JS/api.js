function loginAuth(){
$.get('moodle/api.php',{action: "auth"},  function(data) {
  console.log('Load was performed.');
  loopUnits();
});
}

function loopUnits(){
$.get('moodle/api.php',{action: "listunits"}).done(function(data) {
            data = JSON.parse(data);
            $.each(data, function (index, item) {
            	$(".container:eq(1)").append('<div class="btn-group btn-block"><a class="btn btn-info btn-large btn-block btn-primary dropdown-toggle" data-toggle="dropdown" href="#">' + item + '<span class="caret"></span></a><ul class="dropdown-menu"><li onclick="removeall()">Get Assignments</li><li><a href="#">View Resources</a></li><li><a href="#">Get Feedback</a></li></ul></div>');
                //console.log(item);
            	addUnit(item);
            });

});
}
function removeall(){
	for(var i = 0; i < $('.well').length; i++){
		$('.well:eq(' + i + ')').remove();
	}
	for(var i = 0; i < $('h4').length; i++){
		if($('h4:eq(' + i + ')').contains("Feedback")){
			$('h4:eq(' + i + ')').remove();
		}
	}
	for(var i = 0; i < $('div').length; i++){
		if($('div').attr('id') == "units"){
			$('div').remove();
		}
	}
}
function addUnit(){
}