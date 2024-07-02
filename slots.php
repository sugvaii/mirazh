<?php
// slots.php
include 'config.php';

$date = $_GET['date'] ?? date('Y-m-d');
$service_id = $_GET['service_id'] ?? 1;

$query = "SELECT slots.id, slots.time, slots.is_available 
          FROM slots
          WHERE slots.date = :date AND slots.service_id = :service_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['date' => $date, 'service_id' => $service_id]);
$slots = $stmt->fetchAll();

$query_services = "SELECT id, name FROM services";
$stmt_services = $pdo->query($query_services);
$services = $stmt_services->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Available Slots</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Available Slots on <?php echo $date; ?></h1>
        <form method="get" action="slots.php">
            <label for="date">Select Date:</label>
            <input type="date" name="date" id="date" value="<?php echo $date; ?>">
            
            <label for="service_id">Select Service:</label>
            <select name="service_id" id="service_id">
                <?php foreach ($services as $service): ?>
                    <option value="<?php echo $service['id']; ?>" <?php echo $service['id'] == $service_id ? 'selected' : ''; ?>>
                        <?php echo $service['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit">Show</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Is Available</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slots as $slot): ?>
                    <tr>
                        <td><?php echo $slot['id']; ?></td>
                        <td><?php echo $slot['time']; ?></td>
                        <td><?php echo $slot['is_available'] ? 'Yes' : 'No'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
