// Store restaurant location
const restaurantLocation = { lat: 41.8156, lng: -71.4945 }; // Coordinates for 1302 Atwood Ave, Johnston, RI
let userLocation = null;
let map;
let directionsService;
let directionsRenderer;

// Cache jQuery selections
const $cache = {
  map: $('#map'),
  findDirections: $('#findDirections')
};

// Initialize map
function initMap() {
  // Create a map centered on the restaurant
  map = new google.maps.Map($cache.map[0], {
    zoom: 14,
    center: restaurantLocation,
  });
  
  // Add a marker for the restaurant
  const marker = new google.maps.Marker({
    position: restaurantLocation,
    map: map,
    title: "Taste of Italy • Deli & Caffè",
    animation: google.maps.Animation.DROP
  });
  
  // Add info window for the restaurant
  const infoWindow = new google.maps.InfoWindow({
    content: "<strong>Taste of Italy • Deli & Caffè</strong><br>1302 Atwood Avenue<br>Johnston, RI 02919"
  });
  
  marker.addListener("click", () => {
    infoWindow.open(map, marker);
  });
  
  // Initialize the directions service and renderer
  directionsService = new google.maps.DirectionsService();
  directionsRenderer = new google.maps.DirectionsRenderer({
    map: map,
    panel: $cache.map[0]
  });
  
  // Add click listener to the directions button
  $cache.findDirections.on("click", getUserLocation);
}

// Get user's current location
function getUserLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        userLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        // Calculate and display route
        calculateAndDisplayRoute();
      },
      (error) => {
        console.error("Error getting user location:", error);
        alert("Unable to get your location. Please check your browser permissions.");
      }
    );
  } else {
    alert("Geolocation is not supported by your browser.");
  }
}

// Calculate and display route between user and restaurant
function calculateAndDisplayRoute() {
  if (!userLocation) return;
  
  directionsService.route(
    {
      origin: userLocation,
      destination: restaurantLocation,
      travelMode: google.maps.TravelMode.DRIVING,
    },
    (response, status) => {
      if (status === "OK") {
        directionsRenderer.setDirections(response);
      } else {
        alert("Directions request failed due to " + status);
      }
    }
  );
}