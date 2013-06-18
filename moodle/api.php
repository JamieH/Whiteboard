<?php
include '../common.php';
include 'moodle.php';

if ($_GET['action'] === "auth") {
    if (!isset($_SESSION['user']['cookie'])) {
        $result = authWithMoodle($_SESSION['user']['moodleusername'], "http://elib.strode-college.ac.uk/moodle/login/index.php", $_GLOBAL['db']);
        $_SESSION['user']['cookie'] = $result['tempnam'];
        echo "true";
    } else {
        echo "true";
    }
} elseif (!is_null($_SESSION['user']['cookie'])) {
    if ($_GET['action'] === "listunits") {
        if (isset($_GET['force']) or !is_null(apc_fetch('moodleunits')))
        {
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
        apc_add('moodleunits', json_encode($array));
        }

        else
        {
            print apc_fetch('moodleunits');
        }

    }
    if ($_GET['action'] === "listassignments") {
    }
    if ($_GET['action'] === "getfeedback") {
        if (is_numeric($_GET['id'])) {
            $RID = $_GET['id'];
            print getFeedback("http://elib.strode-college.ac.uk/moodle/mod/assignment/view.php?id=". $RID, $_SESSION['user']['cookie']);
        }
        else
        {
            die("ID should be a number...");
        }
    }
    
} else {
    echo "false";
}
?>