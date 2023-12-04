<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        $query1 = "INSERT INTO `comment`(Likes, Dislikes, Title, Body) VALUES (0, 0, :commentTitle, :commentBody)";
        $statement = $db->prepare($query1);
        $comment_title = $argv[1];
        $comment_body = $argv[2];
        $forumPostID = $argv[3];

        $query2 = "INSERT INTO `comment-belongs-to-forum`(comment_ID, forum_post_ID) VALUES (:commentID, :forumPost)";
        
        $statement->bindValue(':commentTitle', $comment_title);
        $statement->bindValue(':commentBody', $comment_body);
        $statement->execute();
        $last_id = $db->lastInsertId();

        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':forumPost', $forumPostID);
        $statement2->bindValue(':commentID', $last_id);
    
        $statement2->execute();
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