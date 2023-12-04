<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        if($argv[2] === "like"){
            $query1 = "UPDATE `comment` SET Likes=:newLikes WHERE commentID = :comment_id";
        }
        else if($argv[2] === "dislike"){
            $query1 = "UPDATE `comment` SET Dislikes=:newLikes WHERE commentID = :comment_id";
        }
        else{
            throw new Exception();
        }
        $statement = $db->prepare($query1);
        $newLikes = $argv[1];
        $comment_id = $argv[3];

        $statement->bindValue(":newLikes", $newLikes);
        $statement->bindValue(":comment_id", $comment_id);

        $statement->execute();
        echo "Successful";
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