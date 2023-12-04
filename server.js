const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

const path = require('path')

const express = require('express');
const { spawn } = require('child_process');
const app = express();
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));




app.get('/sign-up', (req, res) => {
  
    let scriptPath = "./webpages/signuppage.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.post('/sign-up', (req, res) => {
    const username = req.body.username;
    const email = req.body.email;
    const password = req.body.username;
    const confirmPassword = req.body.username;
    
    // do a select in the database based on user name, 
    // 1. if email already exists then redirect to login page
    // 2. if it doesnt create the account 

    if (password !== confirmPassword) {
        return res.status(400).send('Passwords do not match');
    }
    let signupCheckScriptPath = "./webpages/signupCheck.php";
    let createAccountScriptPath = "./webpages/createAccount.php";
    const phpProcess = spawn('php', [signupCheckScriptPath,email]);
    let checkEmail= "";
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkEmail += output;
        if(checkEmail.includes("Email Found")){
            console.log("redirect to login")
            res.redirect("/");
        }
        else if(checkEmail.includes("Email Not Found")){
            console.log("email not found");
            res.redirect("/sign-up");
        }
    });
    
    // else{
    //     console.log("end");
    //     res.end();
    // }

    // phpProcess.stderr.on('data', (data) => {
    //     console.error(`stderr: ${data}`);
    // });

    // phpProcess.on('close', () => {
    //     res.end();
    // });

    // // Database Logic

    
});

app.get('/home', (req, res) => {
    let scriptPath = "./webpages/logged_index.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.get('/', (req, res) => {
    let scriptPath = "./webpages/landing_page.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});


app.get('/pokedex', (req, res) => {
    let scriptPath = "./webpages/pokedex.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.get('/forum', (req, res) => {
    let scriptPath = "./webpages/forum.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.get('/team', (req, res) => {
    let scriptPath = "./webpages/team.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.get('/pokemon', (req, res) => {
    let scriptPath = "./webpages/pokemon.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.get('/login', (req, res) => {
    let scriptPath = "./webpages/login.php";
    const phpProcess = spawn('php', [scriptPath]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        res.end();
    });
});

app.post('/addPokemon', (req, res) => {
    let createPokemonScriptPath = "./webpages/addPokemon.php";
    let pname = req.body.pname;
    let hp = req.body.hp;
    let attack = req.body.attack;
    let defense = req.body.defense;
    let spattack = req.body.spattack;
    let spdefense = req.body.spdefense;
    let speed = req.body.speed;
    let ability = req.body.ability;
    let type1 = req.body.type1;
    let type2 = req.body.type2;
    console.log(pname, hp, attack, defense, spattack, spdefense, speed, ability, type1, type2);

    const phpProcess = spawn('php', [createPokemonScriptPath, pname, hp, attack, defense, spattack, spdefense, speed, ability, type1, type2]);
    let checkPokemon= "";
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Pokemon Added")){
            console.log("Successful add to Pokemon")
            res.redirect("/pokedex");
        }
        else if(checkPokemon.includes("Pokemon Not Added")){
            console.log("Did not add Pokemon");
            res.redirect("/pokemon");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/pokemon");
        }
        else if(checkPokemon.includes("SQL failed")){
            console.log("SQL failed");
            res.redirect("/pokemon");
        }
        else if(checkPokemon.includes("Another exception")){
            console.log("Another exception");
            res.redirect("/pokemon");
        }
        else if(checkPokemon.includes("This is the Probem")){
            console.log("This is the problem");
            res.redirect("/pokemon");
        }
    });
});



const server = http.createServer(app);

server.listen(port, hostname, () => {
    console.log(`Server is running on http://localhost:${port}`);
});