<?php
// delete.php
include 'config.php';
include 'db_operations.php';

$table = $_GET['table'];
$id = $_GET['id'];

deleteData($pdo, $table, $id);

header("Location: index.php");
?>
