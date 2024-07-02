<?php
// edit.php
include 'config.php';
include 'db_operations.php';

$table = $_GET['table'];
$id = $_GET['id'];
$columns = getTableColumns($pdo, $table);
$data = getTableData($pdo, $table)[0];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateData = [];
    foreach ($columns as $column) {
        if ($column != 'id') {
            $updateData[$column] = $_POST[$column];
        }
    }
    updateData($pdo, $table, $updateData, $id);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit <?php echo $table; ?></title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <div class="container">
        <h1>Edit <?php echo $table; ?></h1>
        <form method="post">
            <?php foreach ($columns as $column): if ($column == 'id') continue; ?>
                <div class="form-group">
                    <label for="<?php echo $column; ?>"><?php echo $column; ?></label>
                    <input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>" value="<?php echo $data[$column]; ?>">
                </div>
            <?php endforeach; ?>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
