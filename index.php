<?php
// index.php
include 'config.php';
include 'db_operations.php';

$tables = getTables($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>

        <?php foreach ($tables as $table): ?>
            <h2><?php echo $table; ?></h2>
            <table class="table">
                <thead>
                    <tr>
                        <?php
                        $columns = getTableColumns($pdo, $table);
                        foreach ($columns as $column):
                        ?>
                            <th><?php echo $column; ?></th>
                        <?php endforeach; ?>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = getTableData($pdo, $table);
                    foreach ($rows as $row):
                    ?>
                        <tr>
                            <?php foreach ($columns as $column): ?>
                                <td><?php echo $row[$column]; ?></td>
                            <?php endforeach; ?>
                            <td>
                                <a href="edit.php?table=<?php echo $table; ?>&id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete.php?table=<?php echo $table; ?>&id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="add.php?table=<?php echo $table; ?>">Add New <?php echo $table; ?></a>
        <?php endforeach; ?>

        <h2>Additional Functions</h2>
        <div class="button-group">
            <a href="clients.php" class="button">1. List of Clients</a>
            <a href="services.php" class="button">2. List of Services</a>
            <a href="masters.php" class="button">3. List of Masters</a>
            <a href="appointments.php" class="button">4. Clients on Specific Date</a>
            <a href="products.php" class="button">5. Cosmetic Products</a>
            <a href="slots.php" class="button">6. Available Slots</a>
            <a href="employees.php" class="button">7. Employee Services Count</a>
            <a href="revenue.php" class="button">8. Total Revenue</a>
            <a href="popular_services.php" class="button">9. Popular Services</a>
            <a href="available_products.php" class="button">10. Available Products</a>
            <a href="frequent_clients.php" class="button">11. Frequent Clients</a>
        </div>
    </div>
</body>
</html>
