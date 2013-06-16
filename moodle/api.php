<?php
include '../common.php';
if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: ../index.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to ../login.html"); 
    } 

include 'moodle.php';

if ($_POST['action'] = "auth" and is_null($_SESSION['user']['cookie']))
{
$result = authWithMoodle($_SESSION['user']['moodleusername'], "http://elib.strode-college.ac.uk/moodle/login/index.php", $_GLOBAL['db']);
$_SESSION['user']['cookie'] = $result['tempnam'];
}
else
{
}

if (!is_null($_SESSION['user']['cookie']))
{

	if ($_POST['action'] = "listunits")
	{
		$output = getAllAssignmentLinks("http://elib.strode-college.ac.uk/moodle/course/view.php?id=889", $_SESSION['user']['cookie']);
		$doc = phpQuery::newDocumentHTML($output);
    	phpQuery::selectDocument($doc);
    	$array = array();
		foreach(pq('tr') as $a)
    	{
        	if (strpos(pq($a)->attr('class'),'section main') !== false and pq($a)['a:first']->text() != "") {	
        		; 

        	array_push($array, $data = preg_replace("/\r\n/", '', pq($a)['a:first']->text()));            
        	}
    	}
    	print json_encode($array);
	}
	if ($_POST['action'] = "listassignments")
	{

	}
	if ($_POST['action'] = "getfeedback")
	{

	}
}

?>