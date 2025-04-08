<?php

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
}

// Create menu items
$item1 = new MenuItem("Italian Grinder", "Assortment of cold cuts on fresh baked bread", 12.99, true);
$item2 = new MenuItem("Meatball Sub", "Homemade meatballs and fresh baked bread", 10.99, true);
$item3 = new MenuItem("Fish n Chips", "Lightly battered fish served with fries and cole slaw", 15.99, false);
$item4 = new MenuItem("Chicken Parmesan", "Breaded chicken cutlet with marinara and melted cheese", 13.99, true);

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
            <a class="navbar-brand" href="#">
                <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160">
            </a>
            <h1 class = "title"> Taste of Italy • Deli & Caffè </h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="specials.html">Specials</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="social.html">Social Media</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Menu Section -->
    <section class="container py-5" id="menu">
        <h2 class="menu">Our Menu</h2>
        <div class="row">
            <div class="col-md-6">
                <?php
                    $item1->displayItem();
                    $item2->displayItem();
                ?>
            </div>
            <div class="col-md-6">
                <?php
                    $item3->displayItem();
                    $item4->displayItem();
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>© 2025 Taste of Italy. All rights reserved.</p>
            <p>123 Main Street, Johnston, RI 02919 | (401) 555-0123</p>
            <img src = "images/Logo2.png" alt="Taste of Italy Logo 2" width = "120" height = "80">
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>