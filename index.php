<html>
    <?php
    // echo "Php is processed correctly";

    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';

    $dbname = 'rmk9ds_b';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';




    try {
        $db = new PDO($dsn, $username, $password);
        echo "<p> connected! <p>";

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

    <p> test </p>
    <p>
        <?php 
            $query = "SELECT email FROM `Account`";
            $result = $db->query($query);
            foreach ($result as $row){
                print $row['email'];
            }
        ?>
    </p>

    <div>
        <form>
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>