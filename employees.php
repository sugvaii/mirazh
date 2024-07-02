<?php
// employees.php
include 'config.php';

$start_date = $_GET['start_date'] ?? date('Y-m-01');
$end_date = $_GET['end_date'] ?? date('Y-m-t');

$query = "SELECT employees.id, employees.name, COUNT(appointments.id) AS services_count 
          FROM employees
          LEFT JOIN appointments ON employees.id = appointments.employee_id
          WHERE appointments.date BETWEEN :start_date AND :end_date
          GROUP BY employees.id";
$stmt = $pdo->prepare($query);
$stmt->execute(['start_date' => $start_date, 'end_date' => $end_date]);
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees Services Count</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Employees Services Count</h1>
        <form method="get" action="employees.php">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>">
            
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>">
            
            <button type="submit">Show</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Services Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo $employee['name']; ?></td>
                        <td><?php echo $employee['services_count']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
