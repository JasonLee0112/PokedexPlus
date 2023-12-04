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
        $current_date = date("Y-m-d");
        $query1 = "SELECT pokemon_name FROM Daily_Pokemon WHERE date = '$current_date' ";
        $daily_statement = $db->prepare($query1);
        $daily_statement->execute();
        $daily_pokemon_result = $daily_statement->fetchAll(PDO::FETCH_ASSOC);
        // echo "daily_pokemon: ";
        // print_r($daily_pokemon_result[0]["pokemon_name"]);

        $daily_pokemon = $daily_pokemon_result[0]["pokemon_name"];
        $query2 = "SELECT DISTINCT Pokemon.PokeName, HP, Attack, Defense, SpecialAttack, SpecialDefense, Speed FROM Pokemon, Daily_Pokemon 
        WHERE Pokemon.PokeName = '$daily_pokemon'";
        
        $pokemon_statement = $db->prepare($query2);
        $pokemon_statement->execute();
        $pokemon_data = $pokemon_statement->fetchAll(PDO::FETCH_ASSOC);
        // print_r($pokemon_data);

        $query3 = "SELECT Title, Body, Likes, Dislikes,
        IF(dislikes = 0, likes, likes / dislikes) AS like_dislike_ratio
        FROM ForumPost ORDER BY like_dislike_ratio DESC, likes DESC LIMIT 3";
        $forum_statement = $db->prepare($query3);
        $forum_statement->execute();
        $forum_posts = $forum_statement->fetchAll(PDO::FETCH_ASSOC);
        // print_r($forum_posts);

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
        <meta name="google-signin-client_id" content="926122338315-95c1lbkulm3en0ui5icuechntk4eq7jn.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://accounts.google.com/gsi/client" async></script>
    </head>
    <body>
        <?php
        include('header.php');
        ?>
        <!-- Content -->
        <div class="welcome-page">
            <div class="d-flex flex-row justify-content-xxl-center">
                <div class="d-flex flex-column p-2">
                    <h1 class="welcome-page"> Welcome! </h1>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-xxl-center">
                <div class="d-flex flex-column">
                    <p> Log in or sign-up with the button at the top right </p> 
                </div>
            </div>
            <div class="d-flex flex-row">
                <div class="col border">
                    <p> Most Popular Forum Posts: </p>
                    <!-- Some code to fetch the forum post with the highest likes/dislike ratio then like count for the day -->
                    <?php foreach ($forum_posts as $forum_information){
                        ?>
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    echo "<a class=\"fs-4 link-underline link-underline-opacity-0 link-underline-opacity-75-hover link-offset-1-hover\" href=#><b>".$forum_information["Title"]."</b></a><br>";
                                    $body = $forum_information["Body"];
                                    if(strlen($body) > 100){
                                        echo substr($body, 0, 100)."...<br>";
                                    }
                                    else{
                                        echo $body."<br>";
                                    }
                                    echo "<br>Likes: ".$forum_information["Likes"];
                                    echo " Dislikes: ".$forum_information["Dislikes"];
                                ?>
                            </div>
                        </div>
                        <?php
                        } 
                    ?> 
                </div>
                <div class="col border">
                    <p> Today's Pokemon: </p>
                    <!-- Some code to randomly fetch a pokemon from the pokedex -->
                    <div class="card">
                        <div class="card-body">
                            <?php echo $pokemon_data[0]["PokeName"];?>
                            <p class="m-3"> Stats: <br>
                            <?php 
                                echo "HP: ".$pokemon_data[0]["HP"];
                                echo "<br>Attack: ".$pokemon_data[0]["Attack"];
                                echo "<br>Defense: ".$pokemon_data[0]["Defense"];
                                echo "<br>Special Attack: ".$pokemon_data[0]["SpecialAttack"];
                                echo "<br>Special Defense: ".$pokemon_data[0]["SpecialDefense"];
                                echo "<br>Speed: ".$pokemon_data[0]["Speed"];
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content -->

        <!-- Footer -->
        <div class="navbar fixed-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>
        <!-- End Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>