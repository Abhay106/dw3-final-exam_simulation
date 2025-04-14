<?php

require_once 'db.php';

$db = new Database();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $userId = $_SESSION['user_id'];

    if (empty($name) || empty($price)) {
        $error = "Name and Price are required.";
    } elseif (!is_numeric($price) || $price < 0) {
        $error = "Price must be a valid positive number.";
    } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
        $error = "Image upload failed.";
    } else {
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileType = $_FILES['image']['type'];
        $fileSize = $_FILES['image']['size'];

        if (!in_array($fileType, $allowedTypes)) {
            $error = "Only JPG, JPEG, and PNG files are allowed.";
        } elseif ($fileSize > 2 * 1024 * 1024) {
            $error = "File size must be 2MB or less.";
        } else {
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $newFileName = uniqid('img_', true) . '.' . $ext;
            $targetPath = 'uploads/' . $newFileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $db->addProduct($name, $description, $price, $targetPath);
                $success = "Product added successfully.";
            } else {
                $error = "Failed to move uploaded file.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Add Product</h2>

    <?php if ($error || $success): ?>
    <div class="add-product-message <?= $error ? 'add-product-error' : 'add-product-success' ?>">
        <span><?= htmlspecialchars($error ?: $success) ?></span>
        <button class="add-product-close-btn" onclick="this.parentElement.style.display='none';">&times;</button>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Product Name" required><br>
    <textarea name="description" placeholder="Product Description"></textarea><br>
    <input type="number" step="0.01" name="price" placeholder="Price (e.g. 9.99)" required><br>
    <input type="file" name="image" accept=".jpg,.jpeg,.png" required><br>
    <button type="submit" class="form-container-button">Add Product</button>
   
    <button type="button" class="cancel-btn" onclick="window.location.href='dashboard.php';">Cancel</button>
</form>


</div>
</body>
</html>
