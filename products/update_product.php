<?php
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE products SET price = '$price', quantity = '$quantity' WHERE product_id = $product_id";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success' role='alert'>Product updated successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger' role='alert'>Error: " . $conn->error . "</div>";
    }
} else {
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Product</h2>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form method="POST" action="update_product.php" class="col-md-8 mx-auto">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <div class="mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" id="price" name="price" class="form-control" value="<?php echo $product['price']; ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="<?php echo $product['quantity']; ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update Product</button>
                <a href="list_products.php" class="btn btn-secondary">Go Back</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
