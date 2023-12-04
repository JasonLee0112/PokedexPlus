<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        if($argv[2] === "like"){
            $query1 = "UPDATE `ForumPost` SET Likes=:newLikes WHERE forumPostID = :forum_id";
        }
        else if($argv[2] == "dislike"){
            $query1 = "UPDATE `ForumPost` SET Dislikes=:newLikes WHERE forumPostID = :forum_id";
        }
        else{
            throw new Exception();
        }
        $statement = $db->prepare($query1);
        $newLikes = $argv[1];
        $forumPostID = $argv[3];

        $statement->bindValue(":newLikes", $newLikes);
        $statement->bindValue(":forum_id", $forumPostID);

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