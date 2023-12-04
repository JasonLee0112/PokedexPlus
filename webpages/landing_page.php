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
        $query = "SELECT Pokemon.PokeName, HP, Attack, Defense, SpecialAttack, SpecialDefense, Speed FROM Pokemon, 'Daily Pokemon' 
        WHERE (SELECT PokeName FROM 'Daily Pokemon' WHERE date = $current_date) = Pokemon.PokeName";
        
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
                <!-- <div class="justify-content-end nav-item">
                        <div id="g_id_onload"
                            data-client_id="926122338315-95c1lbkulm3en0ui5icuechntk4eq7jn"
                            data-login_uri="localhost:3000/home"
                            data-auto_prompt="false">
                        </div>
                        <div class="g_id_signin"
                            data-type="standard"
                            data-size="large"
                            data-theme="outline"
                            data-text="sign_in_with"
                            data-shape="rectangular"
                            data-logo_alignment="left">
                        </div> -->

                    <div class="justify-content-end nav-item">
                        <a class="nav-link button" href="login">Login/Sign-Up</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- Content -->
        <div class="container welcome-page">
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
                    <p> Popular Forum Posts: </p>
                    <!-- Some code to fetch the forum post with the highest likes for the day -->
                </div>
                <div class="col border">
                    <p> Today's Pokemon: </p>
                    <!-- Some code to randomly fetch a pokemon from the pokedex -->
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