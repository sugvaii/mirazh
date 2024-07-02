<?php
// add.php
include 'config.php';
include 'db_operations.php';

$table = $_GET['table'];
$columns = getTableColumns($pdo, $table);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [];
    foreach ($columns as $column) {
        if ($column != 'id') {
            $data[$column] = $_POST[$column];
        }
    }
    insertData($pdo, $table, $data);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add <?php echo $table; ?></title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Add New <?php echo $table; ?></h1>
        <form method="post">
            <?php foreach ($columns as $column): if ($column == 'id') continue; ?>
                <div class="form-group">
                    <label for="<?php echo $column; ?>"><?php echo $column; ?></label>
                    <input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>
