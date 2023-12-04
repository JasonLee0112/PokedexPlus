<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        $query1 = "INSERT INTO `ForumPost` (Likes, Dislikes, Title, Body) VALUES (0, 0, :postTitle, :postBody)";
        $statement = $db->prepare($query1);
        $postTitle = $argv[1];
        $postBody = $argv[2];
        
        $statement->bindValue(':postTitle', $postTitle);
        $statement->bindValue(':postBody', $postBody);
        $statement->execute();
        echo "Successful insert";
    }
    catch (PDOException $e){
        $error_message = $e->getMessage();
        echo "PDO failed".$error_message;
    }
    catch (Exception $e){
        $error_message = $e ->getMessage();
        echo "Did not insert";
        echo "<p> Not connection error!: $error_message </p>";
    };

?>