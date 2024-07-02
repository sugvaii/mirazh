<?php
// services.php
include 'config.php';

$query = "SELECT id, name, description, price FROM services";
$stmt = $pdo->query($query);
$services = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services List</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Services List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo $service['id']; ?></td>
                        <td><?php echo $service['name']; ?></td>
                        <td><?php echo $service['description']; ?></td>
                        <td><?php echo $service['price']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
