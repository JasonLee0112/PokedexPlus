const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

const express = require('express');
const { spawn } = require('child_process');
const app = express();

app.get('/', (req, res) => {
    let scriptPath = "./index.php";
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

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});