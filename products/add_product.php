<?php
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category_id = $_POST['category_id'];

    $sql = "INSERT INTO products (name, description, price, quantity, category_id) 
            VALUES ('$name', '$description', '$price', '$quantity', '$category_id')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Product added successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    } else {
        $message = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error: " . $conn->error . "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
    }
}

$sql_categories = "SELECT * FROM categories";
$categories_result = $conn->query($sql_categories);
if ($categories_result->num_rows == 0) {
    $category_error = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        No categories found in the database. Please add categories first.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Product</h2>

        <!-- Display success or error message -->
        <?php
        if (isset($message)) {
            echo $message;
        }
        if (isset($category_error)) {
            echo $category_error;
        }
        ?>

        <form method="POST" action="add_product.php">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control form-control-sm" required>
                    </div>

                    <div class="mb-2">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" step="0.01" class="form-control form-control-sm"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2 h-100 d-flex flex-column">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" class="form-control form-control-sm flex-grow-1"
                            rows="4" required></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control form-control-sm"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-select form-select-sm" required>
                            <?php
                            if ($categories_result->num_rows > 0) {
                                while ($row = $categories_result->fetch_assoc()) {
                                    echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No categories available</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-success px-4 py-2">Add Product</button>
                <a href=".." class="btn btn-secondary px-4 py-2">Go Back</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
