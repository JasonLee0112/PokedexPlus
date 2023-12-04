<!DOCTYPE html>
<html>
    <?php
        // echo "Php is processed correctly";

        $servername = 'mysql.cs.virginia.edu';
        $username = 'rmk9ds';
        $password = 'Fall2023';

        $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';
        
        if (isset($argv[1])) {
            $forum_id = $argv[1];
            // echo "forum_id Sent!";
        }else{
            echo "forum_id Not Sent!";
        }

        try {
            $db = new PDO($dsn, $username, $password);
            $forum_query = "SELECT forumPostID, Title, Body, Likes, Dislikes FROM ForumPost WHERE forumPostID = $forum_id";
            $statement = $db->prepare($forum_query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            // echo "<p> connected! <p>";

        }
        catch (PDOException $e){
            $error_message = $e->getMessage();
            echo "<p> Error: $error_message </p>";
        }
        catch (Exception $e){
            $error_message = $e ->getMessage();
            echo "<p> Not connection error!: $error_message </p>";
        };
    ?>

    <head>    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../styles.css">
    </head>
    <body>
        <!-- Header -->
        <div class="navbar navbar-expand-lg bg-body-secondary sticky-top">
                <div class="container-fluid">
                <a class="navbar-brand" href="/"><img class="brand-image" src="/uvaball.png"> Pokedex+ </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"> Hi </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="/pokedex">Pokedex</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="/create.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Create
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/team">Team</a></li>
                                <li><a class="dropdown-item" href="/pokemon">Pokemon</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/forum">Forum</a>
                            </li>
                        </ul>
                    </div>
                    <div class="justify-content-end nav-item">
                        <a class="nav-link button" href="login">Login</a>
                    </div>
                </div>
            </div>
        <!-- End Header -->
        <!-- Content -->
        <div class="container-fluid" id="full_forum_post">
            <div class="row">
                <div class="col-11">
                <?php 
                    $post_id = NAN;
                    foreach ($result as $forum_post){
                        // echo "<h1>".$forum_post["forumPostID"];
                        $post_id = $forum_post["forumPostID"];
                        echo "<h1 class=\"m-3\">".$forum_post["Title"];
                    ?>
                    </h1>
                    </div>
                </div>
                <!-- Display post content here -->
                <div class="row">
                    <div class="col-11">
                    <?php 
                        echo "<p class=\"m-3 text-break\">".$forum_post["Body"]."</p>";
                    ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11">
                        <p class="m-3">
                        <form id="likeDislikeForm<?php echo $forum_post["forumPostID"]?>" method="post" action="/forum_like">
                        <?php
                            echo "<div class=\"d-flex align-items-center\">
                            <button type=\"submit\" class=\"btn btn-primary btn-sm me-2\" 
                            name=\"{$forum_post["forumPostID"]}_like\" onclick=\"forumLike({$forum_post["forumPostID"]})\"> Like </button> 

                            <p id=\"like_count{$forum_post["forumPostID"]}\" class=\"mb-0 pe-2\"> Likes: ".$forum_post["Likes"]."</p>

                            <button type=\"submit\" class=\"btn btn-warning btn-sm me-2\" 
                            name=\"{$forum_post["forumPostID"]}_dislike\" onclick=\"forumDislike({$forum_post["forumPostID"]})\"> Dislike </button>
                            <p id=\"dislike_count{$forum_post["forumPostID"]}\" class=\"mb-0\"> Dislikes: ".$forum_post["Dislikes"]."</p></div>";
                            ?>
                            <input type="hidden" id="updatePostId<?php echo $forum_post["forumPostID"]?>" name="updatePostId" value="">
                            <input type="hidden" id="updateAction<?php echo $forum_post["forumPostID"]?>" name="updateAction" value="">
                            <input type="hidden" id="updateAmount<?php echo $forum_post["forumPostID"]?>" name="updateAmount" value="">            
                            </form>
                        </p>
                    </div>
                </div>
                <?php

                }
            ?>

        </div>

        <!-- Comments section -->
        <div class="container-fluid" id="comment-section">
            <div class="row m-3">
                <div class="col-11">
                <?php
                    try{
                    $comment_query = "SELECT DISTINCT commentID, Title, Body, Likes, Dislikes 
                    FROM ( SELECT comment_ID FROM `comment-belongs-to-forum` WHERE forum_Post_ID = $forum_id) AS subquery 
                    JOIN `comment` ON subquery.comment_ID = `comment`.commentID;";
                    $statement = $db->prepare($comment_query);
                    $statement->execute();
                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                    // var_dump($result);
                    }
                    catch (PDOException $e){
                        $error_message = $e->getMessage();
                        echo "<p> Error: $error_message </p>";
                    }
                    catch (Exception $e){
                        $error_message = $e ->getMessage();
                        echo "<p> Not connection error!: $error_message </p>";
                    };
                ?>
                <h2>Comments</h2>
                    <?php foreach ($result as $comment_body){
                        ?>
                        <ul class="list-group" id="commentsList">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><?php echo $comment_body["Title"] ?></div>
                                    <?php echo $comment_body["Body"] ?>
                                </div>
                                    <form id="commentLikeDislikeForm<?php echo $comment_body["commentID"]?>" method="post" action="/comment_like">
                                <?php
                                echo "<div class=\"d-flex align-items-center\">
                                <button type=\"submit\" class=\"btn btn-primary btn-sm me-2\" 
                                name=\"{$comment_body["commentID"]}_like\" onclick=\"commentLike({$comment_body["commentID"]})\"> Like </button> 
                                
                                <p id=\"like_count{$comment_body["commentID"]}\" class=\"mb-0 pe-2\"> Likes: ".$comment_body["Likes"]."</p>
                                
                                <button type=\"submit\" class=\"btn btn-warning btn-sm me-2\" 
                                name=\"{$comment_body["commentID"]}_dislike\" onclick=\"commentDislike({$comment_body["commentID"]})\"> Dislike </button>
                                <p id=\"dislike_count{$comment_body["commentID"]}\" class=\"mb-0\"> Dislikes: ".$comment_body["Dislikes"]."</p></div>";
                                
                                ?>
                                <input type="hidden" id="forum_post_id" name="forumPostValue" value="<?php echo $post_id?>">
                                <input type="hidden" id="updatePostId<?php echo $comment_body["commentID"]?>" name="updatePostId" value="">
                                <input type="hidden" id="updateAction<?php echo $comment_body["commentID"]?>" name="updateAction" value="">
                                <input type="hidden" id="updateAmount<?php echo $comment_body["commentID"]?>" name="updateAmount" value="">
                                </form>            
                            </li>    
                        <!-- Display comments dynamically using JavaScript -->
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="row m-3">
                <div class="col-11">
                    <form class="form-control" action="/process_comment" method="POST" id="commentForm">
                        <input class="form-control m-2" name="commentTitle" placeholder="Add a title"></input>
                        <textarea class="form-control m-2" name="commentInput" placeholder="Add a comment"></textarea>
                        <input type="hidden" name="currentForumID" value="<?php echo $forum_id?>"></input>
                        <br><button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="navbar sticky-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>
        <!-- End Footer -->
        <script>
            let is_liked = false;
            let is_disliked = false;
            function forumLike(forum_post_id){
                let like_value = Number(document.getElementById("like_count".concat(forum_post_id)).innerHTML.substring(8));
                if(!is_liked){
                    like_value = like_value + 1;
                    
                }
                else{
                    like_value = like_value - 1;
                }
                is_liked = !is_liked;
                document.getElementById("like_count".concat(forum_post_id)).innerText = ' Likes: '.concat(String(like_value));
                updateDatabase(forum_post_id, 'like', like_value);

            }
            function forumDislike(forum_post_id){
                let like_value = Number(document.getElementById("dislike_count".concat(forum_post_id)).innerHTML.substring(11));
                if(!is_disliked){
                    like_value = like_value + 1;
                }
                else{
                    like_value = like_value - 1;
                }
                is_disliked != is_disliked;
                document.getElementById("dislike_count".concat(forum_post_id)).innerText = ' Dislikes: '.concat(String(like_value));

                updateDatabase(forum_post_id, 'dislike', like_value);
            }

            function updateDatabase(postID, action, like_value) {
                    // Update the hidden form fields with the post ID and action
                    document.getElementById('updatePostId'.concat(postID)).value = postID;
                    document.getElementById('updateAction'.concat(postID)).value = action;
                    document.getElementById('updateAmount'.concat(postID)).value = like_value;
                    console.log('Updated values:', {
                        postID: document.getElementById('updatePostId' + postID).value,
                        action: document.getElementById('updateAction' + postID).value,
                        amount: document.getElementById('updateAmount' + postID).value                        
                    });
                    // Submit the form
                    document.getElementById('likeDislikeForm' + postID).submit();
                }

            function commentLike(forum_post_id){
                let like_value = Number(document.getElementById("like_count".concat(forum_post_id)).innerHTML.substring(8));
                if(!is_liked){
                    like_value = like_value + 1;
                    
                }
                else{
                    like_value = like_value - 1;
                }
                is_liked = !is_liked;
                document.getElementById("like_count".concat(forum_post_id)).innerText = ' Likes: '.concat(String(like_value));
                updateCommentDatabase(forum_post_id, 'like', like_value);

            }
            function commentDislike(forum_post_id){
                let like_value = Number(document.getElementById("dislike_count".concat(forum_post_id)).innerHTML.substring(11));
                if(!is_disliked){
                    like_value = like_value + 1;
                }
                else{
                    like_value = like_value - 1;
                }
                is_disliked != is_disliked;
                document.getElementById("dislike_count".concat(forum_post_id)).innerText = ' Dislikes: '.concat(String(like_value));

                updateCommentDatabase(forum_post_id, 'dislike', like_value);
            }
            function updateCommentDatabase(postID, action, like_value) {
                    // Update the hidden form fields with the post ID and action
                    document.getElementById('updatePostId'.concat(postID)).value = postID;
                    document.getElementById('updateAction'.concat(postID)).value = action;
                    document.getElementById('updateAmount'.concat(postID)).value = like_value;
                    console.log('Updated values:', {
                        postID: document.getElementById('updatePostId' + postID).value,
                        action: document.getElementById('updateAction' + postID).value,
                        amount: document.getElementById('updateAmount' + postID).value                        
                    });
                    // Submit the form
                    document.getElementById('commentLikeDislikeForm' + postID).submit();
                }

        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>

