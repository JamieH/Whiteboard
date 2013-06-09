<?php 

    // These variables define the connection information for your MySQL database 
    $username = "jamie"; 
    $password = "password"; 
    $host = "whiteboard.jamiehankins.co.uk"; 
    $dbname = "whiteboard"; 

    $GLOBALS['debug'] = true;

    //Use UTF8
    function dieError($exception)
    {
        if ($GLOBALS['debug'] == true)
        {
            die("Failed to run query: " . $exception->getMessage()); 
        }
        else
        {
            die("Database issues, Issue has been reported to the admins");
        }
    }

    function getID($db, $email)
    {
        $query = " 
            SELECT 
                id
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        // The parameter values 
        $query_params = array( 
            ':email' => $email
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
            return $row['id'];
        } 
    }

    function tryLogin($username, $password)
    {
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        // The parameter values 
        $query_params = array( 
            ':username' => $username
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
            if(genPassWithSalt($POST['password'], $row['salt']) === $row['password']) 
            { 
                return true;    
            } 
        } 
    }

    function genPassWithSalt($pass, $salt)
    {
        $check_password = hash('sha256', $pass . $salt); 
        for($round = 0; $round < 65536; $round++) 
        { 
            $check_password = hash('sha256', $check_password . $salt); 
        } 
        return $check_password;
    }

    function genPass($pass)
    {
        // A salt is randomly generated here to protect again brute force attacks 
        // and rainbow table attacks.
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        // This hashes the password with the salt so that it can be stored securely 
        // in your database.  The output of this next statement is a 64 byte hex 
        // string representing the 32 byte sha256 hash of the password.  The original 
        // password cannot be recovered from the hash.
        $password = hash('sha256', $pass . $salt); 

        // Next we hash the hash value 65536 more times.  The purpose of this is to 
        // protect against brute force attacks.  Now an attacker must compute the hash 65537 
        // times for each guess they make against a password, whereas if the password 
        // were hashed only once the attacker would have been able to make 65537 different  
        // guesses in the same amount of time instead of only one. 
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 

        $returnArray['salt'] = $salt;
        $returnArray['password'] = $password;
        return $returnArray;
    }

    function fileInfo ($filepath)
    {
        $filearray = pathinfo($filepath);
        return $filearray;
        
    }

    function editPassword($email, $password)
    {        
    $stmt = $db->prepare("UPDATE users SET password=:pass WHERE email = :email");

    $stmt->bindParam(':email', $email, PDO::PARAM_STR, 300);
    $stmt->bindParam(':pass', $password, PDO::PARAM_STR, 300);

    $stmt->execute();
    }

    function editEmail($email, $newemail, $userid)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 

        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        // Define our query parameter values 
        $query_params = array( 
            ':email' => $email
        ); 
         
        try 
        { 
            // Execute the query 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 

        catch(PDOException $ex) 
        { 
            dieError($ex);
        } 
         
        // Retrieve results (if any) 
        $row = $stmt->fetch(); 
        if($row) 
        { 
            die("This E-Mail address is already in use"); 
        }
        else
        {
            return $email;
        }
    }

    //End of Funcs

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
    
    try 
    {
        //Try open the connection
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
        $_GLOBAL['db'] = $db;
    } 
    catch(PDOException $ex) 
    { 
        dieError($ex);
    } 
     
    //Set Errormode
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     
    // This statement configures PDO to return database rows from your database using an associative 
    // array.  This means the array will have string indexes, where the string value 
    // represents the name of the column in your database. 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
     
    // This block of code is used to undo magic quotes.  Magic quotes are a terrible 
    // feature that was removed from PHP as of PHP 5.4.  However, older installations 
    // of PHP may still have magic quotes enabled and this code is necessary to 
    // prevent them from causing problems.  For more information on magic quotes: 
    // http://php.net/manual/en/security.magicquotes.php 
    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) 
    { 
        function undo_magic_quotes_gpc(&$array) 
        { 
            foreach($array as &$value) 
            { 
                if(is_array($value)) 
                { 
                    undo_magic_quotes_gpc($value); 
                } 
                else 
                { 
                    $value = stripslashes($value); 
                } 
            } 
        } 
     
        undo_magic_quotes_gpc($_POST); 
        undo_magic_quotes_gpc($_GET); 
        undo_magic_quotes_gpc($_COOKIE); 
    } 
     
    // This tells the web browser that your content is encoded using UTF-8 
    header('Content-Type: text/html; charset=utf-8'); 
     
    // This initializes a session.
    session_start(); 

    //Don't close this else there will be redirection issues