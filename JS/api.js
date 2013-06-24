function loginAuth(){
$.get('moodle/api.php',{action: "auth"},  function(data) {
	if (data.indexOf('true') != -1)
	{
		console.log('Load was performed.');
		loopResources();
	}
	else
	{
        $(".container:eq(1)").append('<h1> There has been an error. Make sure your moodle information is correct!</h1>');
	}

});
}

function loopResources(){
$.get('moodle/api.php',{action: "resources"}).done(function(data) {
			var ucount = 0;

            data = JSON.parse(data);
            
            $.each(data, function (index, item) {
            $("#stuffhere").append('<div id="unit' + ucount + '">');
			$('#unit' + ucount).append('<h2>' + item[0] + '</h2>');
			
			console.log(item[0]);
			var count = 0;

			try{
			$.each(item[1], function(index, info)	{
			var intRegex = /[0-9 -()+]+$/;
			var name = parseFloat(intRegex.exec(info[1]));
			var rcount = ucount
			$('#unit' + rcount).append('<div class="row" id=r' + name +'>')
			$('#r' + name).append('<div id="s' + name + '" class="btn-group"></div>')
			$('#s' + name).append('<button onclick="getResource(this)" class="btn" id="' + name + '" >' + info[0] + '</button>')



				console.log(info[0])
				console.log(name)
				count++;

			});

			}
			catch(e){
			 //catch and just suppress error
			}

            ucount++;

            });
            $('#remove').remove();
		loopUnits();
});
}

function loopUnits(){
$.get('moodle/api.php',{action: "uanda"}).done(function(data) {
			var ucount = 0;

            data = JSON.parse(data);
            
            $.each(data, function (index, item) {
			
			console.log(item[0]);
			var count = 0;

			try{
			$.each(item[1], function(index, info)	{
			var intRegex = /[0-9 -()+]+$/;
			var name = parseFloat(intRegex.exec(info[1]));
			var rcount = ucount
			$('#unit' + rcount).append('<div class="row" id=r' + name +'>')
			$('#r' + name).append('<button onclick="getFeedback(this)" class="btn" id="' + name + '" >' + info[0] + '</button>')
			$('#r' + name).append('<form class="fileupload" name="form" action="" method="POST" enctype="multipart/form-data"><input class="uneditable-input span3" id="assignment' + name + 'f" type="file" size="45" name="assignment' + name + 'f" class="input"><button class="btn" id="assignment' + name + '" onclick="return ajaxFileUpload(this);">Upload</button></form>')
			//bug is file upload box id


				console.log(info[0])
				console.log(name)
				count++;

			});

			}
			catch(e){
			 //catch and just suppress error
			}

            ucount++;

            });
            $('#remove').remove();

});
}

jQuery.download = function(url, data, method){
	//url and data options required
	if( url && data ){ 
		//data can be string of parameters or array/object
		data = typeof data == 'string' ? data : jQuery.param(data);
		//split params into form inputs
		var inputs = '';
		jQuery.each(data.split('&'), function(){ 
			var pair = this.split('=');
			inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />'; 
		});
		//send request
		jQuery('<form action="'+ url +'" method="'+ (method||'get') +'">'+inputs+'</form>')
		.appendTo('body').submit().remove();
	};
};

function getFeedback(obj) {
    console.log("This function's caller was " + obj.id);
    $.get('moodle/api.php', {
        action: "getfeedback",
        id: obj.id
    }, function (data) {
        // Get the parent div like
        var $div = $(obj).closest('div');
        $div.append('<div class="well"><a href="#" class="close" data-dismiss="alert">&times;</a><h3>' + obj.value + "</h3>" + data + '</div>');
    });
}

function getResource(obj) {
	$.download('moodle/api.php','action=getresource&id=' + obj.id, "GET");
    console.log("This function's caller was " + obj.id);
}

function doUpload(obj) {

    console.log("This function's caller was " + obj.id);
   
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

 function ajaxFileUpload()
    {
        //starting setting some animation when the ajax starts and completes
        $("#loading")
        .ajaxStart(function(){
            $(this).show();
        })
        .ajaxComplete(function(){
            $(this).hide();
        });
        
        /*
            prepareing ajax file upload
            url: the url of script file handling the uploaded files
                        fileElementId: the file type of input element id and it will be the index of  $_FILES Array()
            dataType: it support json, xml
            secureuri:use secure protocol
            success: call back function when the ajax complete
            error: callback function when the ajax failed
            
                */
        $.ajaxFileUpload
        (
            {
                url:'upload.php', 
                secureuri:false,
                fileElementId:'fileToUpload',
                dataType: 'json',
                success: function (data, status)
                {
                    if(typeof(data.error) != 'undefined')
                    {
                        if(data.error != '')
                        {
                            alert(data.error);
                        }else
                        {
                            console.log(data.msg);
                        }
                    }
                },
                error: function (data, status, e)
                {
                    alert(e);
                }
            }
        )
        
        return false;

    }