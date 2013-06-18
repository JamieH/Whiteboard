<?php
include '../common.php';
include 'moodle.php';

print $_GET['action'];

if ($_GET['action'] === "auth") {
    if (is_null($_SESSION['user']['cookie'])) {
        $result = authWithMoodle($_SESSION['user']['moodleusername'], "http://elib.strode-college.ac.uk/moodle/login/index.php", $_GLOBAL['db']);
        $_SESSION['user']['cookie'] = $result['tempnam'];
        echo "true";
    } else {
        echo "true";
    }
} elseif (!is_null($_SESSION['user']['cookie'])) {
    if ($_GET['action'] === "listunits") {
        $output = getAllAssignmentLinks("http://elib.strode-college.ac.uk/moodle/course/view.php?id=889", $_SESSION['user']['cookie']);
        $doc = phpQuery::newDocumentHTML($output);
        phpQuery::selectDocument($doc);
        $array = array();
        foreach(pq('tr') as $a) {
            if (strpos(pq($a)->attr('class'), 'section main') !== false and pq($a) ['a:first']->text() != "") {;
                array_push($array, $data = preg_replace("/\r\n/", '', pq($a) ['a:first']->text()));
            }
        }
        print json_encode($array);
    }
    if ($_GET['action'] === "listassignments") {
    }
    if ($_GET['action'] === "getfeedback") {
    }
} else {
    echo "false";
}
?>