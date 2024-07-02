<?php
// popular_services.php
include 'config.php';

$query = "SELECT services.id, services.name, COUNT(appointments.id) AS service_count 
          FROM services
          LEFT JOIN appointments ON services.id = appointments.service_id
          GROUP BY services.id
          ORDER BY service_count DESC
          LIMIT 10";
$stmt = $pdo->query($query);
$services = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Popular Services</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Popular Services</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Service Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo $service['id']; ?></td>
                        <td><?php echo $service['name']; ?></td>
                        <td><?php echo $service['service_count']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
