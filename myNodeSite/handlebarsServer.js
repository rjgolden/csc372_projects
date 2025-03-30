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

// Test route to trigger a 500 error
app.get('/trigger-error', function(request, response, next) {
    // Create an error and pass it to the next middleware
    const error = new Error('This is a test error');
    next(error);
});

// 404 handler - must be BEFORE the error handler
app.use(function(request, response, next) {
    response.status(404).render('404');
});

// 500 error handler - must be AFTER routes and 404 handler
app.use(function(err, request, response, next) {
    console.error('Server Error:', err);
    response.status(500).render('500');
});

app.listen(port, function() {
    console.log('Listening on http://localhost:' + port + ' press ctrl+c to quit');
});