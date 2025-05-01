// Cache jQuery selections
const $cache = {
  specialsContent: $('#specialsContent')
};

// 1. XMLHttpRequest for HTML
function loadSpecialsHTML() {
  console.log("Loading HTML specials");
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      $cache.specialsContent.append(this.responseText);
    } else if (this.readyState === 4) {
      console.error("Error loading HTML specials:", this.status);
    }
  };
  xhr.open("GET", "ajax/prepared.html", true);
  xhr.send();
}

// 2. XMLHttpRequest for XML
function loadSpecialsXML() {
  console.log("Loading XML specials");
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      const xmlDoc = this.responseXML;
      const specials = xmlDoc.getElementsByTagName("special");
      let html = "";
      
      for (let i = 0; i < specials.length; i++) {
        const name = specials[i].getElementsByTagName("name")[0].childNodes[0].nodeValue;
        const price = specials[i].getElementsByTagName("price")[0].childNodes[0].nodeValue;
        
        html += `<div class="menu-item">
                  <h3>${name}</h3>
                  <span class="price">$${price}</span>
                </div>`;
      }
      
      $cache.specialsContent.append(html);
    } else if (this.readyState === 4) {
      console.error("Error loading XML specials:", this.status);
    }
  };
  xhr.open("GET", "ajax/prepared.xml", true);
  xhr.send();
}

// 3. XMLHttpRequest for JSON
function loadSpecialsJSON() {
  console.log("Loading JSON specials");
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      const specials = JSON.parse(this.responseText);
      let html = "";
      
      specials.forEach(special => {
        html += `<div class="menu-item">
                  <h3>${special.name}</h3>
                  ${special.description ? `<p>${special.description}</p>` : ''}
                  <span class="price">$${special.price}</span>
                </div>`;
      });

      $cache.specialsContent.append(html);
    } else if (this.readyState === 4) {
      console.error("Error loading JSON specials:", this.status);
    }
  };
  xhr.open("GET", "ajax/prepared.json", true);
  xhr.send();
}

// 4. jQuery AJAX for HTML
function loadSpecialsWithJQuery() {
  console.log("Loading specials with jQuery");
  $.get("ajax/prepared.html")
    .done(function(result) {
      $cache.specialsContent.append(result);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      console.error("jQuery AJAX error:", textStatus, errorThrown);
    });
}

// Document ready function
$(document).ready(function() {
  console.log("Document ready - initializing specials page");
  
  // Create a single container with a simple layout
  $('#specialsContent').html(`
    <div class="container">
      <div class="row" id="specialsContent">
        <!-- Menu items will be loaded here -->
      </div>
    </div>
  `);
  
  // Update the cache reference
  $cache.specialsContent = $('#specialsContent');
  
  // Add some CSS for better styling
  $('<style>')
    .html(`
      .menu-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 20px;
        margin-bottom: 10px;
        border-bottom: 1px solid #eee;
        width: 100%;
      }
      .menu-item h3 {
        margin: 0;
        font-size: 18px;
      }
      .price {
        font-weight: bold;
        font-size: 16px;
      }
    `)
    .appendTo('head');
  
  // Load all data sources immediately
  loadSpecialsHTML();
  loadSpecialsXML();
  loadSpecialsJSON();
  loadSpecialsWithJQuery();
});
