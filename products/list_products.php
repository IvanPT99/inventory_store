<?php
include '../includes/connection.php';

$message = '';
$alert_class = '';

if (isset($_GET['delete'])) {
    $product_id = $_GET['product_id'];
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        $message = "Product deleted successfully!";
        $alert_class = "alert-success";
    } else {
        $message = "Error deleting the product. Please try again.";
        $alert_class = "alert-danger";
    }
    $stmt->close();
}

$sql = "SELECT products.product_id, products.name, products.price, products.quantity, categories.name AS category 
        FROM products 
        JOIN categories ON products.category_id = categories.category_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Product List</h2>

        <?php if ($message): ?>
            <div class="alert <?php echo $alert_class; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Price ($)</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>{$row['category']}</td>
                                    <td class='text-center'>
                                        <a href='update_product.php?product_id={$row['product_id']}' class='btn btn-sm btn-warning me-2'>Update</a>
                                        <a href='?delete=true&product_id={$row['product_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No products found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="add_product.php" class="btn btn-success">Add New Product</a>
            <a href=".." class="btn btn-secondary ms-2">Back to Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    $conn->close();
    ?>

</body>

</html>