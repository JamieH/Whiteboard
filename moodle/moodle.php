<?php
//Moodle functions
include 'phpQuery.php';

function addDetails($username, $password, $id, $db)
{
    $query = '';
    $query_params = '';

    if (!is_null($password))
    {
            $query = "
            INSERT INTO moodleauth ( 
                id,
                username, 
                password
            ) VALUES ( 
                :id, 
                :username, 
                :password
            )
            ON DUPLICATE KEY UPDATE username= :username, password= :password
        ";
            $query_params = array( 
            ':id'   => $id,
            ':username' => $username,
            ':password' => $password
        ); 
    }

    else
    {
        $query = "
            INSERT INTO moodleauth ( 
                id,
                username
            ) VALUES ( 
                :id, 
                :username
            )
            ON DUPLICATE KEY UPDATE username= :username
        "; 

            $query_params = array( 
            ':id'   => $id,
            ':username' => $username,
            ':password' => $password
        ); 
    }

         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            dieError($ex);
        }

        return $username;
}

function getPassword($username, $db)
{
    $query = " 
        SELECT 
            password
        FROM moodleauth 
        WHERE 
            username = :user 
    "; 
     
    // The parameter values 
    $query_params = array( 
        ':user' => $username
    ); 
     
    try 
    { 
        // Execute the query against the database 
        $stmt = $db->prepare($query); 
        $result = $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    { 
        dieError($ex);
    } 
     
    // Retrieve the user data from the database.  If $row is false, then the username 
    // they entered is not registered. 
    $row = $stmt->fetch(); 
    if($row) 
    {              
        return rot13decrypt($row['password']);
    } 
}

    function rot13encrypt ($str) {
    return str_rot13(base64_encode($str));
    }

    function rot13decrypt ($str) {
        return base64_decode(str_rot13($str));
    }

    function authwithMoodle($username, $authurl, $db)
    {

    $data = array('username' => $username, 'password' => getPassword($username, $db));

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($authurl, false, $context);

    $doc = phpQuery::newDocumentHTML($result);
    phpQuery::selectDocument($doc);

    // all LIs from last selected DOM
    foreach(pq('a') as $a) {
            // iteration returns PLAIN dom nodes, NOT phpQuery objects
            //$tagName = $a->tagName;
            //$childNodes = $a->childNodes;
            print pq($a)->attr('href');
            print "<br/>";
    }

    }
?>