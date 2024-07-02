<?php
// masters.php
include 'config.php';

$query = "SELECT id, name, experience, specialization, education FROM masters";
$stmt = $pdo->query($query);
$masters = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Masters List</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Masters List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Experience</th>
                    <th>Specialization</th>
                    <th>Education</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($masters as $master): ?>
                    <tr>
                        <td><?php echo $master['id']; ?></td>
                        <td><?php echo $master['name']; ?></td>
                        <td><?php echo $master['experience']; ?></td>
                        <td><?php echo $master['specialization']; ?></td>
                        <td><?php echo $master['education']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Back to Admin Panel</a>
    </div>
</body>
</html>
