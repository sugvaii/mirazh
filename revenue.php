<?php
// revenue.php
include 'config.php';

$start_date = $_GET['start_date'] ?? date('Y-m-01');
$end_date = $_GET['end_date'] ?? date('Y-m-t');

$query = "SELECT SUM(services.price) AS total_revenue 
          FROM appointments
          JOIN services ON appointments.service_id = services.id
          WHERE appointments.date BETWEEN :start_date AND :end_date";
$stmt = $pdo->prepare($query);
$stmt->execute(['start_date' => $start_date, 'end_date' => $end_date]);
$total_revenue = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Total Revenue</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Total Revenue</h1>
        <form method="get" action="revenue.php">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>">
            
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>">
            
            <button type="submit">Show</button>
        </form>
        <h2>Total Revenue: $<?php echo number_format($total_revenue, 2); ?></h2>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
