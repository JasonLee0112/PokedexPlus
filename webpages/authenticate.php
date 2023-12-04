<?php
session_start();

$servername = 'mysql.cs.virginia.edu';
$username = 'rmk9ds';
$password = 'Fall2023';

$dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';
try {
    // Create a PDO instance
    $db = new PDO($dsn, $username, $password);
    $query = $db->prepare("SELECT * FROM Account WHERE (username = :username OR email = :email) AND password = :password");
    $email = $argv[1];
    $password = $argv[2];
    $username = $argv[3];

    // Bind parameters
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->bindValue(':username', $username);
    // Execute the query
    $statement->execute();

    // Check if a user with the provided credentials exists
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        // Authentication successful
        // $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the user's unique identifier in the database
        header('Location: landing_page.php'); // Redirect to the dashboard or another protected page
        // exit();
    } else {
        // Authentication failed
        echo 'Invalid username or password';
    }
}
 
catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>