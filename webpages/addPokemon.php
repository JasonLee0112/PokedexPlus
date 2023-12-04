<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    try{
        $db = new PDO($dsn, $username, $password); 
        $query = 'INSERT INTO Pokemon(PokeName, HP, Attack, Defense, SpecialAttack, SpecialDefense, Speed, Abilities, Types, Moves) VALUES(:PokeName, :HP, :Attack, :Defense, :SpecialAttack, :SpecialDefense, :Speed, :Abilities, :Types, :Moves);';
        $statement = $db->prepare($query);
        $pname = $argv[1];
        $hp = $argv[2];
        $attack = $argv[3];
        $defense = $argv[4];
        $spattack = $argv[5];
        $spdefense = $argv[6];
        $speed = $argv[7];
        $ability = $argv[8];
        $type1 = $argv[9];
        $type2 = $argv[10];
        $type = array($type1, $type2);
        $finalType = implode(', ', $type);

        $statement->bindValue(':PokeName', $pname);
        $statement->bindValue(':HP', $hp);
        $statement->bindValue(':Attack', $attack);
        $statement->bindValue(':Defense', $defense);
        $statement->bindValue(':SpecialAttack', $spattack);
        $statement->bindValue(':SpecialDefense', $spdefense);
        $statement->bindValue(':Speed', $speed);
        $statement->bindValue(':Abilities', $ability);
        $statement->bindValue(':Types', $finalType);
        $statement->bindValue(':Moves', "None");
        $statement->execute();
        echo "Pokemon Added";
    }
    catch (PDOException $e){
        $error_message = $e->getMessage();
        echo "PDO failed";
    }
    catch (Exception $e){
        $error_message = $e ->getMessage();
        echo "Another exception";
        echo "<p> Not connection error!: $error_message </p>";
    };

?>