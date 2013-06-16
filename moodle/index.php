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
?>

<html>
<head>
<title>IT Extended Diploma Level 3 - Whiteboard</title>
<link href="../CSS/course.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"> </script>
<script src="../JS/functions.js"></script>
</head>
<body onload="loadafterlogin()" onresize="IDPanelPlacement()">
<?php include'../header.php';?>
<div id="content">
<h1>Moodle API Test</h1>
<?php
include 'moodle.php';
$result = authWithMoodle($_SESSION['user']['moodleusername'], "http://elib.strode-college.ac.uk/moodle/login/index.php", $_GLOBAL['db']);
$cookie = $result['tempnam'];
print("<br />");
$output = getAllAssignmentLinks("http://elib.strode-college.ac.uk/moodle/course/view.php?id=889", $_SESSION['user']['username'], $cookie, $db);

    $doc = phpQuery::newDocumentHTML($output);
    phpQuery::selectDocument($doc);

    foreach(pq('tr') as $a)
    {
        if (strpos(pq($a)->attr('class'),'section main') !== false) {
            print "<br />";
            print "<b>";
            print pq($a)['a:first']->text();
            print "</b>";
            print "<br />";
            foreach(pq($a)['li'] as $li)
            {
                if (strpos(pq($li)->attr('class'),'activity resource') !== false and !is_null(pq($li)['a:first']->text())) {
                    print "<br />";
                    print pq($li)['a:first']->text();
                    print "<br />";
                    print pq($li)['a:first']->attr('href');
                    print "<br />";
                }
                else
                if (strpos(pq($li)->attr('class'),'activity assignment') !== false and !is_null(pq($li)['a:first']->text())) {
                    print "<br />";
                    print pq($li)['a:first']->text();
                    //$feedback = getFeedback(pq($li)['a:first']->attr('href'), $cookie);
                    //phpQuery::selectDocument($feedback);
                    //print pq($li)["a.comment:first"]->text();
                    //phpQuery::selectDocument($doc);
                    print "<br />";
                    print pq($li)['a:first']->attr('href');
                    print "<br />";
                }

            }
        }
    }

print getFeedback("http://elib.strode-college.ac.uk/moodle/mod/assignment/view.php?id=46003", $cookie);
?>
</div>
<br/>
<?php include'../footer.php';?>
</body>
</html>