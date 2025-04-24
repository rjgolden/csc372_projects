<?php
try {
    // Set connection timeout to help diagnose slow connections
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5, // 5 second timeout
    ];
    
    $pdo = new PDO(
        "mysql:host=192.185.2.183;dbname=ryangold_clientDatabase;port=3306;charset=utf8mb4",
        "ryangold_client2",
        "ryan041500",
        $options
    );
    
    echo "Connected Successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    // Print more details about the error
    echo "<br>Error code: " . $e->getCode();
}