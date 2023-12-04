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
    const password = req.body.password;
    const confirmPassword = req.body.confirmPassword;
    
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

const server = http.createServer(app);

server.listen(port, hostname, () => {
    console.log(`Server is running on http://localhost:${port}`);
});