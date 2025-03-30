const express = require('express');
const app = express();
const port = 1337;
const dir = __dirname + '/public/';

// look for static files to be served in these directories
app.use(express.static('public'));
app.use(express.static('public/images'));
app.use(express.static('public/css'));
app.use(express.static('public/js'));

// index.html
app.get('/', function(request, response) {
    response.sendFile(dir + 'index.html');
});

// menu.html
app.get('/menu', function(request, response) {
    response.sendFile(dir + 'menu.html');
});

// contact.html
app.get('/contact', function(request, response) {
    response.sendFile(dir + 'contact.html');
});

// social.html
app.get('/social', function(request, response) {
    response.sendFile(dir + 'social.html');
});

// specials.html
app.get('/specials', function(request, response) {
    response.sendFile(dir + 'specials.html');
});

// 404.html with wildcard
app.get('*', function(request, response) {
    response.sendFile(dir + '404.html');
});

app.listen(port, function() {
    console.log('Listening on http://localhost:' + port + ' press ctrl+c to quit');
});