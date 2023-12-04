<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';

    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';
    try {
        // Create a PDO instance
        $db = new PDO($dsn, $username, $password);
        $email = $argv[1];
        $password = $argv[2];
        $username = $argv[3];
        $checkQuery = 'SELECT * FROM Account WHERE (email=:email OR username=:username) AND password=:password';        
        $statement = $db->prepare($checkQuery);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

   
        if ($user) {
            // Authentication successful
            echo 'Logged In: userID: ' . $user['userID'];
            
        }
        else {
            // Authentication failed
            echo 'Invalid username, email, or password';
            // exit();

        }
    }
    
    catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>