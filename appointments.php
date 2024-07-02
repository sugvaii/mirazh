<?php
// appointments.php
include 'config.php';

$date = $_GET['date'] ?? date('Y-m-d');

$query = "SELECT clients.id, clients.name, clients.email, clients.phone 
          FROM appointments
          JOIN clients ON appointments.client_id = clients.id
          WHERE appointments.date = :date";
$stmt = $pdo->prepare($query);
$stmt->execute(['date' => $date]);
$clients = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments on <?php echo $date; ?></title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Appointments on <?php echo $date; ?></h1>
        <form method="get" action="appointments.php">
            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" value="<?php echo $date; ?>">
            <button type="submit">Show</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['name']; ?></td>
                        <td><?php echo $client['email']; ?></td>
                        <td><?php echo $client['phone']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
