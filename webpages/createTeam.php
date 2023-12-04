<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        $query = 'INSERT INTO PokemonTeam(teamID,TeamName,Pokemon1,Pokemon2,Pokemon3,Pokemon4,Pokemon5,Pokemon6) VALUES(:teamID,:teamName,:P1, :P2, :P3, :P4,:P5,:P6)';

        $statement = $db->prepare($query);
        $pmon1 = $argv[1];
        $pmon2 = $argv[2];
        $pmon3 = $argv[3];
        $pmon4 = $argv[4];
        $pmon5 = $argv[5];
        $pmon6 = $argv[6];
        $teamID = $argv[7];
        $teamName = $argv[8];

        $statement->bindValue(':teamID', $teamID);
        $statement->bindValue(':teamName', $teamName);
        $statement->bindValue(':P1', $pmon1);
        $statement->bindValue(':P2', $pmon2);
        $statement->bindValue(':P3', $pmon3);
        $statement->bindValue(':P4', $pmon4);
        $statement->bindValue(':P5', $pmon5);
        $statement->bindValue(':P6', $pmon6);
       
        $statement->execute();
        echo "Successful created team";
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