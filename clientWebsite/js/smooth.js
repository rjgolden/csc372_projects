// Immediately set body opacity to 0
document.body.style.opacity = '0';

$(document).ready(function() {
  // Cache jQuery selections
  const $cache = {
    body: $('body')
  };
  
  // Set opacity to 0 again to ensure it's applied
  $cache.body.css('opacity', '0');
  
  // Use a small delay to ensure the opacity change is registered
  setTimeout(function() {
    $cache.body.animate({ opacity: 1 }, 600);
  }, 10);

});