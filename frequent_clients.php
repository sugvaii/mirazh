<?php
// frequent_clients.php
include 'config.php';

$min_visits = $_GET['min_visits'] ?? 5;

$query = "SELECT clients.id, clients.name, clients.email, clients.phone, COUNT(appointments.id) AS visit_count
          FROM clients
          JOIN appointments ON clients.id = appointments.client_id
          GROUP BY clients.id
          HAVING visit_count >= :min_visits
          ORDER BY visit_count DESC";
$stmt = $pdo->prepare($query);
$stmt->execute(['min_visits' => $min_visits]);
$clients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Frequent Clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Frequent Clients</h1>
        <form method="get" action="frequent_clients.php">
            <label for="min_visits">Minimum Visits:</label>
            <input type="number" name="min_visits" id="min_visits" value="<?php echo $min_visits; ?>">
            <button type="submit">Show</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Visit Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['name']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                        <td><?php echo $client['phone']; ?></td>
                        <td><?php echo $client['visit_count']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
                    