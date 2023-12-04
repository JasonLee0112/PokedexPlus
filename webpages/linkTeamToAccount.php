<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        $query = 'INSERT INTO pokemonTeam_belongsTo_Account(userID, teamID) VALUES( :userID, :teamID);';

        $statement = $db->prepare($query);

        $userID = $argv[1];
        $teamID = $argv[2];

        $statement->bindValue(':userID', $userID);
        $statement->bindValue(':teamID', $teamID);
        
        $statement->execute();
        echo "Successful Account Link";
    }
    catch (PDOException $e){
        $error_message = $e->getMessage();
        echo "PDO failed";
    }
    catch (Exception $e){
        $error_message = $e ->getMessage();
        echo "Did not update team";
        echo "<p> Not connection error!: $error_message </p>";
    };

?>