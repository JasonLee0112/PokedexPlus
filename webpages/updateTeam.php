<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        $query = 'UPDATE PokemonTeam SET Pokemon1=:Pokemon1, Pokemon2=:Pokemon2, Pokemon3=:Pokemon3, Pokemon4=:Pokemon4, Pokemon5=:Pokemon5, Pokemon6=:Pokemon6 WHERE TeamID=0';
        $statement = $db->prepare($query);
        $pmon1 = $argv[1];
        $pmon2 = $argv[2];
        $pmon3 = $argv[3];
        $pmon4 = $argv[4];
        $pmon5 = $argv[5];
        $pmon6 = $argv[6];

        $statement->bindValue(':Pokemon1', $pmon1);
        $statement->bindValue(':Pokemon2', $pmon2);
        $statement->bindValue(':Pokemon3', $pmon3);
        $statement->bindValue(':Pokemon4', $pmon4);
        $statement->bindValue(':Pokemon5', $pmon5);
        $statement->bindValue(':Pokemon6', $pmon6);
        
        $statement->execute();
        echo "Successful updated team";
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