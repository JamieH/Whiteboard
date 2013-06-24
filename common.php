<?php
// These variables define the connection information for your MySQL database
$username = "jamie";
$password = "password";
$host = "whiteboard.jamiehankins.co.uk";
$dbname = "whiteboard";

$GLOBALS['debug'] = true;

function dieError( $exception ) {
    if ( $GLOBALS['debug'] == true ) {
        die( "Failed to run query: " . $exception->getMessage() );
    } else {
        die( "Database issues, Issue has been reported to the admins" );
    }
}

function getID( $db, $email ) {
    $query = "
            SELECT
                id
            FROM users
            WHERE
                email = :email
        ";
    $query_params = array( ':email' => $email );
    try {
        $stmt = $db->prepare( $query );
        $result = $stmt->execute( $query_params );
    }
    catch( PDOException $ex ) {
        dieError( $ex );
    }
    $row = $stmt->fetch();
    if ( $row ) {
        return $row['id'];
    }
}

function tryLogin( $username, $password ) {
    $query = "
            SELECT
                id,
                username,
                password,
                salt,
                email,
                skin
            FROM users
            WHERE
                username = :username
        ";

    $query_params = array( ':username' => $username );
    try {
        $stmt = $db->prepare( $query );
        $result = $stmt->execute( $query_params );
    }

    catch( PDOException $ex ) {
        dieError( $ex );
    }

    $row = $stmt->fetch();
    if ( $row ) {
        if ( genPassWithSalt( $POST['password'], $row['salt'] ) === $row['password'] ) {
            return true;
        }
    }
}

function genPassWithSalt( $pass, $salt ) {
    $check_password = hash( 'sha256', $pass . $salt );
    for ( $round = 0;$round < 65536;$round++ ) {
        $check_password = hash( 'sha256', $check_password . $salt );
    }
    return $check_password;
}

function genPass( $pass ) {
    $salt = dechex( mt_rand( 0, 2147483647 ) ) . dechex( mt_rand( 0, 2147483647 ) );

    $password = hash( 'sha256', $pass . $salt );

    for ( $round = 0;$round < 65536;$round++ ) {
        $password = hash( 'sha256', $password . $salt );
    }
    $returnArray['salt'] = $salt;
    $returnArray['password'] = $password;
    return $returnArray;
}

function fileInfo( $filepath ) {
    $filearray = pathinfo( $filepath );
    return $filearray;
}

function editPassword( $email, $password ) {
    $stmt = $db->prepare( "UPDATE users SET password=:pass WHERE email = :email" );
    $stmt->bindParam( ':email', $email, PDO::PARAM_STR, 300 );
    $stmt->bindParam( ':pass', $password, PDO::PARAM_STR, 300 );
    $stmt->execute();
}

function editEmail( $email, $newemail, $db ) {
    if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
        die( "Invalid E-Mail Address" );
    }
    $query = "
            SELECT
                1
            FROM users
            WHERE
                email = :email
        ";
    // Define our query parameter values
    $query_params = array( ':email' => $email );
    try {
        // Execute the query
        $stmt = $db->prepare( $query );
        $result = $stmt->execute( $query_params );
    }
    catch( PDOException $ex ) {
        dieError( $ex );
    }
    // Retrieve results (if any)
    $row = $stmt->fetch();
    if ( $row ) {
        die( "This E-Mail address is already in use" );
    } else {
        return $email;
    }
}

function editSkin($username, $skin, $db) {
    $stmt = $db->prepare( "UPDATE users SET theme=:theme WHERE username = :user" );
    $stmt->bindParam( ':user', $username, PDO::PARAM_STR, 300 );
    $stmt->bindParam( ':theme', $skin, PDO::PARAM_STR, 300 );
    $stmt->execute();
}


//End of Funcs

$options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );
try {
    //Try open the connection
    $db = new PDO( "mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options );
    $_GLOBAL['db'] = $db;
}
catch( PDOException $ex ) {
    dieError( $ex );
}

$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$db->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
if ( function_exists( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc() ) {
    function undo_magic_quotes_gpc( &$array ) {
        foreach ( $array as & $value ) {
            if ( is_array( $value ) ) {
                undo_magic_quotes_gpc( $value );
            } else {
                $value = stripslashes( $value );
            }
        }
    }
    undo_magic_quotes_gpc( $_POST );
    undo_magic_quotes_gpc( $_GET );
    undo_magic_quotes_gpc( $_COOKIE );
}

header( 'Content-Type: text/html; charset=utf-8' );
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}