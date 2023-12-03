<!DOCTYPE html>
<html>
    <head>
        <?php        
        $servername = 'mysql.cs.virginia.edu';
            $username = 'rmk9ds';
            $password = 'Fall2023';

            $dsn = 'mysql:host=mysql01.cs.virginia.edu;dbname=rmk9ds_b';




            try {
                $db = new PDO($dsn, $username, $password);
                $pokedex_query = "SELECT PokeName, HP, Attack, Defense, SpecialAttack, SpecialDefense, Speed FROM Pokemon";
                $count_query = "SELECT COUNT(PokeName) AS num FROM Pokemon";
                $statement = $db->prepare($pokedex_query);
                $statement->execute();
                $statement2 = $db->prepare($count_query);
                $statement2->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                // echo "<p> connected! <p>";
                $counts = $statement2->fetchAll(PDO::FETCH_ASSOC);

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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <!-- Header -->
        <div class="navbar navbar-expand-lg bg-body-secondary sticky-top">
                <div class="container-fluid">
                <a class="navbar-brand" href="/"><img class="brand-image" src="/uvaball.png"> Pokedex+ </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"> Hi </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="pokedex">Pokedex</a>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="create.php" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Create
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="team">Team</a></li>
                                <li><a class="dropdown-item" href="pokemon">Pokemon</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="forum">Forum</a>
                            </li>
                        </ul>
                    </div>
                    <div class="justify-content-end nav-item">
                        <a class="nav-link button" href="login">Login</a>
                    </div>
                </div>
            </div>
        <!-- End Header -->

        <!-- Content -->
        <div class="row">
            <div class="d-flex justify-content-start col-4 m-2">
                <input type="text" class="form-control" id="pokemon-searcher" placeholder="Search">
            </div>
        </div>
        <div class="p-2">
            <ul id="pagination1" class="pagination d-flex justify-content-center">    
            </ul>
            <div id="pokemon-list">
            </div>
            <div class="d-flex row justify-content-center">
            <?php
                $count = 0;
                foreach($counts as $array_value){
                    $count = $array_value['num'];
                }
                $num_pages = $count % 50;
                // echo $num_pages;
            ?>
            </div>
            <ul id="pagination2" class="pagination d-flex justify-content-center">    
            </ul>
        </div>
    </div>
        <?php
            $cleaned_data = array_map(function($item){
                if(str_contains($item["PokeName"], '\'')){
                    $item["PokeName"] = str_replace( '\'', '',$item["PokeName"]);
                }
                if(str_contains($item["PokeName"], 'Mega Mewtwo') || str_contains($item["PokeName"], "Mega Charizard")){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Mega ".$temp[0]." ".$temp[3];
                    $item["FixedName"] = "Mega-".$temp[0]." ".$temp[3];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Mega ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Mega ".$temp[0];
                    $item["FixedName"] = "Mega-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Galarian ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Galarian ".$temp[0];
                    $item["FixedName"] = "Galarian-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Hisuian ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Hisuian ".$temp[0];
                    $item["FixedName"] = "Hisuian-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Hisuian ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Hisuian ".$temp[0];
                    $item["FixedName"] = "Hisuian-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Partner ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Partner ".$temp[0];
                    $item["FixedName"] = "Partner-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Alolan ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Alolan ".$temp[0];
                    $item["FixedName"] = "Alolan-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Ash-Greninja')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Ash-".$temp[0];
                    $item["FixedName"] = "Ash-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Primal')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Primal ".$temp[0];
                    $item["FixedName"] = "Primal-".$temp[0];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Necrozma D')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = $temp[1]." ".$temp[2]." ".$temp[3];
                    $item["FixedName"] = $temp[1]."-".$temp[2]."-".$temp[3];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Necrozma ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = $temp[1]." Necrozma";
                    $item["FixedName"] = $temp[1]."-Necrozma";
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Hoopa')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Hoopa ".$temp[2];
                    $item["FixedName"] = "Hoopa-".$temp[2];
                    return $item;
                }
                
                elseif(str_contains($item["PokeName"], 'Rotom ')){
                    $temp = explode(" ", $item["PokeName"]);
                    // print_r($temp);
                    $item["PokeName"] = "Rotom ".$temp[1];
                    $item["FixedName"] = "Rotom-".$temp[1];
                    return $item;
                }
                elseif(str_contains($item["PokeName"], 'Own Tempo')){
                    return;
                }
                elseif(str_contains($item["PokeName"], ' ')){
                    $item["FixedName"] = str_replace(' ', '-', $item["PokeName"]);             
                    return $item;
                }
                else{
                    $item["FixedName"] = $item["PokeName"];
                    return $item;
                }
            }, $result);
            
            $filteredArray = array_filter($cleaned_data, function ($row) {
                return $row !== null && count($row) > 0;
            });
            echo "<script> 
                    const pokemonData = ".json_encode($filteredArray).";"
                    ."</script>";
        ?>
        <script>
            
            document.addEventListener('DOMContentLoaded', function () {
                const itemsList = document.getElementById('pokemon-list');
                const pagination1 = document.getElementById('pagination1');
                const pagination2 = document.getElementById('pagination2');
                let allItems = [];
                let filteredItems = [];
                
                console.log(typeof pokemonData);
                allItems = Object.values(pokemonData);
                filteredItems = allItems;

                const itemsPerPage = 50;
                let currentPage = 1;

                // Initialize and display items for the initial page
                updateItems();

                function updateItems() {
                    const startIndex = (currentPage - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;
                    const displayedItems = filteredItems.slice(startIndex, endIndex);
                    
                    console.log(typeof filteredItems)
                    // Update the items list
                    itemsList.innerHTML = displayedItems.map(item => (
                        `<div id="${item.FixedName}" class="card mb-2">
                            <div id="${item.FixedName}-body" class="card-body">
                                <div class="row m-3" id="${item.FixedName}">
                                    <div class="d-flex align-items-center col">
                                        <a class="btn" data-bs-toggle="collapse" href="#${item.FixedName}-Info" role="button">
                                        ${item.PokeName}</a>
                                    </div>
                                </div>
                                <div class="m-3 collapse" id="${item.FixedName}-Info">
                                     HP: ${item.HP} Attack: ${item.Attack} Defense: ${item.Defense} Special Attack: 
                                     ${item.SpecialAttack} Special Defense: ${item.SpecialDefense} Speed: ${item.Speed}
                                </div>
                            </div>
                        </div>`
                        )).join('');

                    // Update the pagination links
                    pagination1.innerHTML = generatePaginationLinks();
                    pagination2.innerHTML = generatePaginationLinks();
                }

                function generatePaginationLinks() {
                    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
                    let links = ''
                    if(currentPage == 1){
                        links = '';
                    }
                    else{
                        links = `<li class="page-item"><a href="#" class="page-link" onclick="changePage(${currentPage - 1})"><span aria-hidden="true">&laquo;</span></a></li>`;
                    }
                    
                    let min_page = 1;
                    let max_page = totalPages;
                    if(totalPages < 2){
                        min_page = 1;
                        max_page = 1;
                    }
                    else if(currentPage < 2){
                        min_page = 1;
                        max_page = currentPage + 1;
                    }
                    else if(currentPage > totalPages - 2){
                        min_page = currentPage - 1;
                        max_page = totalPages;
                    }
                    else{
                        min_page = currentPage - 1;
                        max_page = currentPage + 1;
                    }
                    for (let i = min_page; i <= max_page; i++) {
                        links += `<li class="page-item ${currentPage === i ? 'active' : ''}">
                                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                                </li>`;
                    }

                    if(currentPage == totalPages){
                        return links;
                    }
                    else{
                        links += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${currentPage + 1})"><span aria-hidden="true">&raquo;</span></a></li>`;
                        return links;
                    }
                }

                window.changePage = function (page) {
                    currentPage = page;
                    updateItems();
                };

                const searchInput = document.getElementById('pokemon-searcher');
                searchInput.addEventListener('input', function (event){
                    const searchTerm = event.target.value.toLowerCase();
                    
                    // Filter items based on the search term
                    filteredItems = allItems.filter(item => item.PokeName.toLowerCase().includes(searchTerm));
                    currentPage = 1; // Reset to the first page when searching
                    updateItems();
                });
            });
        </script>
        <!-- End Content -->
        
        <!-- Footer -->
        <div class="navbar sticky-bottom bg-body-secondary">
            <div class="container-fluid">
                Footer
            </div>
        </div>
        <!-- End Footer -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
