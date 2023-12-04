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
                            <?php
                                echo "<div class=\"d-flex align-items-center\">
                                <button class=\"btn btn-primary btn-sm me-2\" name=\"{$row["forumPostID"]}_Like\" onclick=\"send_like()\"> Like </button> 
                                <p class=\"mb-0 pe-2\"> Likes: ".$row["Likes"]."</p>
                                <button class=\"btn btn-warning btn-sm me-2\" name=\"{$row["forumPostID"]}_Dislike\" onclick=\"send_dislike()\"> Dislike </button>
                                <p class=\"mb-0\"> Dislikes: ".$row["Dislikes"]."</p></div>";
                            ?>
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

        <script>
        // Track the current like/dislike state
        let like_was_pressed = false;
        let dislike_was_pressed = false;

        </script>

        <!-- End Content -->

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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
