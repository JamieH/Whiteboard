<?php
//Moodle functions
include 'phpQuery.php';

function addDetails($username, $password, $id, $db)
{
    $query = '';
    $query_params = '';

    if (!is_null($password))
    {
            print "hia password";
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
        print "no pass";
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

function getSalt($user, $db)
{
    $query = " 
        SELECT 
            salt
        FROM users 
        WHERE 
            username = :user 
    "; 
     
    // The parameter values 
    $query_params = array( 
        ':user' => $user
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
        return $row['salt'];
    } 
}

function encrypt($str, $key)
{
    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = $block - (strlen($str) % $block);
    $str .= str_repeat(chr($pad), $pad);

    return mcrypt_encrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
}

function decrypt($str, $key)
{   
    $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);

    $block = mcrypt_get_block_size('des', 'ecb');
    $pad = ord($str[($len = strlen($str)) - 1]);
    return substr($str, 0, strlen($str) - $pad);
}

function authwithMoodle($username, $authurl, $db)
{

$username = encrypt("jhankins", $getSalt($username, $db));
$data = array('username' => $username, 'password' => $password);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($authurl, false, $result);

$doc = phpQuery::newDocumentHTML($markup);
phpQuery::selectDocument($doc);

// all LIs from last selected DOM
foreach(pq('li') as $li) {
        // iteration returns PLAIN dom nodes, NOT phpQuery objects
        $tagName = $li->tagName;
        $childNodes = $li->childNodes;
        print_r ($li);
}

}



?>