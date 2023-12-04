<!DOCTYPE html>
<html>
    <?php
        // echo "Php is processed correctly";

        $servername = 'mysql.cs.virginia.edu';
        $username = 'rmk9ds';
        $password = 'Fall2023';

        $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';




        try {
            $db = new PDO($dsn, $username, $password);
            $forum_query = "SELECT forumPostID, Title, Body, Likes, Dislikes FROM ForumPost GROUP BY forumPostID";
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
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <?php
        include('header.php');
        ?>

        <!-- Content -->
        <div class="row m-2">
            <div class="col">
                <form>
                    <input class="form-control" type="text" placeholder="Search">
                </form>
            </div>
            <div class="d-flex justify-content-end col">
                <button type="button" class="btn-secondary btn" data-bs-toggle="modal" data-bs-target="#forumPost"> +Create </button>
            </div>
        </div>

        <div class="modal fade" id="forumPost" tabindex="-1" aria-labelledby="forumPostLabel" aria-hidden="true">
            <div class="modal-xl modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="forumPostLabel"> Forum Post </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/process_forum_post">
                            <div class="mb-3">
                                <label for="post-title" class="col-form-label"> Title </label>
                                <input type="text" class="form-control" placeholder="Enter Title Here" name="post_title">
                            </div>
                            <div class="mb-3">
                                <label for="post-text" class="col-form-label"> Enter your post here </label>
                                <textarea class="form-control" name="post_text"></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                        <button type="submit" class="btn btn-primary"> Submit Post </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- for each forum post in the first 50... -->
        <?php
            if($result) {
                foreach ($result as $row) {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <?php
                                echo "<a class=\"fs-1 text-reset link-underline link-underline-opacity-0\" href=\"forum/post?forumId=".urlencode($row["forumPostID"])."\">"
                                .$row["Title"]."</a>";
                            ?>
                            <?php
                                echo "<p class=\"border border-light-subtle border-2 rounded\">".substr($row["Body"],0, 500)."</p>";
                            ?>
                            <div class="row">
                                <form id="likeDislikeForm<?php echo $row["forumPostID"]?>" method="post" action="/forum_like">
                            <?php
                                echo "<div class=\"d-flex align-items-center\">
                                <button type=\"submit\" class=\"btn btn-primary btn-sm me-2\" 
                                name=\"{$row["forumPostID"]}_like\" onclick=\"forumLike({$row["forumPostID"]})\"> Like </button> 
                                
                                <p id=\"like_count{$row["forumPostID"]}\" class=\"mb-0 pe-2\"> Likes: ".$row["Likes"]."</p>
                                
                                <button type=\"submit\" class=\"btn btn-warning btn-sm me-2\" 
                                name=\"{$row["forumPostID"]}_dislike\" onclick=\"forumDislike({$row["forumPostID"]})\"> Dislike </button>
                                <p id=\"dislike_count{$row["forumPostID"]}\" class=\"mb-0\"> Dislikes: ".$row["Dislikes"]."</p></div>";
                            ?>
                                <input type="hidden" id="updatePostId<?php echo $row["forumPostID"]?>" name="updatePostId" value="">
                                <input type="hidden" id="updateAction<?php echo $row["forumPostID"]?>" name="updateAction" value="">
                                <input type="hidden" id="updateAmount<?php echo $row["forumPostID"]?>" name="updateAmount" value="">
                                    </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
            } 
            else {
                echo "Empty";
            }
        ?>
        <!-- Footer -->
        <div class="navbar sticky-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>

        <?php
            $db = null;
        ?>
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

        </script>
        <!-- End Content -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
