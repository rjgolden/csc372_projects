<?php
// Include database connection
require_once 'includes/session.php';

// Redirect if not logged in
require_login($logged_in);

// Initialize variables
$error_message = '';
$success_message = '';
$edit_id = null;
$item_name = '';
$item_description = '';
$item_price = '';

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $item_name = isset($_POST['item_name']) ? trim($_POST['item_name']) : '';
    $item_description = isset($_POST['item_description']) ? trim($_POST['item_description']) : '';
    $item_price = isset($_POST['item_price']) ? trim($_POST['item_price']) : '';
    
    // Validate input
    if (empty($item_name) || empty($item_price)) {
        $error_message = "Name and price are required fields.";
    } elseif (!is_numeric($item_price) || $item_price <= 0) {
        $error_message = "Price must be a positive number.";
    } else {
        try {
            // Add new item
            if (isset($_POST['add'])) {
                $sql = "INSERT INTO menuItems (name, description, price) VALUES (?, ?, ?)";
                $stmt = pdo($pdo, $sql, [$item_name, $item_description, $item_price]);
                
                if ($stmt) {
                    $success_message = "Menu item added successfully!";
                    // Clear form fields
                    $item_name = '';
                    $item_description = '';
                    $item_price = '';
                } else {
                    $error_message = "Failed to add menu item.";
                }
            }
            
            // Update existing item
            if (isset($_POST['update']) && isset($_POST['item_id'])) {
                $item_id = $_POST['item_id'];
                $sql = "UPDATE menuItems SET name = ?, description = ?, price = ? WHERE id = ?";
                $stmt = pdo($pdo, $sql, [$item_name, $item_description, $item_price, $item_id]);
                
                if ($stmt) {
                    $success_message = "Menu item updated successfully!";
                    // Clear form fields
                    $item_name = '';
                    $item_description = '';
                    $item_price = '';
                    $edit_id = null;
                } else {
                    $error_message = "Failed to update menu item.";
                }
            }
            
            // Delete item
            if (isset($_POST['delete']) && isset($_POST['item_id'])) {
                $item_id = $_POST['item_id'];
                $sql = "DELETE FROM menuItems WHERE id = ?";
                $stmt = pdo($pdo, $sql, [$item_id]);
                
                if ($stmt) {
                    $success_message = "Menu item deleted successfully!";
                } else {
                    $error_message = "Failed to delete menu item.";
                }
            }
        } catch (PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
        }
    }
}

// Load item for editing
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    try {
        $sql = "SELECT * FROM menuItems WHERE id = ? LIMIT 1";
        $stmt = pdo($pdo, $sql, [$edit_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($item) {
            $item_name = $item['name'];
            $item_description = $item['description'];
            $item_price = $item['price'];
        } else {
            $error_message = "Item not found.";
            $edit_id = null;
        }
    } catch (PDOException $e) {
        $error_message = "Database error: " . $e->getMessage();
        $edit_id = null;
    }
}

// Fetch all menu items
try {
    $sql = "SELECT * FROM menuItems ORDER BY name";
    $menu_items = pdo($pdo, $sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_message = "Failed to load menu items: " . $e->getMessage();
    $menu_items = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taste of Italy - Menu Management</title>
    <link rel="stylesheet" href="css/styleSheet.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Press Start 2P">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .menu-form {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }
        .menu-list {
            margin-top: 30px;
        }
        .success-message {
            color: green;
            padding: 10px;
            background-color: #e8f5e9;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .error-message {
            color: red;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-btn {
            display: inline-block;
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        .delete-btn {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-left">
            <div class="logo">
                <a class="navbar-brand" href="index.php">
                <img src="images/Logo1.png" alt="Taste of Italy Logo" width="160" height="160">
                </a>
            </div>
        </div>
    </header>

    <div id="content" class="animate-bottom">
        <h1>Menu Item Management</h1>
        <hr />
        <br />

        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($success_message)): ?>
            <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
        <?php endif; ?>

        <div class="menu-form">
            <h2><?php echo $edit_id ? 'Edit Menu Item' : 'Add New Menu Item'; ?></h2>
            <form method="POST" action="menu_manage.php">
                <?php if ($edit_id): ?>
                    <input type="hidden" name="item_id" value="<?php echo $edit_id; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="item_name">Item Name:</label>
                    <input type="text" id="item_name" name="item_name" value="<?php echo htmlspecialchars($item_name); ?>" required>
                </div>
                <br>
                
                <div class="form-group">
                    <label for="item_description">Description:</label>
                    <textarea id="item_description" name="item_description" rows="3"><?php echo htmlspecialchars($item_description); ?></textarea>
                </div>
                <br>
                
                <div class="form-group">
                    <label for="item_price">Price ($):</label>
                    <input type="number" id="item_price" name="item_price" step="0.01" value="<?php echo htmlspecialchars($item_price); ?>" required>
                </div>
                <br>
                
                <?php if ($edit_id): ?>
                    <button type="submit" name="update">Update Item</button>
                    <a href="menu_manage.php" class="button">Cancel</a>
                <?php else: ?>
                    <button type="submit" name="add">Add Item</button>
                <?php endif; ?>
            </form>
        </div>

        <div class="menu-list">
            <h2>Current Menu Items</h2>
            
            <?php if (empty($menu_items)): ?>
                <p>No menu items found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menu_items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo htmlspecialchars($item['description']); ?></td>
                                <td>$<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                                <td>
                                    <a href="menu_manage.php?edit=<?php echo $item['id']; ?>" class="action-btn">Edit</a>
                                    <form method="POST" action="menu_manage.php" style="display:inline;">
                                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" name="delete" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>