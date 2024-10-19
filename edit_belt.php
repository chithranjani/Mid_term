<?php
require('dbinit.php');

if (!empty($_GET['id'])) {
    $belt_id = (int)$_GET['id'];
    $query = "SELECT * FROM belt WHERE BeltID = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'i', $belt_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $belt = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $belt_id = (int)$_POST['belt_id'];
    $belt_name = $_POST['belt_name'];
    $belt_material = $_POST['belt_material'];
    $belt_description = $_POST['belt_description'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    $query = "UPDATE belt SET BeltName = ?, BeltDescription = ?, QuantityAvailable = ?, Price = ?, BeltMaterial = ? WHERE BeltID = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, 'ssidsi', $belt_name, $belt_description, $quantity, $price, $belt_material, $belt_id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: view_belts.php');
        exit;
    } else {
        echo "<p>Error updating belt: " . mysqli_error($dbc) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Belt</title>
</head>
<body>
<header >
        <h1>Belt Admin Portal </h1>
    </header>
    <div class="container">
        <form class="form" action="edit_belt.php?id=<?php echo $belt_id; ?>" method="post">
            <div class="subtitle">Edit Belt</div>
            <input type="hidden" name="belt_id" value="<?php echo $belt['BeltID']; ?>">
            <div class="ic">
                <input type="text" class="input" name="belt_name" value="<?php echo $belt['BeltName']; ?>" required />
                <label for="belt_name" class="placeholder">Belt Name</label>
            </div>
            <div class="ic">
                <input type="text" class="input" name="belt_material" value="<?php echo $belt['BeltMaterial']; ?>" required />
                <label for="belt_material" class="placeholder">Belt Material</label>
            </div>
            <div class="ic">
                <textarea class="input" name="belt_description" required><?php echo $belt['BeltDescription']; ?></textarea>
                <label for="belt_description" class="placeholder">Belt Description</label>
            </div>
            <div class="ic">
                <input type="number" class="input" name="quantity" value="<?php echo $belt['QuantityAvailable']; ?>" required />
                <label for="quantity" class="placeholder">Quantity Available</label>
            </div>
            <div class="ic">
                <input type="number" step="0.01" class="input" name="price" value="<?php echo $belt['Price']; ?>" required />
                <label for="price" class="placeholder">Price</label>
            </div>
            <button type="submit" class="submit">Update Belt</button>
        </form>
    </div>
</body>
</html>
