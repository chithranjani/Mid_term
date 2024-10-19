<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Belt Inventory</title>
</head>
<body>
<header >
        <h1>Belt Admin Portal </h1>
    </header>
    <div class="container">
        <h1 class="title">Belt Inventory</h1>
        
        <?php
        require('dbinit.php');

        if (!empty($_GET['id'])) {
            $belt_id = (int)$_GET['id'];

            $query = "DELETE FROM belt WHERE BeltID = ?";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, 'i', $belt_id);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                header('Location: view_belts.php'); 
                exit;
            } else {
                echo "<p>Error deleting belt: " . mysqli_error($dbc) . "</p>";
            }
        }
        ?>

        <table class="belt-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Belt Material</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Product Added By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $query = "SELECT * FROM belt";
                $result = mysqli_query($dbc, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['BeltID']}</td>";
                    echo "<td>{$row['BeltName']}</td>";
                    echo "<td>{$row['BeltDescription']}</td>";
                    echo "<td>{$row['BeltMaterial']}</td>";
                    echo "<td>{$row['QuantityAvailable']}</td>";
                    echo "<td>\${$row['Price']}</td>";
                    echo "<td>{$row['ProductAddedBy']}</td>";
                    echo "<td>
                            <a class='action-link' href='edit_belt.php?id={$row['BeltID']}'>Edit</a> |
                            <a class='action-link' href='view_belts.php?id={$row['BeltID']}'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        
        <a href="insert_belt.php">Add new Belt</a>
    </div>
</body>
</html>
