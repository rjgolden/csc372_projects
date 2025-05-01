<?php

// Include the session script
require_once 'includes/session.php';

class MenuItem {

    private string $name;
    private string $description;
    private float $price;
    private bool $stock;

    public function __construct(string $name, string $description, float $price, bool $stock) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
    }
    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function checkInStock(): bool {
        return $this->stock;
    }

    public function displayItem(): void {
        echo "<div class=\"menu-item" . ($this->checkInStock() ? "" : " out-of-stock") . "\">";
        echo "<h3>" . $this->getName() . "</h3>";
        echo "<p>" . $this->getDescription() . "</p>";
        echo "<span>$" . number_format($this->getPrice(), 2) . "</span>";
        if (!$this->checkInStock()) {
            echo "<p class=\"stock-status\">Currently Unavailable</p>";
        }
        echo "</div>";
    }

    public function displayItemNP(): void {
        echo "<div class=\"menu-item" . ($this->checkInStock() ? "" : " out-of-stock") . "\">";
        echo "<h3>" . $this->getName() . "</h3>";
        if (!$this->checkInStock()) {
            echo "<p class=\"stock-status\">Currently Unavailable</p>";
        }
        echo "</div>";
    }
}

// Specialty Sandwiches
$item1 = new MenuItem("#1 The Rome", "Ham, soppressata, capicola, genoa salami, provolone cheese, lettuce, tomato, banana peppers, sliced red onions, finished off with a balsamic dressing.", 10.95, true);
$item2 = new MenuItem("#2 The Naples", "Breaded chicken or veal cutlet with a choice of marinara or pink vodka sauce topped with mozzarella or provolone cheese.", 10.95, true);
$item3 = new MenuItem("#3 The Parma", "Parma prosciutto with provolone cheese, sautéed broccoli rabe, red roasted peppers, finished with a balsamic dressing.", 10.95, true);
$item4 = new MenuItem("#4 The Florence", "Breaded eggplant with fresh mozzarella, baby greens, red roasted peppers, long stem artichokes, finished with a balsamic dressing.", 10.95, true);
$item5 = new MenuItem("#5 The Portofino", "Parma prosciutto with shaved pecorino romano arugula, lemon butter dressing, pickled red onions, basil pesto, finished with a balsamic glaze.", 10.95, true);
$item6 = new MenuItem("#6 The Milan", "Choice of breaded chicken cutlet or grilled chicken with shaved pecorino romano, sliced roma tomatoes, kalamata olives, arugula, lemon butter dressing, finished with a balsamic glaze.", 10.95, true);
$item7 = new MenuItem("#7 The Capri", "Fresh mozzarella with sliced roma tomatoes, finished with a basil pesto and balsamic glaze.", 9.95, false);
$item8 = new MenuItem("#8 The Pratella", "Choice of breaded chicken cutlet or grilled chicken with provolone cheese, sautéed broccoli rabe, red roasted peppers, finished with a balsamic dressing.", 10.95, true);
$item9 = new MenuItem("#9 The Venice", "Soppressata, capicola, genoa salami, provolone cheese, sautéed broccoli rabe, finished with a balsamic dressing.", 10.95, true);
$item10 = new MenuItem("#10 The Tuscany", "Choice of breaded chicken cutle or grilled chicken with fresh mozzarella, sautéed mushrooms, finished with a sun-dried tomato cream dressing.", 10.95, true);

// Hot Sandwiches
$item11 = new MenuItem("#11 Sausage & Rabe OR Pepper", "With provolone cheese.", 10.95, true);
$item12 = new MenuItem("#12 Eggplant Parm", "With provolone cheese", 9.95, true);
$item13 = new MenuItem("#13 Meatball Parm", "Choice of adding sausage. With provolone cheese.", 9.95, true);
$item14 = new MenuItem("#14 Chicken Bacon Ranch", "Choice of breaded chicken cutlet or grilled chicken with bacon, lettuce, tomatoes, finished off with a ranch dressing.", 10.95, true);
$item15 = new MenuItem("#15 Frittata", "Potato and onion frittata. With provolone cheese.", 9.95, true);
$item16 = new MenuItem("#16 Chicken Cutlet", "Choice of breaded chicken cutlet or grilled chicken with lettuce, tomatoes, and mayonnaise.", 10.95, true);

// Cold Sandiwches
$item17 = new MenuItem("#17 Chicken Salad", "Shredded white chicken with finely chopped celery, onions and mayonnaise. With lettuce and tomatoes.", 9.95, true);
$item18 = new MenuItem("#18 Tuna Salad", "Choice of Italian tuna salad or traditional style (mayonnaise). With lettuce and tomatoes.", 9.95, true);
$item19 = new MenuItem("#19 Ham Sandwich", "Ham, American cheese, lettuce, tomatoes, and mayonnaise.", 9.95, true);
$item20 = new MenuItem("#20 Turkey Sandwich", "Turkey, American cheese, lettuce, tomatoes, and mayonnaise.", 9.95, true);
$item21 = new MenuItem("#21 Turkey & Rabe", "Turkey, sharp provolone, sautéed broccoli rabe, finished off with a balsamic dressing.", 10.95, true);

// Salads
$item22 = new MenuItem("House Salad", "A bed of mixed greens topped with cucumbers, cherry tomatoes, carrots, red onions, hand a side of balsamic dressing. (Small)", 3.99, true);
$item23 = new MenuItem("Caesar Salad", "A bed of romaine lettuce topped with shaved pecorino romano, house-made croutons, and a side of caesar dressing. (Small)", 3.99, true);
$item24 = new MenuItem("Greek Salad", "A bed of romaine lettuce topped with kalamata olives, cherry tomatoes, red onion, cucumber, feta cheese, and a side of greek dressing. (Small)", 4.99, true);

// Soups
$item25 = new MenuItem("Chicken soup", "", 3.99, true);
$item26 = new MenuItem("Pasta E Fagioli", "", 3.99, true);
$item27 = new MenuItem("Escarol & Beans", "", 3.99, false);
$item28 = new MenuItem("Lentil Soup", "", 3.99, true);
$item29 = new MenuItem("Minestrone Soup", "", 3.99, false);
$item30 = new MenuItem("Chili", "", 3.99, false);

// Coffee 
$item31 = new MenuItem("Hot Coffee", "", 3.99, true);
$item32 = new MenuItem("Iced Coffee", "", 3.99, true);
$item33 = new MenuItem("Lattes", "", 3.99, true);
$item34 = new MenuItem("Cappucino", "", 3.99, true);
$item35 = new MenuItem("Espresso Shots", "", 3.99, true);

// Desserts
$item36 = new MenuItem("Wine Biscuits", "", 3.99, true);
$item37 = new MenuItem("Ricotta Cookies", "", 3.99, true);
$item38 = new MenuItem("Chocolate Cake", "", 3.99, true);
$item39 = new MenuItem("Carrot Cake", "", 3.99, true);
$item40 = new MenuItem("Sfogliatella", "", 3.99, true);
$item41 = new MenuItem("Cannoli", "", 3.99, true);
$item42 = new MenuItem("Tiramisu", "", 3.99, true);
$item43 = new MenuItem("Various Cookies", "", 3.99, true);
$item44 = new MenuItem("Various Biscotti", "", 3.99, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste of Italy - Johnston, RI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleSheet.css">
    <style>
        .out-of-stock {
            opacity: 0.7;
        }
        .stock-status {
            color: #dc3545;
            font-style: italic;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160">
            </a>
            <h1 class = "title"> Taste of Italy • Deli & Caffè </h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="specials.php">Prepared Foods</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="social.php">Social Media</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $logged_in ? 'logout.php' : 'login.php' ?>"><?= $logged_in ? 'Log Out' : 'Log In' ?></a></li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Menu Section -->
    <section class="container py-5" id="menu">
        <h2 class="menu2">Our Menu</h2>
        <br>
        
        <!-- Specialty Section -->
        <h2 class = "menu" id="specialty"> Specialty Sandwiches </h2>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item1->displayItem();
                    $item2->displayItem();
                    $item3->displayItem();
                    $item4->displayItem();
                    $item5->displayItem();
                ?>
            </div>
            <div class="col-md-6">
                <?php
                    $item6->displayItem();
                    $item7->displayItem();
                    $item8->displayItem();
                    $item9->displayItem();
                    $item10->displayItem();
                ?>
            </div>
        </div>
        <p> <br> </p>

        <!-- Hot Section -->
        <h2 class="menu" id="hot">Hot Sandwiches</h2>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item11->displayItem();
                    $item12->displayItem();
                    $item13->displayItem();
                ?>
            </div>
            <div class="col-md-6">
                <?php
                    $item14->displayItem();
                    $item15->displayItem();
                    $item16->displayItem(); 
                ?>
            </div>
        </div>
        <p> <br> </p>
        
        <!-- Cold Section -->
        <h2 class="menu" id="cold">Cold Sandwiches</h2>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item17->displayItem();
                    $item18->displayItem();
                    $item19->displayItem();
                ?>
            </div>
            <div class="col-md-6">
                <?php
                    $item20->displayItem();
                    $item21->displayItem();
                ?>
            </div>
        </div>
        <p class = "disclaimerFont"> All sandwiches are one size. <br> All sandwiches available on white or wheat wraps. </p>
        <p> <br> </p>

         <!-- Salad Section -->
         <h2 class="menu" id="salads">Salads</h2>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item22->displayItem();
                    $item23->displayItem();
                ?>
            </div>
            <div class="col-md-6">
                <?php
                    $item24->displayItem();
                ?>
            </div>
        </div>
        <p> <br> </p>

        <!-- Soup Section -->
        <h2 class="menu" id="soups">Soups</h2>
        <p class = "disclaimerFont"> Soups vary daily. </p>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item25->displayItemNP();
                    $item26->displayItemNP();
                    $item27->displayItemNP();
                    $item28->displayItemNP();
                    $item29->displayItemNP();
                    $item30->displayItemNP();
                ?>
            </div>
        </div>
        <p> <br> </p>

        <!-- Coffee Section -->
        <h2 class="menu" id="coffee">Coffee</h2>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item31->displayItemNP();
                    $item32->displayItemNP();
                    $item33->displayItemNP();
                    $item34->displayItemNP();
                    $item35->displayItemNP();
                ?>
            </div>
        </div>
        <p> <br> </p>

         <!-- Desserts Section -->
        <h2 class="menu" id="desserts">Desserts</h2>
        <p class = "disclaimerFont"> Desserts vary weekly. </p>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item36->displayItemNP();
                    $item37->displayItemNP();
                    $item38->displayItemNP();
                    $item39->displayItemNP();
                    $item40->displayItemNP();
                ?>
            </div>
            <div class="col-md-6">
                <?php
                    $item41->displayItemNP();
                    $item42->displayItemNP();
                    $item43->displayItemNP();
                    $item44->displayItemNP();
                ?>
            </div>
        </div>
        <p> <br> </p>

    </section>

    <p class = "disclaimerFont"> Visit our 'Contact Us' Page if you have any questions/comments! </p>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>© 2025 Taste of Italy. All rights reserved.</p>
            <p>123 Main Street, Johnston, RI 02919 | (401) 555-0123</p>
            <img src = "images/Logo2.png" alt="Taste of Italy Logo 2" width = "120" height = "80">
        </div>
    </footer>

     <!-- Script for Smooth Loading Effects -->
     <script src="js/jQuery.js"></script>
     <script src="js/smooth.js"></script>

</body>
</html>
