const express = require('express');
const { engine } = require('express-handlebars');
const path = require('path');
const app = express();
const port = 1337;

// Configure Handlebars view engine
app.engine('handlebars', engine({
    defaultLayout: 'main',
    layoutsDir: path.join(__dirname, 'views/layouts')
}));
app.set('view engine', 'handlebars');
app.set('views', path.join(__dirname, 'views'));

// Serve static files
app.use(express.static('public'));
app.use(express.static('public/images'));
app.use(express.static('public/css'));
app.use(express.static('public/js'));

// Routes
app.get('/', function(request, response) {
    response.render('index');
});

app.get('/menu', function(request, response) {
    response.render('menu');
});

app.get('/contact', function(request, response) {
    response.render('contact');
});

app.get('/social', function(request, response) {
    response.render('social');
});

app.get('/specials', function(request, response) {
    response.render('specials');
});

// 404 with wildcard
app.get('*', function(request, response) {
    response.status(404).render('404');
});

app.listen(port, function() {
    console.log('Listening on http://localhost:' + port + ' press ctrl+c to quit');
});