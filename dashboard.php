<?php

require_once 'db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$db = new Database();
$products = $db->getAllProducts(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="dashboard-container">

        <div class="dashboard-header">
            <a href="add_product.php" class="add-product-btn">Add Product</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="dashboard-products">
            <?php if (empty($products)): ?>
                <div class="no-products-message">
                    <p>No products available.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="dashboard-card">
                        <div class="dashboard-top-row">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <img src="<?= htmlspecialchars($product['image_path']) ?>" alt="Product" class="dashboard-img">
                        </div>
                        <p><strong>Price: $<?= htmlspecialchars(number_format($product['price'], 2)) ?></strong></p>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <form action="delete_product.php" method="get" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button type="submit" class="dashboard-delete-btn">Delete</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

