<!DOCTYPE html>
<html>
    <?php
        // echo "Php is processed correctly";
        session_start();
        $servername = 'mysql.cs.virginia.edu';
        $username = 'rmk9ds';
        $password = 'Fall2023';
        $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';

        try {
            $db = new PDO($dsn, $username, $password);
            $ability_query = "SELECT AbilityName FROM `Pokemon Abilities`";
            $statement = $db->prepare($ability_query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $moves_query = "SELECT `Type`, `Name` FROM `Moves`";
            $statement1 = $db->prepare($moves_query);
            $statement1->execute();
            $moves = $statement1->fetchAll(PDO::FETCH_ASSOC);

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
    </head>
    <body>
        <?php
        include('header.php');
        ?>

        <!-- Content -->
        <div>
            <h1>Welcome to the Pokemon Creation Center</h1>
        </div>
        <div>

        </div>
        <form action="/addPokemon" method="post">
            <label for="pname">Pokemon Name:</label>
            <input type="text" id="pname" name="pname"><br>
            <label for="hp">HP:</label>
            <input type="number" id="hp" name="hp" min="1" max="255"><br>
            <label for="attack">Attack:</label>
            <input type="number" id="attack" name="attack" min="1" max="255"><br>
            <label for="defense">Defense:</label>
            <input type="number" id="defense" name="defense" min="1" max="255"><br>
            <label for="spattack">Special Attack:</label>
            <input type="number" id="spattack" name="spattack" min="1" max="255"><br>
            <label for="spdefense">Special Defense:</label>
            <input type="number" id="spdefense" name="spdefense" min="1" max="255"><br>
            <label for="spdefense">Speed:</label>
            <input type="number" id="speed" name="speed" min="1" max="255"><br>
            <label for="ability">Ability:</label>
            <select id="ability" name="ability" size="5">
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['AbilityName'] ?>"><?= $result['AbilityName'] ?></option>
                <?php
                } ?>
            </select><br>
            <label for="type1">Type 1:</label>
            <select id="type1" name="type1" size="5">
                <option value="Grass">Grass</option>
                <option value="Psychic">Psychic</option>
                <option value="Dark">Dark</option>
                <option value="Bug">Bug</option>
                <option value="Steel">Steel</option>
                <option value="Rock">Rock</option>
                <option value="Normal">Normal</option>
                <option value="Water">Water</option>
                <option value="Dragon">Dragon</option>
                <option value="Electric">Electric</option>
                <option value="Poison">Poison</option>
                <option value="Fire">Fire</option>
                <option value="Fairy">Fairy</option>
                <option value="Ice">Ice</option>
                <option value="Ground">Ground</option>
                <option value="Ghost">Ghost</option>
                <option value="Fighting">Fighting</option>
                <option value="Flying">Flying</option>
            </select><br>
            <label for="type2">Type 2:</label>
            <select id="type2" name="type2" size="5">
                <option value="Grass">Grass</option>
                <option value="Psychic">Psychic</option>
                <option value="Dark">Dark</option>
                <option value="Bug">Bug</option>
                <option value="Steel">Steel</option>
                <option value="Rock">Rock</option>
                <option value="Normal">Normal</option>
                <option value="Water">Water</option>
                <option value="Dragon">Dragon</option>
                <option value="Electric">Electric</option>
                <option value="Poison">Poison</option>
                <option value="Fire">Fire</option>
                <option value="Fairy">Fairy</option>
                <option value="Ice">Ice</option>
                <option value="Ground">Ground</option>
                <option value="Ghost">Ghost</option>
                <option value="Fighting">Fighting</option>
                <option value="Flying">Flying</option>
                <option value="null">None</option>
            </select><br>

            <input type="submit" value="Submit" name="addBtn">
        </form>
        <!-- End Content -->

        <!-- Footer -->
        <!--<div class="navbar fixed-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>-->
        <!-- End Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
