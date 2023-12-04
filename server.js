const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

const path = require('path')
const session = require('express-session');
const express = require('express');
const { spawn } = require('child_process');
const app = express();
app.use(express.urlencoded({ extended: true }));
app.use(express.static(path.join(__dirname, 'public')));


app.use(session({
    secret: 'not-secure-key', // Change this to a secure secret key
    resave: false,
    saveUninitialized: true,
    cookie: {
        maxAge: 100000 
      }
  }));

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
    const confirmPassword = req.body.confirmpassword;
    
    // do a select in the database based on user name, 
    // 1. if email already exists then redirect to login page
    // 2. if it doesnt create the account 

    if (password !== confirmPassword) {
        return res.status(400).send('Passwords do not match');
    }
    let signupCheckScriptPath = "./webpages/signupCheck.php";
    let createAccountScriptPath = "./webpages/createAccount.php";
    console.log(email);
    const phpProcess = spawn('php', [signupCheckScriptPath,email]);
    let checkEmail= "";
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkEmail += output;
        // console.log(checkEmail);
        if(checkEmail.includes("Email Found")){
            console.log("redirect to login")
            res.redirect("/");
        }
        else if(checkEmail.includes("Email Not Found")){
            console.log("email not found");
            // execute a PHP script to insert account into db

            // Generating random string found online
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let userID = '';
            for (let i = 0; i < 16; i++) {
              const randomIndex = Math.floor(Math.random() * characters.length);
              userID += characters.charAt(randomIndex);
            }

            const phpProcess2 = spawn('php', [createAccountScriptPath,email,password,username,userID]);
            phpProcess2.stdout.on('data', (data) => {
                const output = data.toString().trim();
                console.log(output);
            });
            res.redirect("/accountloginsignup")
        }
    });
       
});

app.get('/home', (req, res) => {
    const userID = req.session.userID;
    if (userID){
        console.log(userID);
    }
    else{
        console.log("no user");
    }
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
    const userID = req.session.userID;
    if (userID){
        console.log(userID);
    }
    else{
        console.log('no user');
    }
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
    let userID = req.session.userID;
    if (!userID){
        res.redirect('/accountloginsignup');
    }
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
    let userID = req.session.userID;
    if(!userID){
        res.redirect('/accountloginsignup')
    }
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

app.get('/accountloginsignup', (req, res) => {
    let scriptPath = "./webpages/accountloginsignup.php";
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

app.get('/sign-in', (req,res) => {
    let scriptPath = "./webpages/signinpage.php";
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
})

app.post('/accountlogout', (req,res)=>{
    const userID = req.session.userID;
    if (userID){
        req.session.destroy((err) => {
            if (err) {
                console.error('Error destroying session:', err);
                return res.status(500).send('Internal Server Error');
            }
            
            // Logout successful
            res.status(200).send('Logout successful');
        });
    }
    else{
        res.status(400).send('Logout Un-successful');
        
    }
})


app.post('/authenticate', (req,res) => {
    let scriptPath = "./webpages/authenticate.php";
    const username = req.body.username;
    const email = req.body.email;
    const password = req.body.password;
    console.log(username, email, password);
    const phpProcess = spawn('php', [scriptPath,email,password,username]);
    let authenticateResult = "";
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        authenticateResult += output;
        if(authenticateResult.includes("Invalid username, email, or password")){
            // console.log("authentication failed")
            res.redirect("/sign-in");
            return
        }
        if(authenticateResult.includes("Logged In:")){
            console.log(authenticateResult);
            const userID = authenticateResult.split(': ')[2].trim();
            req.session.userID = userID;
            res.redirect("/");
            return
        }
        
    });
    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

   
})

app.get('/forum/post', (req, res) => {
    let scriptPath = "./webpages/forum_posts.php";
    let forumId = req.query.forumId;

    try {
        forumId = parseInt(forumId, 10);
    } catch (error) {
        console.log("NaN");
    }
    const phpProcess = spawn('php', [scriptPath, forumId]);
    phpProcess.stdout.on('data', (data) => {
        res.write(data.toString());
    });

    phpProcess.stderr.on('data', (data) => {
        console.error(`stderr: ${data}`);
    });

    phpProcess.on('close', () => {
        // console.log(forumId);
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

app.post('/updateTeam', (req, res) => {
    let createTeamScriptPath = "./webpages/updateTeam.php";
    console.log("I am starting to update team")
    let userID = req.session.userID;
    if(!userID){
        res.redirect('/accountloginsignup')
    }
    let teamID = req.body.teamName;
    console.log(teamID, userID);
    let pmon1 = req.body.pokemon1;
    let pmon2 = req.body.pokemon2;
    let pmon3 = req.body.pokemon3;
    let pmon4 = req.body.pokemon4;
    let pmon5 = req.body.pokemon5;
    let pmon6 = req.body.pokemon6;
    console.log(pmon1, pmon2, pmon3, pmon4, pmon5, pmon6);

    const phpProcess = spawn('php', [createTeamScriptPath, pmon1, pmon2, pmon3, pmon4, pmon5, pmon6, teamID, userID]);
    let checkPokemon= "";
    console.log("I ran updateTeam");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful updated team")){
            console.log("Successful updated team")
            // let linkTeamToAccountPath = "./webpages/linkTeamToAccount.php";
            // const phpProcess2 = spawn('php', [linkTeamToAccountPath, teamID, userID]);
            // phpProcess2.stdout.on('data', (data) => {
            //     const output = data.toString().trim();
            //     checkPokemon += output;
            //     if(checkPokemon.includes("Successful updated team")){
                    res.redirect("/team");
            //     }
            // });
        }
        else if(checkPokemon.includes("Did not update team")){
            console.log("Did not update team");
            res.redirect("/team");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/team");
        }
    });
});



app.get('/createTeamForm', (req, res) => {
    let scriptPath = "./webpages/createTeamForm.php";
    let userID = req.session.userID;
    if(!userID){
        res.redirect('/accountloginsignup')
    }
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

app.post('/createTeam', (req, res) => {
    let createTeamScriptPath = "./webpages/createTeam.php";
    console.log("I am starting to create team")
    let userID = req.session.userID;
    if(!userID){
        res.redirect('/accountloginsignup')
    }
    let teamID = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for (let i = 0; i < 16; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        teamID += characters.charAt(randomIndex);
    }
    console.log(teamID, userID);
    let teamName = req.body.teamName;
    let pmon1 = req.body.pokemon1;
    let pmon2 = req.body.pokemon2;
    let pmon3 = req.body.pokemon3;
    let pmon4 = req.body.pokemon4;
    let pmon5 = req.body.pokemon5;
    let pmon6 = req.body.pokemon6;
    console.log(pmon1, pmon2, pmon3, pmon4, pmon5, pmon6);

    const phpProcess = spawn('php', [createTeamScriptPath, pmon1, pmon2, pmon3, pmon4, pmon5, pmon6, teamID, teamName]);
    let checkPokemon= "";
    console.log("I ran createTeam");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful created team")){
            console.log("Successful created team")
            let linkTeamToAccountPath = "./webpages/linkTeamToAccount.php";
            const phpProcess2 = spawn('php', [linkTeamToAccountPath,userID, teamID ]);
            console.log("I ran link team to account");
            let linkResult = "";
            phpProcess2.stdout.on('data', (data) => {
                const output = data.toString().trim();
                linkResult += output;
                if(linkResult.includes("Successful Account Link")){
                    console.log("Successful Account Link");
                    res.redirect("/team");
                }
            });
        }
        else if(checkPokemon.includes("Did not update team")){
            console.log("Did not update team");
            res.redirect("/team");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/team");
        }
    });
});

app.post('/process_comment', (req, res) => {
    let process_comment_path = "./webpages/process_comments.php";
    console.log("I am starting to Insert")
    let comment_title = req.body.commentTitle;
    let comment_body = req.body.commentInput;
    let parent_forum = req.body.currentForumID;

    const phpProcess = spawn('php', [process_comment_path, comment_title, comment_body, parent_forum]);
    let checkPokemon= "";
    console.log("I ran updateTeam");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful insert")){
            console.log("Successful insert")
            res.redirect("/forum/post?forumId=".concat(parent_forum));
        }
        else if(checkPokemon.includes("Did not insert")){
            console.log("Did not insert");
            res.redirect("/forum/post?forumId=".concat(parent_forum));
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/forum/post?forumId=".concat(parent_forum));
        }
    });
  });

app.post('/process_forum_post', (req, res) => {
    let process_forum_path = "./webpages/process_forum.php";
    console.log("I am starting to Insert")
    let post_title = req.body.post_title;
    let post_text = req.body.post_text;

    const phpProcess = spawn('php', [process_forum_path, post_title, post_text]);
    let checkPokemon= "";
    console.log("I ran updateTeam");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful insert")){
            console.log("Successful insert")
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("Did not insert")){
            console.log("Did not insert");
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/forum");
        }
    });
  });

app.post('/forum_liked', (req, res) => {
    let process_forum_path = "./webpages/likes.php";
    console.log("I am starting to Insert")
    let new_like_value = req.body.like_value;
    let which_value = req.body.which_value;

    const phpProcess = spawn('php', [process_forum_path, new_like_value, which_value]);
    let checkPokemon= "";
    console.log("I ran");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful")){
            console.log("Successful")
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("Did not insert")){
            console.log("Did not insert");
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/forum");
        }
    });
  });

app.post('/comment_liked', (req, res) => {
    let process_forum_path = "./webpages/likes.php";
    console.log("I am starting to Insert")
    let new_like_value = req.body.like_value;
    let which_value = req.body.which_value;

    const phpProcess = spawn('php', [process_forum_path, new_like_value, which_value]);
    let checkPokemon= "";
    console.log("I ran");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful")){
            console.log("Successful")
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("Did not insert")){
            console.log("Did not insert");
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/forum");
        }
    });
  });

app.post('/forum_page_like', (req, res) => {
    let process_forum_path = "./webpages/likes.php";
    console.log("I am starting to Insert")
    let new_like_value = req.body.like_value;
    let which_value = req.body.which_value;

    const phpProcess = spawn('php', [process_forum_path, new_like_value, which_value]);
    let checkPokemon= "";
    console.log("I ran");
    phpProcess.stdout.on('data', (data) => {
        const output = data.toString().trim();
        checkPokemon += output;
        if(checkPokemon.includes("Successful")){
            console.log("Successful")
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("Did not insert")){
            console.log("Did not insert");
            res.redirect("/forum");
        }
        else if(checkPokemon.includes("PDO failed")){
            console.log("PDO failed");
            res.redirect("/forum");
        }
    });
  });


const server = http.createServer(app);

server.listen(port, hostname, () => {
    console.log(`Server is running on http://localhost:${port}`);
});