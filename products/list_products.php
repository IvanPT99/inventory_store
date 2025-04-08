<?php
include '../includes/connection.php';

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
                                        <a href='delete_product.php?product_id={$row['product_id']}' class='btn btn-sm btn-danger'>Delete</a>
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
</body>
</html>
