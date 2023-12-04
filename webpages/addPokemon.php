<?php
    $servername = 'mysql.cs.virginia.edu';
    $username = 'rmk9ds';
    $password = 'Fall2023';
    $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

    $db = new PDO($dsn, $username, $password);
    $name_query = "SELECT `Name` FROM `Pokemon`";
    $statement = $db->prepare($name_query);
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    global $db;
    $query = "insert into Pokemon values (:pname, :hp, :attack, :defense, :spattack, :spdefense, :speed, :ability, :type1, :type2 )";

    if(in_array($pname, $results) == false){
        $statement = $db->prepare($query);
        $statement->bindValue(':pname', $pname);
        $statement->bindValue(':hp', $hp);
        $statement->bindValue(':attack', $attack);
        $statement->bindValue(':defense', $defense);
        $statement->bindValue(':spattack', $spattack);
        $statement->bindValue(':spdefense', $spdefense);
        $statement->bindValue(':speed', $speed);
        $statement->bindValue(':ability', $ability);
        $statement->bindValue(':type1', $type1);
        $statement->bindValue(':type2', $type2);
        $statement->execute();
        $statement->closeCursor();
}
?>