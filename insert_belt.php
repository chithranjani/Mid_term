<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Insert Belt</title>
    </head>
    <body>
    <header >
        <h1>Belt Admin Portal </h1>
    </header>
    <div class="container">
        <form class="form" action="insert_belt.php" method="post" id="belt_insert_form">
            <div class="subtitle">Add a New Belt</div>
            <div class="ic">
                <input type="text" class="input" id="belt_name" name="belt_name" required />
                <label for="belt_name" class="placeholder">Belt Name</label>
            </div>
            <div class="ic">
                <input type="text" class="input" id="belt_material" name="belt_material" required />
                <label for="belt_material" class="placeholder">Belt Material</label>
            </div>
            <div class="ic">
                <textarea class="input" id="belt_description" name="belt_description" required></textarea>
                <label for="belt_description" class="placeholder">Belt Description</label>
            </div>
            <div class="ic">
                <input type="number" class="input" id="quantity" name="quantity" required />
                <label for="quantity" class="placeholder">Quantity Available</label>
            </div>
            <div class="ic">
                <input type="number" step="0.01" class="input" id="price" name="price" required />
                <label for="price" class="placeholder">Price</label>
            </div>
            
            <button type="submit" class="submit">Insert Belt info</button>
        </form>
        <a href="view_belts.php"> View Belt Table</a>
    </div>
    </body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('dbinit.php');

    $belt_name = !empty($_POST['belt_name']) ? $_POST['belt_name'] : null;
    $belt_description = !empty($_POST['belt_description']) ? $_POST['belt_description'] : null;
    $quantity = !empty($_POST['quantity']) ? (int) $_POST['quantity'] : null;
    $price = !empty($_POST['price']) ? (float) $_POST['price'] : null;
    $belt_material = !empty($_POST['belt_material']) ? $_POST['belt_material'] : null;

    if ($belt_name && $belt_description && $quantity && $price && $belt_material) {
        $product_added_by = 'Chithranjani Jessy Ramesh'; 

        $query = "INSERT INTO belt (BeltName, BeltDescription, QuantityAvailable, Price, ProductAddedBy, BeltMaterial)
          VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($dbc, $query);
mysqli_stmt_bind_param($stmt, 'ssidss', $belt_name, $belt_description, $quantity, $price, $product_added_by, $belt_material);

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header('Location: view_belts.php');
            exit;
        } else {
            echo "<p>Error inserting belt into the database: " . mysqli_error($dbc) . "</p>";
        }
    } else {
        echo "<p>All fields are required.</p>";
    }
}
?>