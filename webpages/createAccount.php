
<?php        
    $servername = 'mysql.cs.virginia.edu';
        $username = 'rmk9ds';
        $password = 'Fall2023';

        $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';
        try {
            $db = new PDO($dsn, $username, $password);
            $query = 'INSERT INTO Account(email, password, username, userID, is_a_admin) VALUES(:email, :password, :username, :userid, :isaAdmin);';
            $email = $argv[1];
            $password = $argv[2];
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $username = $argv[3];
            $userID = $argv[4];
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $hashed_password);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':userid', $userID);
            $statement->bindValue(':isaAdmin', 0);
            $statement->execute();
            echo "Account Created";

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
        
