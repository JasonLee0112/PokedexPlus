
<?php        
    $servername = 'mysql.cs.virginia.edu';
        $username = 'rmk9ds';
        $password = 'Fall2023';

        $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';
        try {
            $db = new PDO($dsn, $username, $password);
            $checkQuery = "SELECT * FROM Account WHERE email = '$email'";
            $statement = $db->prepare($checkQuery);
            $statement->execute();
            if ($statement->rowCount() > 0){
                echo "Email Found";
            }
            else{
                echo "Email Not Found";
            }

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
        
