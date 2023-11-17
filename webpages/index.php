<html>
    <?php
    // echo "Php is processed correctly";

    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';

    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';




    try {
        $db = new PDO($dsn, $username, $password);
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
    </head>
    <div class="navbar navbar-expand-lg bg-body-secondary sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> Pokedex+ </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"> Hi </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
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
        
    <div>
        <p> Pokemon </p>

        <form method="POST">
            
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>


    <div class="navbar fixed-bottom bg-body-secondary">
        <div class="container-fluid">
            Footer
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>