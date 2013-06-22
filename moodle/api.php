<?php
include '../common.php';
include 'moodle.php';

if ( empty( $_SESSION['user'] ) ) {
    die( "Please auth" );
}

if ( $_GET['action'] === "auth" ) {
    if ( !isset( $_SESSION['user']['cookie'] ) ) {
        $result = authWithMoodle( $_SESSION['user']['moodleusername'], "http://elib.strode-college.ac.uk/moodle/login/index.php", $_GLOBAL['db'] );
        $_SESSION['user']['cookie'] = $result['tempnam'];
        echo "true";
    } else {
        echo "true";
    }
} elseif ( !is_null( $_SESSION['user']['cookie'] ) ) {
    if ( $_GET['action'] === "listunits" ) {
        if ( isset( $_GET['force'] ) or !is_null( apc_fetch( 'moodleunits' ) ) ) {
            $output = getAllAssignmentLinks( "http://elib.strode-college.ac.uk/moodle/course/view.php?id=889", $_SESSION['user']['cookie'] );
            $doc = phpQuery::newDocumentHTML( $output );
            phpQuery::selectDocument( $doc );
            $array = array();
            foreach ( pq( 'tr' ) as $a ) {
                if ( strpos( pq( $a )->attr( 'class' ), 'section main' ) !== false and pq( $a ) ['a:first']->text() != "" ) {;
                    array_push( $array, $data = preg_replace( "/\r\n/", '', pq( $a ) ['a:first']->text() ) );
                }

            }
            print json_encode( $array );
            apc_add( 'moodleunits', json_encode( $array ) );
        }

        else {
            print apc_fetch( 'moodleunits' );
        }

    }
    if ( $_GET['action'] === "listassignments" ) {
        if ( is_numeric( $_GET['id'] ) ) {
            $RID = $_GET['id'];

        }
        else {
            die( "ID should be a number..." );
        }
    }

    if ( $_GET['action'] === "uanda" ) {
        if ( isset( $_GET['force'] ) or !is_null( apc_fetch( 'moodleinfo' ) ) ) {
            $feedbackurls = array();
            $resourceurls = array();
            $uniturls = array();
            $moodleresources = array();
            $output = getAllAssignmentLinks( "http://elib.strode-college.ac.uk/moodle/course/view.php?id=889", $_SESSION['user']['cookie'] );
            $doc = phpQuery::newDocumentHTML( $output );
            phpQuery::selectDocument( $doc );

            foreach ( pq( 'tr' ) as $a ) {
                if ( strpos( pq( $a )->attr( 'class' ), 'section main' ) !== false ) {
                    $unitname = pq( $a )['a:first']->text();
                    foreach ( pq( $a )['li'] as $li ) {
                        if ( strpos( pq( $li )->attr( 'class' ), 'activity resource' ) !== false and !is_null( pq( $li )['a:first']->text() ) ) {
                            array_push( $resourceurls, array( pq( $li )['a:first']->text(), pq( $li )['a:first']->attr( 'href' ) ) );

                        }
                        else
                            if ( strpos( pq( $li )->attr( 'class' ), 'activity assignment' ) !== false and !is_null( pq( $li )['a:first']->text() ) ) {
                                array_push( $feedbackurls, array( pq( $li )['a:first']->text(), pq( $li )['a:first']->attr( 'href' ) ) );
                            }
                    }

                    unset( $temparrayfeed );
                    unset( $temparrayres );

                    $temparrayres = array();
                    $temparrayfeed = array();

                    foreach ( $feedbackurls as $value ) {
                        array_push( $temparrayfeed, $value );
                    }

                    foreach ( $resourceurls as $value ) {
                        array_push( $temparrayres, $value );
                    }

                    unset( $feedbackurls );
                    $feedbackurls = array();

                    unset( $resourceurls );
                    $resourceurls = array();
                    //$final = array(array("unit 1", array(array("assignment one", "url"), array("assignment two", "url"))))

                    if ( $unitname !== "" ) {
                        array_push( $uniturls, array( $unitname, $temparrayfeed ) );
                        array_push( $moodleresources, array( $unitname, $temparrayres ) );

                    }
                }
            }

            print( json_encode( $uniturls ) );
            apc_add( 'moodleinfo', json_encode( $uniturls ) );
            apc_add( 'moodleresources', json_encode( $moodleresources ) );

        }
        else {
            print json_encode( apc_fetch( 'moodleinfo' ) );
        }
    }

    if ( $_GET['action'] === "resources" ) {
        if ( isset( $_GET['force'] ) or !is_null( apc_fetch( 'moodleresources' ) ) ) {
            $feedbackurls = array();
            $resourceurls = array();
            $uniturls = array();
            $moodleresources = array();
            $output = getAllAssignmentLinks( "http://elib.strode-college.ac.uk/moodle/course/view.php?id=889", $_SESSION['user']['cookie'] );
            $doc = phpQuery::newDocumentHTML( $output );
            phpQuery::selectDocument( $doc );

            foreach ( pq( 'tr' ) as $a ) {
                if ( strpos( pq( $a )->attr( 'class' ), 'section main' ) !== false ) {
                    $unitname = pq( $a )['a:first']->text();
                    foreach ( pq( $a )['li'] as $li ) {
                        if ( strpos( pq( $li )->attr( 'class' ), 'activity resource' ) !== false and !is_null( pq( $li )['a:first']->text() ) ) {
                            array_push( $resourceurls, array( pq( $li )['a:first']->text(), pq( $li )['a:first']->attr( 'href' ) ) );

                        }
                    }

                    unset( $temparrayfeed );
                    unset( $temparrayres );

                    $temparrayres = array();
                    $temparrayfeed = array();

                    foreach ( $feedbackurls as $value ) {
                        array_push( $temparrayfeed, $value );
                    }

                    foreach ( $resourceurls as $value ) {
                        array_push( $temparrayres, $value );
                    }

                    unset( $feedbackurls );
                    $feedbackurls = array();

                    unset( $resourceurls );
                    $resourceurls = array();
                    //$final = array(array("unit 1", array(array("assignment one", "url"), array("assignment two", "url"))))

                    if ( $unitname !== "" ) {
                        array_push( $moodleresources, array( $unitname, $temparrayres ) );

                    }
                }
            }

            print( json_encode( $moodleresources ) );
            apc_add( 'moodleresources', json_encode( $moodleresources ) );
        }
        else
        {
            print json_encode( apc_fetch( 'moodleresources' ) );
        }




    }

    if ( $_GET['action'] === "getfeedback" ) {
        if ( is_numeric( $_GET['id'] ) ) {
            $RID = $_GET['id'];
            print getFeedback( "http://elib.strode-college.ac.uk/moodle/mod/assignment/view.php?id=" . $RID, $_SESSION['user']['cookie'] );
        }
    }

    if ( $_GET['action'] === "getresource" ) {
        if ( is_numeric( $_GET['id'] ) ) {
            $RID = $_GET['id'];
            print getResource( "http://elib.strode-college.ac.uk/moodle/mod/resource/view.php?id=" . $RID, $_SESSION['user']['cookie'] );
        }
    }

} else {
    echo "false";
}
?>
