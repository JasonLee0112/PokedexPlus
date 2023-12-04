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
            $pokemon_query = "SELECT PokeName FROM `Pokemon`";
            $statement = $db->prepare($pokemon_query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $team_query = "SELECT * FROM `PokemonTeam` WHERE TeamID=0";
            $statement1 = $db->prepare($team_query);
            $statement1->execute();
            $team = $statement1->fetchAll(PDO::FETCH_ASSOC);

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

        <h1>Update Team</h1>
        <div class="container">
        <div class="left-div">
        <form action="/updateTeam" method="post">
            <label for="pokemon1">Pokemon 1:</label>
            <select id="pokemon1" name="pokemon1" size="5" required>
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['PokeName'] ?>"><?= $result['PokeName'] ?></option>
                <?php
                } ?>
            </select><br>
            <label for="pokemon2">Pokemon 2:</label>
            <select id="pokemon2" name="pokemon2" size="5" required>
                <option value="empty">None</option>
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['PokeName'] ?>"><?= $result['PokeName'] ?></option>
                <?php
                } ?>
            </select><br>
            <label for="pokemon3">Pokemon 3:</label>
            <select id="pokemon3" name="pokemon3" size="5" required>
                <option value="empty">None</option>
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['PokeName'] ?>"><?= $result['PokeName'] ?></option>
                <?php
                } ?>
            </select><br>
            <label for="pokemon4">Pokemon 4:</label>
            <select id="pokemon4" name="pokemon4" size="5" required>
                <option value="empty">None</option>
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['PokeName'] ?>"><?= $result['PokeName'] ?></option>
                <?php
                } ?>
            </select><br>
            <label for="pokemon5">Pokemon 5:</label>
            <select id="pokemon5" name="pokemon5" size="5" required>
                <option value="empty">None</option>
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['PokeName'] ?>"><?= $result['PokeName'] ?></option>
                <?php
                } ?>
            </select><br>
            <label for="pokemon6">Pokemon 6:</label>
            <select id="pokemon6" name="pokemon6" size="5" required>
                <option value="empty">None</option>
                <?php
                    foreach($results as $result) { ?>
                        <option value="<?= $result['PokeName'] ?>"><?= $result['PokeName'] ?></option>
                <?php
                } ?>
            </select><br>
            <input type="submit" value="Submit" name="addBtn">
        </form>
        </div>
        <div class="right-div">
            <?php
                foreach($team as $t) { ?>
                    <h2><?= $t['TeamName'] ?></h2>
                    <p>Pokemon 1: <?= $t['Pokemon1'] ?></p>
                    <p>Pokemon 2: <?= $t['Pokemon2'] ?></p>
                    <p>Pokemon 3: <?= $t['Pokemon3'] ?></p>
                    <p>Pokemon 4: <?= $t['Pokemon4'] ?></p>
                    <p>Pokemon 5: <?= $t['Pokemon5'] ?></p>
                    <p>Pokemon 6: <?= $t['Pokemon6'] ?></p>
            <?php
            } ?>
        </div>
        </div>
        

        <!-- Footer
        <div class="navbar fixed-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>
         End Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
