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
                console.log(item);
            });

});
}

function addUnit(){

	
}