function loginAuth(){
$.get('moodle/api.php',{action: "auth"},  function(data) {
  console.log('Load was performed.');
});
}

function addUnit(){

	
}