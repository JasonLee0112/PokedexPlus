<?php
session_start();

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
        $checkQuery = 'SELECT * FROM Account WHERE (email=:email OR username=:username)';
        $statement = $db->prepare($checkQuery);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':username', $username);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

   
        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful
            $_SESSION['user_id'] = $user['userID']; // Assuming 'id' is the user's unique identifier in the database
            // echo $_SESSION['user_id'];
            if ($_SESSION['user_id']){
                echo 'Logged In';
                exit();
            } 
            
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