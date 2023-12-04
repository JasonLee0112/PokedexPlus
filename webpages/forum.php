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
            $forum_query = "SELECT Title, Body, Likes, Dislikes FROM ForumPost GROUP BY forumPostID";
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
                            <a class="nav-link" href="pokedex">Pokedex</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="create.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Create
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="team">Team</a></li>
                                <li><a class="dropdown-item" href="pokemon">Pokemon</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="forum">Forum</a>
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
                        <form>
                            <div class="mb-3">
                                <label for="post-title" class="col-form-label"> Title </label>
                                <input type="text" class="form-control" placeholder="Enter Title Here" id="post-title">
                            </div>
                            <div class="mb-3">
                                <label for="post-text" class="col-form-label"> Enter your post here </label>
                                <textarea class="form-control" id="post-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Cancel </button>
                        <button type="button" class="btn btn-primary"> Submit Post </button>
                    </div>
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
                                echo "<h1 class=\"border border-light border-opacity-50 border-4 rounded\">".$row["Title"]."</h1>";
                            ?>
                            <?php
                                echo "<p class=\"border border-light-subtle border-2 rounded\">".$row["Body"]."</p>";
                            ?>
                            <div class="row">
                            <?php
                                echo "<div class=\"d-flex align-items-center\">
                                <button class=\"btn btn-primary btn-sm me-2\" onclick=\"send_like()\"> Like </button> 
                                <p class=\"mb-0 pe-2\"> Likes: ".$row["Likes"]."</p>
                                <button class=\"btn btn-warning btn-sm me-2\" onclick=\"send_dislike()\"> Dislike </button>
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
