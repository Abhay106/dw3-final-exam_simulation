<?php
require_once 'db.php';


$message = "";
$success = false;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $productId = (int)$_GET['id'];
    $db = new Database();

    // Get product info
    $stmt = $db->conn->prepare("SELECT image_path FROM products WHERE id = ? AND user_id = ?");
    $stmt->execute([$productId, $_SESSION['user_id']]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $imagePath = $product['image_path'];

        // Delete product from DB
        $deleteStmt = $db->conn->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
        if ($deleteStmt->execute([$productId, $_SESSION['user_id']])) {
            // Delete image file if exists
            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }
            $message = "Product deleted successfully.";
            $success = true;
        } else {
            $message = "Error deleting product from database.";
        }
    } else {
        $message = "Product not found or unauthorized.";
    }
} else {
    $message = "Invalid request.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="delete-message <?= $success ? 'delete-success' : 'delete-error' ?>">
        <p><?= htmlspecialchars($message) ?></p>
        <?php if (!$success): ?>
            <a href="delete_product.php?id=<?= isset($productId) ? $productId : '' ?>" class="delete-btn">Retry</a>
        <?php endif; ?>
        <a href="dashboard.php" class="dashboard-btn">Go to Dashboard</a>
    </div>
</body>
</html>
